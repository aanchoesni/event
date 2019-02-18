<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ParticipantRepository;
use Illuminate\Support\Facades\Crypt;
use Auth;

class CardController extends Controller
{
    private $participantRepo;
    public function __construct(
        ParticipantRepository $participantRepo
    ){
        $this->participantRepo = $participantRepo;
    }

    public function print($id)
    {
        $event = Crypt::decrypt($id);
        $participant = $this->participantRepo->find($event, ['rEvent', 'rUser']);

        $data = [
            'participant' => $participant,
        ];

        return view('print', $data);
    }
}
