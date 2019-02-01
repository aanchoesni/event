<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SelectTypeRepository;
use App\Repositories\TypeRepository;

class SelectTypeController extends Controller
{
    private $selectTypeRepo;
    public function __construct(
        SelectTypeRepository $selectTypeRepo,
        TypeRepository $typeRepo
    ){
        $this->selectTypeRepo = $selectTypeRepo;
        $this->typeRepo = $typeRepo;
    }

    public function store(Request $request)
    {
        $eventid = $request->input('event_id');
        $typeid = $request->input('type_id');

        $type = $this->typeRepo->find($typeid);
        $this->selectTypeRepo->store($eventid, $type);

        return response()->json(['eventid'=>$eventid, 'type'=>$type->name]);
    }

    public function destroy(Request $request)
    {
        $eventid = $request->input('event_id');
        $typeid = $request->input('type_id');

        $type = $this->typeRepo->find($typeid);
        $this->selectTypeRepo->delete($eventid, $type);

        return response()->json(['eventid'=>$eventid, 'type'=>$type->id]);
    }
}
