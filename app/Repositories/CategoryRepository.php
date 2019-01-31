<?php

namespace App\Repositories;

use Auth;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryRepository
{
    private $model;
    public function __construct(Category $model)
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
        $category = $this->model;
        $category->id = (string)Str::uuid();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->userid_created = $user->id;
        $category->userid_updated = $user->id;
        $category->save();

        return $category;
    }

    public function update($request, Category $category)
    {
        $user = Auth::user();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->userid_updated = $user->id;
        $category->save();

        return $category;
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return $category;
    }
}
