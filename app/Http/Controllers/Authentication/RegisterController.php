<?php

namespace App\Http\Controllers\Authentication;

use Auth;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Repositories\BiodataRepository;
use App\Repositories\EmailRepository;
use App\Repositories\UserRepository;
use App\Repositories\IsdmRepository;

class RegisterController extends Controller
{
    public function __construct(
        RoleRepository $roleRepo,
        BiodataRepository $biodataRepo,
        EmailRepository $emailRepo,
        UserRepository $userRepo,
        IsdmRepository $isdmRepo
    ) {
        $this->middleware('guest');
        $this->roleRepo = $roleRepo;
        $this->biodataRepo = $biodataRepo;
        $this->emailRepo = $emailRepo;
        $this->userRepo = $userRepo;
        $this->isdmRepo = $isdmRepo;
    }

    public function index()
    {
        return view('auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(Request $request)
    {
        $checkEmail = $this->emailRepo->checkEmail($request->input('email'));

        if (!is_array($checkEmail)) {
            Alert::error('Email tidak ditemukan');
            return redirect()->back();
        }


        $user = $this->userRepo->find(null, $request->input('email'));

        if ($user) {
            Alert::warning('Email sudah terdaftar');
            return redirect()->back();
        }

        $id = (string)Str::uuid();
        $isdm = $this->isdmRepo->isdm($checkEmail[0]->userid);

        if (!$isdm) {
            Alert::error('Data kepegawaian tidak ditemukan');
            return redirect()->back();
        }

        $this->userRepo->create($id, $isdm, $checkEmail[0]->email);
        $this->roleRepo->create($id, $isdm, 'admin');
        $this->biodataRepo->create($id, $isdm, $checkEmail[0]->email);

        Auth::loginUsingId($id);

        return redirect()->route('home');
    }
}
