<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\Type;


class SelectTypeRepository
{
    private $model;
    private $typeModel;
    public function __construct(
        Event $model
    ){
        $this->model = $model;
    }

    public function store($event_id, $type)
    {
        $event = $this->model->find($event_id);

        return $event->rType()->attach($type);
    }

    public function delete($event_id, $type)
    {
        $event = $this->model->find($event_id);

        return $event->rType()->detach($type);
    }
}
