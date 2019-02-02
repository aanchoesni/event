<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\Participant;

class QuotaRepository
{
    private $model;
    public function __construct(
        Event $model,
        Participant $participantRepo
    ) {
        $this->model = $model;
        $this->participantRepo = $participantRepo;
    }

    public function check($id)
    {
        $quota = $this->model->where('id', $id)->first();
        $countParticipant = $this->participantRepo->where('event_id', $id)->count();

        if ($quota->quota != null || $quota->quota != 0) {
            $return = [
                'event' => $quota,
                'status' => 'f'
            ];
            if ($quota->quota > $countParticipant) {
                $return = [
                    'event' => $quota,
                    'status' => 't'
                ];
            }
        } else {
            $return = [
                'event' => $quota,
                'status' => 't'
            ];
        }

        return $return;
    }
}
