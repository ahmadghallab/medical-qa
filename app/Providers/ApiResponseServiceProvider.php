<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $response = app(ResponseFactory::class);

        $response->macro('success', function ($status, $data = null) use ($response) {
            $responseData = [
                'success' => true,
                'status' => $status,
                'data' => $data
            ];

            return $response->json($responseData, $status);
        });

        $response->macro('error', function ($status, $error) use ($response) {

            return $response->json([
                'success' => false,
                'status' => $status,
                'message' => $error,
            ], $status);
        });
    }
}
