<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WizardCatController extends Controller
{
    public function respond(Request $request)
    {
        $user_msg = $request->input('message');
        
        if (!$user_msg) {
            return response()->json(['reply' => 'Please say something, young adventurer! 🪄'], 400);
        }
        $apiKey = env('GEMINI_API_KEY');
        
        if (!$apiKey) {
            return response()->json(['reply' => '🐾 Wizard Cat needs magical powers! Please add GEMINI_API_KEY to .env'], 500);
        }

        $systemPrompt = env('AI_SYSTEM_PROMPT', 'You are a wise and friendly Wizard Cat who speaks kindly and gives comforting advice');
        
        $response = Http::timeout(30)->post(

            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}",
[
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemPrompt . "\n\nUser: " . $user_msg]
                        ]
                    ]
                ],
                
            ]
        );

        if ($response->failed()) {
            Log::error('Gemini API Error: ' . $response->body());
            return response()->json(['reply' => '🐾 Wizard Cat is napping. Try again later!'], 500);
        }

        $reply = $response->json('candidates.0.content.parts.0.text') ?? 'Meow? 🐱';

        return response()->json(['reply' => trim($reply)]);
    }
}