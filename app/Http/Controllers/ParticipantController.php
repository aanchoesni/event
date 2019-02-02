<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ParticipantRepository;
use Alert;
use Auth;
use App\Repositories\QuotaRepository;

class ParticipantController extends Controller
{
    public function __construct(
        ParticipantRepository $repoParticipant,
        QuotaRepository $quotaRepo
    ) {
        $this->repoParticipant = $repoParticipant;
        $this->quotaRepo = $quotaRepo;
    }

    public function register(Request $request)
    {
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
