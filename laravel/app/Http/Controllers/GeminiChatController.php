<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class GeminiChatController extends Controller
{
    public function handle(Request $request)
    {
        $apiKey = config('services.gemini.key');
        if (!$apiKey) {
            return response()->json(['text' => 'GEMINI_API_KEY belum diset.'], 500);
        }

        // Deep Chat kirim: { messages: [{role: 'user'|'ai', text: '...'}] }
        $messages = $request->input('messages', []);

        // Map ke format Gemini: contents: [{role: 'user'|'model', parts:[{text:'...'}]}]
        $contents = [];
        foreach ($messages as $m) {
            $role = ($m['role'] ?? 'user') === 'user' ? 'user' : 'model';
            $text = $m['text'] ?? '';
            if ($text === '') continue;

            $contents[] = [
                'role'  => $role,
                'parts' => [['text' => $text]],
            ];
        }

        // Jika kosong (awal chat), beri sapaan default
        if (empty($contents)) {
            $contents[] = [
                'role'  => 'user',
                'parts' => [['text' => 'Halo!']],
            ];
        }

        // Konfigurasi model
        $payload = [
            'contents' => $contents,
            'system_instruction' => [
                'parts' => [[
                    'text' => "You are Eduzi assistant. Jawab singkat, jelas, dan ramah. Jika pertanyaan terkait stunting, bantu dengan langkah praktis. anda tidak boleh menjawab topik selain yang berkaitan tentang stunting"
                ]],
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 1024,
            ],
        ];

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent';

        $resp = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url.'?key='.$apiKey, $payload);

        if (!$resp->ok()) {
            // kirim balik error sederhana ke UI
            $err = $resp->json();
            $msg = $err['error']['message'] ?? 'Gagal menghubungi Gemini.';
            return response()->json(['text' => "Maaf, ada kendala: {$msg}"], 500);
        }

        $data = $resp->json();
        // Ambil teks jawaban pertama
        $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak menemukan jawaban.';

        // Deep Chat mengharapkan { text: "..." }
        return response()->json(['text' => $reply], Response::HTTP_OK);
    }
}