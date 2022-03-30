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
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('jwt', function (Request $request) {
            Log::info("token " . $request->bearerToken());
//            $publicKey = <<<EOD
//-----BEGIN PUBLIC KEY-----
//MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8kGa1pSjbSYZVebtTRBLxBz5H
//4i2p/llLCrEeQhta5kaQu/RnvuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t
//0tyazyZ8JXw+KgXTxldMPEL95+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4
//ehde/zUxo6UvS7UrBQIDAQAB
//-----END PUBLIC KEY-----
//EOD;

//            $privateKey = <<<EOD
//-----BEGIN RSA PRIVATE KEY-----
//MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
//vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
//5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
//AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
//bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
//Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
//cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
//5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
//ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
//k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
//qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
//eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
//B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
//-----END RSA PRIVATE KEY-----
//EOD;
//            $payload = array(
//                "iss" => "example.org",
//                "aud" => "example.com",
//                "iat" => 1356999524,
//                "nbf" => 1357000000
//            );
//            $jwt = JWT::encode($payload, $privateKey, 'RS256');
//            Log::info('JWT '.$jwt);
//            $decoded = JWT::decode($request->bearerToken(), new Key($publicKey, 'RS256'))
            $jwks = $this->app->get(ConfigService::class)->getJwks();
            if ($request->bearerToken() == null) {
                return null;
            }
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
