<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\EventsRepository;
use Illuminate\Http\Request;
use Alert;
use Auth;
use Crypt;
use App\Repositories\CategoryRepository;
use App\Repositories\UnitRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserdetailRepository;
use Session;

class EventsController extends Controller
{
    private $repository;
    public function __construct(
        UserdetailRepository $detailRepository,
        EventsRepository $repository,
        CategoryRepository $categoryRepository,
        UnitRepository $unitRepository,
        TypeRepository $typeRepo
    ) {
        $this->detailRepository = $detailRepository;
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->unitRepository = $unitRepository;
        $this->typeRepo = $typeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        if (Auth::user()->role == 'admin') {
            $event = $this->repository->get(['rCategory', 'rUnit', 'rType'], $request->input('title'));
        } else {
            $event = $this->repository->get(['rCategory', 'rUnit', 'rType'], $request->input('title'), Auth::user()->id);
        }

        $type = $this->typeRepo->getSelect();

        $data = [
            'events' => $event,
            'type' => $type,
        ];

        return view('admin.master.event.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = $this->unitRepository->getSelect();
        $categories = $this->categoryRepository->getSelect();
        $data = [
            'units' => $unit,
            'categories' => $categories,
        ];

        return view('admin.master.event.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repository->store($request);

        Alert::success('Berhasil disimpan');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->repository->find($id);
        $unit = $this->unitRepository->getSelect();
        $categories = $this->categoryRepository->getSelect();

        $data = [
            'event' => $event,
            'units' => $unit,
            'categories' => $categories,
        ];

        return view('admin.master.event.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = $this->repository->find($id);
        $this->repository->update($request, $event);

        Alert::success('Berhasil disimpan');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = $this->repository->find(Crypt::decrypt($id));
        $this->repository->destroy($event);

        return redirect()->route('events.index');
    }
}
