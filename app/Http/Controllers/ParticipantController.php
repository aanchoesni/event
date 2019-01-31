<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ParticipantRepository;
use Alert;

class ParticipantController extends Controller
{
    public function __construct(ParticipantRepository $repoParticipant)
    {
        $this->repoParticipant = $repoParticipant;
    }

    public function register(Request $request)
    {
        $participant = $this->repoParticipant->store($request->input('data'));

        if ($participant == 'terdaftar') {
            Alert::success('Anda Sudah Terdaftar');
            return redirect()->route('eventdetail', ['data' => $request->input('data')]);
        }

        if ($participant->is_valid == 1) {
            Alert::success('Pendaftaran Behasil', 'Success');
        } else if ($participant->is_valid == 0) {
            Alert::success('Silahkan Melakukan Pembayaran');
        }

        return redirect()->route('eventdetail',['data'=>$request->input('data')]);
    }

    public function history()
    {
        $histories = $this->repoParticipant->history();

        $data = [
            'histories' => $histories,
        ];

        return view('front.history', $data);

    }
}
