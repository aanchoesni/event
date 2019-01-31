<?php

namespace App\Repositories;

use App\User;
use Auth;
use Illuminate\Support\Str;

class UsersRepository
{
    private $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getSelect()
    {
        return $this->model
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
    }

    public function find($id = null, $with = null, $email = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->when($email, function ($query) use ($email) {
                return $query->where('email', $email);
            })
            ->first();
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
        $data = $request->except('_token');
        $data['id'] = (string)Str::uuid();
        $data['password'] = bcrypt($request->input('password'));
        $data['userid_created'] = Auth::user()->id;
        $data['userid_updated'] = Auth::user()->id;

        return $this->model->create($data);
    }

    public function storeSso($id, $data)
    {
        $data['id'] = $id;
        $data['password'] = bcrypt($data['noid'].'s3cr3t5');
        return $this->model->create($data);
    }

    public function update($request, User $user)
    {
        $data = $request->except('_token');
        if ($request->input('password')) {
            $data['password'] = bcrypt($request->input('password'));
        } else {
            unset($data['password']);
        }
        $data['userid_updated'] = Auth::user()->id;

        return $user->update($data);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $user;
    }
}
