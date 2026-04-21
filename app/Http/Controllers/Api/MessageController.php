<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index($conversationId)
    {
        return Message::where('conversation_id', $conversationId)
            ->orderBy('created_at')
            ->get();
    }

    public function store(Request $request, FirebaseService $firebase)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'sender_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        try {

            $conversation = Conversation::find($request->conversation_id);

            if (!$conversation) {
                return response()->json([
                    "error" => "Conversación no encontrada"
                ], 400);
            }

            // 1. guardar mensaje
            $message = Message::create([
                'conversation_id' => $request->conversation_id,
                'sender_id' => $request->sender_id,
                'message' => $request->message
            ]);

            // 2. actualizar conversación
            $conversation->update([
                'last_message' => $request->message
            ]);

            // 3. obtener receptor
            $receiverId = $conversation->user_one_id == $request->sender_id
                ? $conversation->user_two_id
                : $conversation->user_one_id;

            $receiver = User::find($receiverId);

            Log::info("RECEPTOR:", [
                "id" => $receiver?->id,
                "token" => $receiver?->fcm_token
            ]);

            // 4. enviar notificación SOLO si hay token válido
            if (!empty($receiver?->fcm_token)) {

                try {
                    $response = $firebase->sendNotification(
                        $receiver->fcm_token,
                        "Nuevo mensaje",
                        $request->message
                    );

                    Log::info("FCM RESPONSE:", $response);

                } catch (\Exception $e) {
                    Log::error("FCM ERROR: " . $e->getMessage());
                }
            }

            return response()->json($message);

        } catch (\Exception $e) {
            Log::error("MESSAGE STORE ERROR: " . $e->getMessage());

            return response()->json([
                "error" => $e->getMessage()
            ], 500);
        }
    }
}