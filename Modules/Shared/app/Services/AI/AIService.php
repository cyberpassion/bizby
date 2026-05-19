<?php

namespace Modules\Shared\Services\AI;

use OpenAI;

class AIService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::factory()
            ->withApiKey(env('GROQ_API_KEY'))
            ->withBaseUri(env('GROQ_BASE_URL'))
            ->make();
    }

    public function ask($prompt)
    {
        $response = $this->client->chat()->create([
            'model' => 'llama-3.1-8b-instant',

            'messages' => [
                [
                    'role' => 'system',
                    'content' => '
You are an intelligent SaaS analytics assistant.

Rules:
- Analyze only provided data
- Do not invent information
- Keep responses concise and professional
- If data is insufficient, say so clearly
',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],

            'temperature' => 0.7,
            'max_tokens' => 1000,
        ]);

        return $response->choices[0]->message->content;
    }
}
