<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventsRepository;
use App\Repositories\CategoryRepository;
use Auth;
use App\Repositories\ParticipantRepository;

class FrontController extends Controller
{
    public function __construct(
        EventsRepository $repoEvent,
        CategoryRepository $repoCategories,
        ParticipantRepository $repoParticipant
    ) {
        $this->repoEvent = $repoEvent;
        $this->repoCategories = $repoCategories;
        $this->repoParticipant = $repoParticipant;
    }
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->rDetail == null) {
            return redirect('home');
        }

        $events = $this->repoEvent->paginate(['rCategory', 'rUnit', 'rType', 'rEventParticipant']);
        $categories = $this->repoCategories->get();

        $data = [
            'events' => $events,
            'categories' => $categories,
        ];

        return view('front.index', $data);
    }

    public function eventdetail($id)
    {
        $event = $this->repoEvent->findCode($id, ['rCategory', 'rUnit', 'rType', 'rEventParticipant', 'rParticipant']);
        $categories = $this->repoCategories->get();
        $participant = $this->repoParticipant->check($event->id, Auth::user()->id);

        $data = [
            'event' => $event,
            'categories' => $categories,
            'participant' => $participant
        ];

        return view('front.eventdetail', $data);
    }
}
