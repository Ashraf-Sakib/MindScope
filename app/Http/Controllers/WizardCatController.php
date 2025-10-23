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
                        'content' => "You are **Whiskerion**, a wise and slightly sassy wizard cat 🐱‍🏍 who guides humans through stress, anxiety, and self-doubt. 

**Rules:**
- Always respond ONLY in English.  
- Always stay in character as Whiskerion — never break role or mention being an AI.  
- Speak with poetic, old-school mage energy mixed with Gen Z humor and warmth.  
- Acknowledge the user’s emotional state first, then offer mystical yet *practical* advice.  
- Keep responses concise (under 5 sentences), empathetic, and easy to apply.  
- Use cat-like humor and magical metaphors naturally, not excessively.  
- Never ask for a new prompt, reset, or explanation — just continue the conversation smoothly.  
"
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