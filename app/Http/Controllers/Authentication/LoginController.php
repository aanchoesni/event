<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client as GuzzleHttpClient;
use Auth;
use App\Repositories\AuthRepository;
use App\Repositories\UsersRepository;
use App\Repositories\BiodataRepository;
use Illuminate\Support\Str;
use App\Repositories\UserdetailRepository;

class LoginController extends Controller
{
    private $authRepo;
    private $userRepo;
    private $biodataRepo;
    private $userDetailRepo;
    public function __construct(
        AuthRepository $authRepo,
        UsersRepository $userRepo,
        BiodataRepository $biodataRepo,
        UserdetailRepository $userDetailRepo
    ) {
        $this->authRepo = $authRepo;
        $this->userRepo = $userRepo;
        $this->biodataRepo = $biodataRepo;
        $this->userDetailRepo = $userDetailRepo;
    }

    public function index()
    {
        try {
            $sessso = $_COOKIE['email_sso'];
        } catch (\Exception $sessso) {
            return View('auth.login');
        }
        if (isset($sessso)) {
            $urlsso="https://sso.unesa.ac.id/api/user-cookie";
            $cek_sesisso=file_get_contents($urlsso."/$sessso");
            $rr = (json_decode($cek_sesisso));
            $emailsso = $rr->email;
            $useridsso = $rr->userid;
        }

        $url = "https://siakadu.unesa.ac.id/api/apiunggun";
        $data = array('kondisi'=>"login_sso",'email'=>$emailsso, 'id_user'=>$useridsso );
        $x= kirim_data($url, 'post', $data);
        $cek = unserialize($x['isi']);

        $user_name=$cek['username']; //NIM,NIP
        $nama_user=$cek['nm_pengguna'];
        $level_user=(int)$cek['approval_pengguna'];//100: mahasiswa, 46: dosen
        $foto_user='';

        if ($level_user==46) {
            $id=$cek['id_sdm'];
            $foto_user="https://staticsiakadu.unesa.ac.id/photo/dosen/300/$id.jpg";
            $cek['foto']=$foto_user;

            $url = "https://siakadu.unesa.ac.id/api/apiunggun";
            $datapimpinan = array('id_sdm'=>$cek['id_sdm'], 'kondisi'=>"unit_pimpinan_sipena");
            $xpimpinan= kirim_data($url, 'post', $datapimpinan);
            $pimpinan = unserialize($xpimpinan['isi']);
            foreach ($pimpinan as $value) {
                $prodi = $value['child'];
            }
            Session::put('ss_pimpinan_prodi', $prodi);
            //Dosen
            Session::put('ss_id_pengguna', $cek['id_pengguna']);
            Session::put('ss_namarole', 'D');
            Session::put('ss_nama', $cek['nm_pengguna']);
            Session::put('ss_userid', $cek['username']);
            Session::put('ss_id_sdm', $cek['id_sdm']);
            Session::put('ss_foto', $cek['foto']);

            Session::put('ss_periodesekarang', $setting['data'][0]['semester']);

            Alert::success('Selamat Datang', Session::get('ss_nama'))->persistent('Ok');

            return redirect()->intended('dashboarddosen');
        }

        return redirect()->to('https://siakadu.unesa.ac.id');
    }

    public function sso(Request $request, $email, $session_id)
    {
        $auth = $this->authRepo->sso($request, $email, $session_id);

        if (!is_array($auth)) {
            return redirect('https://sso.unesa.ac.id/user');
        }

        $user = $this->userRepo->find(null, null, $auth[0]->email);

        if ($user) {
            // Login
            return $this->getlogin($user->id);
        } else {
            // Add User
            return $this->getadduser($auth);
        }

        return redirect()->route('homemahasiswa');
    }

    private function getlogin($userid)
    {
        Auth::loginUsingId($userid);

        return redirect()->intended('home');
    }

    private function getAdduser($auth)
    {
        $biodata = $this->biodataRepo->biodata($auth);

        $id = (string)Str::uuid();
        $this->userRepo->storeSso($id, $biodata);
        $this->userDetailRepo->storeSso($id, $biodata);

        Auth::loginUsingId($id);

        return redirect()->intended('home');
    }
}
