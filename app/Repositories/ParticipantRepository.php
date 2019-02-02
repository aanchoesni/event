<?php

namespace App\Repositories;

use App\Models\Participant;
use Auth;
use Illuminate\Support\Str;

class ParticipantRepository
{
    private $model;
    public function __construct(
        Participant $model,
        EventsRepository $repoEvent
    ) {
        $this->model = $model;
        $this->repoEvent = $repoEvent;
    }

    public function check($id, $userid)
    {
        return $this->model
                            ->where('event_id', $id)
                            ->where('user_id', $userid)
                            ->first();
    }

    public function store($id)
    {
        $user = Auth::user();

        $check = $this->check($id, $user->id);

        if ($check) {
            return 'terdaftar';
        }

        $event = $this->repoEvent->find($id, ['rType']);
        $filter = 'stop';
        foreach ($event->rType as $key => $val) {
            if (strtolower($val->name) != 'umum') {
                if (strtolower($val->name) == strtolower($user->role)) {
                    $filter = 'nextstep';
                }
            } else {
                $filter = 'nextstep';
            }
        }

        if ($filter == 'stop') {
            return 'tidak sesuai';
        }

        if ($event->pay_status == false) {
            $data['is_valid'] = 1;
        } else {
            $data['is_valid'] = 0;
        }

        $data['id'] = (string)Str::uuid();
        $data['event_id'] = $id;
        $data['user_id'] = $user->id;
        $data['userid_created'] = $user->id;
        $data['userid_updated'] = $user->id;
        return $this->model->create($data);
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

    public function history($with = null, $user_id = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($user_id, function ($query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function get($with = null, $event_id = null)
    {
        return $this->model
            ->when($with, function ($query) use ($with) {
                return $query->with($with);
            })
            ->when($event_id, function ($query) use ($event_id) {
                return $query->where('event_id', $event_id);
            })
            ->get();
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return $participant;
    }
}
