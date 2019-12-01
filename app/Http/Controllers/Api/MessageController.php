<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ValidateMessageRequest;

class MessageController extends Controller
{

    protected $messageService;

    /**
     * MessageController constructor.
     * @param $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * @param ValidateMessageRequest $validatedRequest
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(ValidateMessageRequest $validatedRequest, int $id)
    {
        $result = $this->messageService->sendMessage($validatedRequest->input('text'), $id);

        if (!$result) {
            return response()->json([
                'message' => 'Sending message failed!'
            ], 400);
        }

        return response()->json([
            'message' => 'You message has been successfully sent!'
        ], 201);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function fetchMessagesByUser(int $id)
    {
        $messages = $this->messageService->fetchMessagesByUser($id);

        return $messages;
    }
}
