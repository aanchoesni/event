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

        $user = $this->userRepo->find(null, null, $auth[0]->email);

        if ($user) {
            // Login
            return $this->getlogin($user->id);
        } else {
            // Add User
            return $this->getadduser($auth);
        }

        return redirect()->route('/');
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

        return redirect()->route('/');
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
