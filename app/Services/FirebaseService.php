<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Google\Client as GoogleClient;

class FirebaseService
{
    private function getAccessToken()
    {
        $credentialsPath = storage_path('app/firebase/firebase.json');

        $client = new GoogleClient();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $token = $client->fetchAccessTokenWithAssertion();

        return $token['access_token'];
    }

    public function sendNotification($fcmToken, $title, $body)
    {
        $projectId = json_decode(
            file_get_contents(storage_path('app/firebase/firebase.json')),
            true
        )['project_id'];

        $accessToken = $this->getAccessToken();

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $message = [
            "message" => [
                "token" => $fcmToken,

                "notification" => [
                    "title" => $title,
                    "body" => $body,
                ],

                "android" => [
                    "priority" => "HIGH"
                ]
            ]
        ];

        $response = Http::withToken($accessToken)
            ->post($url, $message);

        \Log::info("FCM RESPONSE:", [
            "status" => $response->status(),
            "body" => $response->body()
        ]);

        return $response->json();
    }
}