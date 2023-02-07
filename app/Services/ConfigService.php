<?php


namespace App\Services;


use DateInterval;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Log;
use RuntimeException;

class ConfigService
{
    private array $jwks;

    public function __construct()
    {
    }


    public function fetchJwks(): array|null
    {
        $response = Http::get(env('JWKS_URL'));
        $response->onError(function ($error) {
            Log::info('Error fetch jwks', $error);
        });
        $jwks = $response->json();
        if ($response->ok()) {
            Log::info('Fetched Jwks: ', $jwks);
            return $jwks;
        } else {
            Log::info('Response: ', $jwks);
            return null;
        }
    }

    /**
     * @return array
     */
    public function getJwks(): array
    {
        if (!isset($this->jwks)) {
            if (Cache::has('jwks')) {
                $this->jwks = Cache::get('jwks');
            } else {
                $jwks = $this->fetchJwks();
                if ($jwks == null) throw new RuntimeException('Cannot fetch JWKS from url: ' . env('JWKS_URL'));
                Cache::put('jwks', $jwks, new DateInterval( "P5M" ));
                $this->jwks = $jwks;
            }
        }
        return $this->jwks;
    }
}
