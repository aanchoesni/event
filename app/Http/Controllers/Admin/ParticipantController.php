<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ParticipantRepository;
use Auth;
use Crypt;
use Session;

class ParticipantController extends Controller
{
    public function __construct(ParticipantRepository $repoParticipant)
    {
        $this->repoParticipant = $repoParticipant;
    }

    public function index($id)
    {
        Session::put('ss_id_event', $id);
        $participant = $this->repoParticipant->get(['rUser'], $id);

        $data = [
            'participant' => $participant,
        ];

        return view('admin.master.event.participant', $data);
    }

    public function destroy($id)
    {
        $repoParticipant = $this->repoParticipant->find(Crypt::decrypt($id));
        $this->repoParticipant->destroy($repoParticipant);

        return redirect()->route('participant.index', Session::get('ss_id_event'));
    }
}
