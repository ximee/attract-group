<?php

namespace App\Repositories;

use App\Message;

class MessageRepository extends BaseRepository
{
    /**
     * @var Message
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->model = $message;
    }
}