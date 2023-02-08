<?php

namespace App\Providers;

use App\Models\User;
use App\Services\ConfigService;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Auth::viaRequest('jwt', function (Request $request) {
            if ($request->bearerToken() == null) {
                return null;
            }
            Log::info("token " . $request->bearerToken());
            $jwks = $this->app->get(ConfigService::class)->getJwks();
            $decoded = JWT::decode($request->bearerToken(), JWK::parseKeySet($jwks));
            $decodedArray = get_object_vars($decoded);
            Log::info('JWT payload: ' . json_encode($decodedArray, JSON_PRETTY_PRINT));
            return new User([
                'name' => $decodedArray['preferred_username'],
                'email' => $decodedArray['email'],
                'password' => Hash::make('default'),
                'status' => 1,
                'type' => 1
            ]);
        });
    }
}
