<?php

namespace App\Events;

use App\Models\Users;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class EmailSenderEvent extends Event
{
    use SerializesModels;

    public $users;
    /**
     * @var array
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @param Users $users
     */
    public function __construct(Model $users, array $data)
    {
        $this->users = $users;
        $this->data = $data;
    }
}
