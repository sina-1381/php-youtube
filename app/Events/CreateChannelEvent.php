<?php

namespace App\Events;

use App\Models\Users;
use Illuminate\Queue\SerializesModels;


class CreateChannelEvent extends Event
{
    use SerializesModels;

    public $users;

    /**
     * Create a new event instance.
     *
     * @param Users $users
     */
    public function __construct(Users $users)
    {
        $this->users = $users;
    }
}
