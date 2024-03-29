<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ParticipantRepository;
use Alert;
use Auth;
use App\Repositories\QuotaRepository;
use App\Repositories\UserdetailRepository;

class ParticipantController extends Controller
{
    public function __construct(
        UserdetailRepository $detailRepository,
        ParticipantRepository $repoParticipant,
        QuotaRepository $quotaRepo
    ) {
        $this->detailRepository = $detailRepository;
        $this->repoParticipant = $repoParticipant;
        $this->quotaRepo = $quotaRepo;
    }

    public function register(Request $request)
    {
        $userDetail = $this->detailRepository->findbyuser(Auth::user()->id);

        if (!$userDetail) {
            $data = [
                'userDetail' => $userDetail,
            ];

            Alert::warning('Lengkapi Biodata Anda');
            return view('biodata', $data);
        }

        if (!$userDetail->phone) {
            $data = [
                'userDetail' => $userDetail,
            ];

            Alert::warning('Masukkan Nomor HP Anda');
            return view('biodata', $data);
        }

        $reg = $this->quotaRepo->check($request->input('data'));
        if ($reg['status'] == 'f') {
            Alert::success('Participant is Full');
            return redirect()->route('eventdetail', ['data' => $reg['event']->code]);
        }

        $participant = $this->repoParticipant->store($request->input('data'));

        if ($participant == 'terdaftar') {
            Alert::success('You are Registerd');
            return redirect()->route('eventdetail', ['data' => $reg['event']->code]);
        }

        if ($participant == 'tidak sesuai') {
            Alert::error('Type of Participant Not Match');
            return redirect()->route('eventdetail', ['data' => $reg['event']->code]);
        }

        if ($participant->is_valid == 1) {
            Alert::success('Register Success', 'Success');
        } elseif ($participant->is_valid == 0) {
            Alert::success('Please Confirm Your Payment');
        }

        return redirect()->route('eventdetail', ['data'=> $reg['event']->code]);
    }

    public function history()
    {
        $histories = $this->repoParticipant->history(null, Auth::user()->id);

        $data = [
            'histories' => $histories,
        ];

        return view('front.history', $data);
    }
}
