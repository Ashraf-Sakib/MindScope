<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WizardCatController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');

        if (!$userMessage) {
            return response()->json(['reply' => "Meow~ Please tell me something! 😺"]);
        }

        try {
            // Gemini API request
            $response = Http::post(env('GEMINI_API_URL') . '?key=' . env('GEMINI_API_KEY'), [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => "You are Wizard Cat 🐱🪄 — a kind, witty, and magical companion who helps users feel better when anxious or sad. 
                            Be conversational and short. User says: " . $userMessage],
                        ],
                    ],
                ],
            ]);

            if ($response->failed()) {
                return response()->json(['reply' => "Meow~ my magic connection failed 😿"]);
            }

            $reply = $response->json('candidates.0.content.parts.0.text') ?? "Meow~ I didn't quite catch that 🐾";

            return response()->json(['reply' => $reply]);
        } catch (\Exception $e) {
            return response()->json(['reply' => "Meow~ my magic wand glitched! 😿"]);
        }
    }
}
