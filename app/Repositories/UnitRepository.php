<?php

namespace App\Repositories;

use App\Models\Unit;
use Auth;
use Illuminate\Support\Str;

class UnitRepository
{
    public function __construct(Unit $model)
    {
        $this->model = $model;
    }

    public function getSelect()
    {
        return $this->model
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
    }

    public function find($id = null, $with = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->firstOrFail();
    }

    public function get($with = null, $name = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($name, function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->orderBy('name', 'ASC')
            ->get();
    }

    public function paginate($with = null, $name = null, $limit = 10)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($name, function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->orderBy('name', 'ASC')
            ->paginate($limit);
    }

    public function store($request)
    {
        $user = Auth::user();
        $unit = $this->model;
        $unit->id = (string)Str::uuid();
        $unit->name = $request->name;
        $unit->shortname = $request->shortname;
        $unit->description = $request->description;
        $unit->userid_created = $user->id;
        $unit->userid_updated = $user->id;
        $unit->save();

        return $unit;
    }

    public function update($request, Category $unit)
    {
        $user = Auth::user();
        $unit->name = $request->name;
        $unit->shortname = $request->shortname;
        $unit->description = $request->description;
        $unit->userid_updated = $user->id;
        $unit->save();

        return $unit;
    }
    public function destroy(Category $unit)
    {
        $unit->delete();
        return $unit;
    }
}
