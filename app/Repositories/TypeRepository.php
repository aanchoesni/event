<?php

namespace App\Repositories;

use App\Models\Type;
use Auth;
use Illuminate\Support\Str;

class TypeRepository
{
    private $model;
    public function __construct(Type $model)
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
        $type = $this->model;
        $type->id = (string)Str::uuid();
        $type->name = $request->name;
        $type->description = $request->description;
        $type->userid_created = $user->id;
        $type->userid_updated = $user->id;
        $type->save();

        return $type;
    }

    public function update($request, Type $type)
    {
        $user = Auth::user();
        $type->name = $request->name;
        $type->description = $request->description;
        $type->userid_updated = $user->id;
        $type->save();

        return $type;
    }
    public function destroy(Type $type)
    {
        $type->delete();
        return $type;
    }
}
