<?php

namespace App\Repositories;

use App\Models\Userdetail;
use Illuminate\Support\Str;
use Auth;

class UserdetailRepository
{
    public function __construct(Userdetail $model)
    {
        $this->model = $model;
    }

    public function findbyid($id = null, $with = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->first();
    }

    public function findbyuser($userid = null, $with = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($userid, function ($query) use ($userid) {
                return $query->where('user_id', $userid);
            })
            ->first();
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $data['id'] = (string)Str::uuid();
        $data['user_id'] = Auth::user()->id;
        $data['userid_created'] = Auth::user()->id;
        $data['userid_updated'] = Auth::user()->id;
        $biodata = $this->model->create($data);

        return $biodata;
    }

    public function storeSso($id, $data)
    {
        $data['id'] = (string)Str::uuid();
        $data['noidentitas'] = $data['noid'];
        $data['type'] = $data['role'];
        $data['user_id'] = $id;
        $data['origin'] = 'Universitas Negeri Surabaya';

        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->where('user_id', $id)->first();
    }

    public function update($request)
    {
        $biodata = $this->findbyuser(Auth::user()->id);

        $data = $request->except('_token');
        $data['userid_updated'] = Auth::user()->id;
        $biodata->update($data);

        return $biodata;
    }
}
