<?php

namespace App\Repositories;

use Auth;
use Illuminate\Support\Str;
use App\Models\Event;

class EventsRepository
{
    private $model;
    public function __construct(Event $model)
    {
        $this->model = $model;
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

    public function findCode($code = null, $with = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($code, function ($query) use ($code) {
                return $query->where('code', $code)->orWhere('slug', $code);
            })
            ->firstOrFail();
    }

    public function get($with = null, $title = null, $role = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($title, function ($query) use ($title) {
                return $query->where('title', 'LIKE', '%' . $title . '%');
            })
            ->when($role, function ($query) use ($role) {
                return $query->where('userid_created', $role);
            })
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function paginate($with = null, $title = null, $unit = null, $limit = 10)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($title, function ($query) use ($title) {
                return $query->where('title', 'LIKE', '%' . $title . '%');
            })
            ->when($unit, function ($query) use ($unit) {
                return $query->where('unit_id', $unit);
            })
            ->where('publication_status', true)
            ->orderBy('date', 'DESC')
            ->paginate($limit);
    }

    public function code()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; ++$i) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $data['id'] = (string)Str::uuid();
        $data['code'] = $this->code();
        $data['slug'] = str_slug($request->input('title'));
        $data['publication_status'] = $request->has('publication_status') ? true : false;
        $data['pay_status'] = $request->has('pay_status') ? true : false;
        $data['userid_created'] = Auth::user()->id;
        $data['userid_updated'] = Auth::user()->id;

        return $this->model->create($data);
    }

    public function update($request, Event $event)
    {
        $data = $request->except('_token');
        if ($request->input('publication_status')) {
            $data['publication_status'] = $request->has('publication_status') ? true : false;
        }
        $data['pay_status'] = $request->has('pay_status') ? true : false;
        $data['userid_updated'] = Auth::user()->id;

        return $event->update($data);
    }
    public function destroy(Event $event)
    {
        $event->delete();
        return $event;
    }
}
