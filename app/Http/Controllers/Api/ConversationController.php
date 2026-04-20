<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;

class ConversationController extends Controller
{
    public function store(Request $request)
    {
        $user1 = $request->user_one_id;
        $user2 = $request->user_two_id;

        $conversation = Conversation::where(function ($q) use ($user1, $user2) {
            $q->where('user_one_id', $user1)
            ->where('user_two_id', $user2);
        })
        ->orWhere(function ($q) use ($user1, $user2) {
            $q->where('user_one_id', $user2)
            ->where('user_two_id', $user1);
        })
        ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $user1,
                'user_two_id' => $user2,
                'property_id' => $request->property_id ?? null
            ]);
        }

        return response()->json($conversation);
    }

    public function index($userId)
    {
        $conversations = Conversation::with(['userOne', 'userTwo'])
            ->where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->latest()
            ->get()
            ->map(function ($conversation) use ($userId) {

                $otherUser = $conversation->user_one_id == $userId
                    ? $conversation->userTwo
                    : $conversation->userOne;

                return [
                    'id' => $conversation->id,
                    'other_user_name' => $otherUser->name,
                    'last_message' => $conversation->last_message ?? null,
                    'updated_at' => $conversation->updated_at,
                ];
            });

        return response()->json($conversations);
    }
}
