<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class WizardCatController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $userMessage = $request->input('message');

            if (!$userMessage) {
                return response()->json(['reply' => "Meow: Please tell me something! "]);
            }

            $apiKey = env('OPENROUTER_API_KEY');

            if (!$apiKey) {
                return response()->json(['reply' => "Meow~ API key is missing! Check your .env file 😿"]);
            }

            Log::info('Sending to OpenRouter: ' . $userMessage);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'MindScope Wizard Cat'
            ])->timeout(30)->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'google/gemma-2-9b-it:free',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are Wizard Cat . IMPORTANT: You MUST respond ONLY in English language. You are a kind, wise, and magical cat companion who helps people feel better. Be warm and encouraging. Keep responses very short (2-3 sentences maximum). Always use cat emojis like 🐱✨🪄. Never respond in any language other than English.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'temperature' => 0.8,
                'max_tokens' => 100
            ]);

            Log::info('OpenRouter Status: ' . $response->status());

            if ($response->failed()) {
                Log::error('OpenRouter Error: ' . $response->body());
                return response()->json(['reply' => "Meow: My magic connection failed!"]);
            }

            $data = $response->json();
            Log::info('OpenRouter Response: ' . json_encode($data));

            $reply = $data['choices'][0]['message']['content'] ?? "Meow: *purrs softly* I'm here for you! Tell me more ";
            if (strlen($reply) > 200) {
                $reply = substr($reply, 0, 197) . '...';
            }

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['reply' => "Meow: Something went wrong! "]);
        }
    }
}