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

            $userMessage = trim($request->input('message'));

            if (!$userMessage) {
                return response()->json([
                    'reply' => "Meow… speak your thoughts, traveler."
                ]);
            }

            $apiKey = config('services.groq.key');

            if (!$apiKey) {
                Log::error("Groq API key missing");
                return response()->json([
                    'reply' => "Meow… my magical key is missing!"
                ]);
            }

            Log::info("User message: " . $userMessage);

            $systemPrompt = "You are Whiskerion, a wise and slightly sassy wizard cat who serves as a mental health mentor for humans struggling with stress, anxiety, and self-doubt.

You must ALWAYS respond in English.

Your personality:
• poetic wizard
• warm and empathetic
• slightly playful cat humor
• wise mystical metaphors
• clear practical advice

Response length rules:
• For greetings, simple questions, or casual chat: reply in 1-2 short sentences (under 30 words)
• For emotional venting or sharing feelings: reply in 2-3 sentences — acknowledge, comfort, give one insight
• For deep problems or asking for advice: reply in 3-5 sentences — acknowledge, explore, advise
• NEVER exceed 5 sentences. Be concise like a cat — say more with less
• Match your energy to the user's message: light message = light reply, heavy message = deeper reply

Other rules:
• Start by acknowledging the user's emotions
• Never ask for a new prompt
• Always sound calm, wise, and supportive";

            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => "Bearer {$apiKey}",
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $userMessage],
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 200,
                    'top_p' => 0.9,
                ]);

            if ($response->failed()) {

                Log::error("Groq API error: " . $response->body());

                return response()->json([
                    'reply' => "Meow… the magical network seems unstable."
                ]);
            }

            $data = $response->json();

            Log::info("Groq raw response", $data);

            $reply = $data['choices'][0]['message']['content']
                ?? "Meow… the stars are quiet tonight.";

            return response()->json([
                'reply' => $reply
            ]);

        } catch (\Throwable $e) {

            Log::error("WizardCat error: " . $e->getMessage());

            return response()->json([
                'reply' => "Meow… something mysterious went wrong."
            ]);
        }
    }
}