<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventsRepository;
use App\Repositories\CategoryRepository;
use Auth;

class FrontController extends Controller
{
    public function __construct(
        EventsRepository $repoEvent,
        CategoryRepository $repoCategories
    ) {
        $this->repoEvent = $repoEvent;
        $this->repoCategories = $repoCategories;
    }
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->rDetail == null) {
            return redirect('home');
        }

        $events = $this->repoEvent->paginate();
        $categories = $this->repoCategories->get();

        $data = [
            'events' => $events,
            'categories' => $categories,
        ];

        return view('front.index', $data);
    }

    public function eventdetail($id)
    {
        $event = $this->repoEvent->find($id, ['rParticipant']);
        $categories = $this->repoCategories->get();

        $data = [
            'event' => $event,
            'categories' => $categories
        ];

        return view('front.eventdetail', $data);
    }
}
