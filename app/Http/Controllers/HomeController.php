<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserdetailRepository;
use Auth;
use App\Repositories\TypeRepository;
use App\Repositories\UnitRepository;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserdetailRepository $detailRepository,
        TypeRepository $typeRepository,
        UnitRepository $unitRepository
        ) {
        $this->middleware('auth');
        $this->detailRepository = $detailRepository;
        $this->typeRepository = $typeRepository;
        $this->unitRepository = $unitRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userDetail = $this->detailRepository->findbyuser(Auth::user()->id);

        if (!$userDetail) {
            Session::put('ss_status_biodata', false);

            $data = [
                'userDetail' => $userDetail,
            ];

            return view('biodata', $data);
        }

        if (!$userDetail->phone) {
            Session::put('ss_status_biodata', false);

            $data = [
                'userDetail' => $userDetail,
            ];

            return view('biodata', $data);
        }

        Session::put('ss_status_biodata', true);

        if (Auth::user()->role != 'peserta') {
            return view('home');
        } else {
            return redirect('/');
        }
    }
}
