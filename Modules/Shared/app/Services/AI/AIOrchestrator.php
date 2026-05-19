<?php

namespace Modules\Shared\Services\AI;

use Modules\Employee\Services\EmployeeAIService;

class AIOrchestrator
{
    public function __construct(
        protected AIService $aiService
    ) {}

    /**
     * Main AI handler
     */
    public function handle(string $prompt, $user = null): array
    {
        /*
        |--------------------------------------------------------------------------
        | Detect Module
        |--------------------------------------------------------------------------
        */

        $module = $this->detectModule($prompt);

        /*
        |--------------------------------------------------------------------------
        | Route To Module Service
        |--------------------------------------------------------------------------
        */

        $result = match ($module) {

            'employee' => app(EmployeeAIService::class)
                ->handle($prompt, $user),

            default => [
                'success' => false,
                'message' => 'Sorry, I could not understand your request.',
            ],
        };

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        if (! $result['success']) {
            return $result;
        }

        /*
        |--------------------------------------------------------------------------
        | Ask Groq AI
        |--------------------------------------------------------------------------
        */

        $aiResponse = $this->aiService->ask(
            $result['ai_prompt']
        );

        /*
        |--------------------------------------------------------------------------
        | Final Response
        |--------------------------------------------------------------------------
        */

        return [
            'success' => true,

            'module' => $module,

            'type' => $result['type'] ?? null,

            'data' => $result['data'] ?? [],

            'response' => $aiResponse,
        ];
    }

    /**
     * Detect module from prompt
     */
    protected function detectModule(string $prompt): ?string
    {
        $prompt = strtolower($prompt);

        $employeeKeywords = [
            'employee',
            'employees',
            'staff',
            'attendance',
            'salary',
            'payroll',
            'leave',
            'worker',
            'workers',
            'hr',
        ];

        foreach ($employeeKeywords as $keyword) {
            if (str_contains($prompt, $keyword)) {
                return 'employee';
            }
        }

        return null;
    }
}
