<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Repositories\MessageRepository;

class MessageService
{
    /**
     * @var MessageRepository
     */
    protected $repository;

    /**
     * MessageService constructor.
     * @param $repository
     */
    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $text
     * @param int $id
     *
     * @return mixed
     */
    public function sendMessage(string $text, int $id)
    {
        return $this->repository->create([
            'user_id' => $id,
            'text' => $text
        ]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function fetchMessagesByUser(int $id)
    {
        return $this->repository->where('user_id', $id)->get();
    }
}