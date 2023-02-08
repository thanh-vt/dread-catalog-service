<?php


namespace App\Services;


use DateInterval;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
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
            throw new RuntimeException('Cannot fetch JWKS from url: ' . env('JWKS_URL'));
        }
    }

    /**
     * @return array
     */
    public function getJwks(): array
    {
        if (!isset($this->jwks)) {
            if (Redis::exists('JWKS')) {
                $jwksStr = Redis::get('JWKS');
                $this->jwks = json_decode($jwksStr);
            } else {
                $jwks = $this->fetchJwks();
                $jwksStr = json_encode($jwks);
                Redis::set('JWKS', $jwksStr, null, new DateInterval( "PT24H" )); // 24 hours
                $this->jwks = $jwks;
            }
        }
        return $this->jwks;
    }
}
