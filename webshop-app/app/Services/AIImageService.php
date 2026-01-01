<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIImageService
{
    private string $apiToken;
    private string $apiUrl = 'https://api.replicate.com/v1';

    public function __construct()
    {
        $this->apiToken = config('services.replicate.token');
    }

    /**
     * Generate an AI image from a text prompt
     */
    public function generateImage(string $prompt): ?string
    {
        if (!$this->apiToken) {
            \Log::warning('Replicate API token not configured. Using placeholder image.');
            return null;
        }

        try {
            // Create a prediction with Stable Diffusion
            $response = Http::withToken($this->apiToken)
                ->post("{$this->apiUrl}/predictions", [
                    'version' => 'db21e45d3f7023abc9e46f0be655e0eac1cabf46d12888ba36ec20f2f9bec8c4',
                    'input' => [
                        'prompt' => $prompt,
                        'negative_prompt' => 'low quality, blurry, distorted, ugly',
                        'num_outputs' => 1,
                        'num_inference_steps' => 25,
                        'guidance_scale' => 7.5,
                    ]
                ]);

            if (!$response->successful()) {
                \Log::error('Replicate API error: ' . $response->body());
                return null;
            }

            $predictionId = $response->json('id');

            if (!$predictionId) {
                \Log::error('No prediction ID returned from API');
                return null;
            }

            // Poll for completion
            return $this->waitForCompletion($predictionId);
        } catch (\Exception $e) {
            \Log::error('AI Image generation failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Poll until the prediction is complete
     */
    private function waitForCompletion(string $predictionId, int $maxAttempts = 60): ?string
    {
        for ($i = 0; $i < $maxAttempts; $i++) {
            try {
                $response = Http::withToken($this->apiToken)
                    ->get("{$this->apiUrl}/predictions/{$predictionId}");

                $status = $response->json('status');

                if ($status === 'succeeded') {
                    $output = $response->json('output');
                    if (is_array($output) && !empty($output)) {
                        return $output[0];
                    }
                }

                if ($status === 'failed') {
                    \Log::error('Prediction failed: ' . json_encode($response->json('error')));
                    return null;
                }

                // Wait 2 seconds before polling again
                sleep(2);
            } catch (\Exception $e) {
                \Log::error('Polling failed: ' . $e->getMessage());
                return null;
            }
        }

        \Log::warning('Image generation timeout after ' . ($maxAttempts * 2) . ' seconds');
        return null;
    }
}
