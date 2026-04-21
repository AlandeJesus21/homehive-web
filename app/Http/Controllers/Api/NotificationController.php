<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use App\Services\FirebaseService;

class MessageController extends Controller
{
    public function index($conversationId)
    {
        $messages = Message::where('conversation_id', $conversationId)
            ->orderBy('created_at')
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request, FirebaseService $firebase)
    {
        // Guardar mensaje
        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => $request->sender_id,
            'message' => $request->message
        ]);

        // Actualizar última conversación
        $conversation = Conversation::find($request->conversation_id);

        $conversation->update([
            'last_message' => $request->message
        ]);

        // Buscar receptor (IMPORTANTE)
        $receiverId = $conversation->user1_id == $request->sender_id
            ? $conversation->user2_id
            : $conversation->user1_id;

        $receiver = User::find($receiverId);

        // Enviar notificación si tiene token
        if ($receiver && $receiver->fcm_token) {
            $firebase->sendNotification(
                $receiver->fcm_token,
                "Nuevo mensaje",
                $request->message
            );
        }

        return response()->json($message);
    }
}