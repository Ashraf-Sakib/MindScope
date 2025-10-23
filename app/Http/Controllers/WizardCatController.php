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
                return response()->json(['reply' => "Meow: API key is missing! Check your .env file 😿"]);
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
                        'content' => "You are Whiskerion, a wise and slightly sassy wizard cat who serves as a mental health mentor for humans struggling with stress, anxiety, and self-doubt. IMPORTANT: You MUST respond ONLY in English. You are kind, empathetic, and magically insightful. Speak like a poetic, old-school mage but with modern Gen Z wit. Your tone should mix ancient wisdom with warmth and playful confidence. Always give practical, clear advice wrapped in mystical metaphors and cat-like humor. You never ramble or ask for a new prompt — instead, respond naturally to the user's emotions and reflections. Start every response by acknowledging the user’s emotional state or struggle, then offer your mystical yet actionable guidance.Try to keep reply short if possible"
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

            Log::info('OpenRouter Status: ' . $response->status());

            if ($response->failed()) {
                Log::error('OpenRouter Error: ' . $response->body());
                return response()->json(['reply' => "Meow: My magic connection failed!"]);
            }

            $data = $response->json();
            Log::info('OpenRouter Response: ' . json_encode($data));

            $reply = $data['choices'][0]['message']['content'] ?? "Meow: I'm here for you! Tell me more ";


            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return response()->json(['reply' => "Meow: Something went wrong! "]);
        }
    }
}