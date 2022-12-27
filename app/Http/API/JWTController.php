<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use http\Url;
use Throwable;

class JWTController extends Controller
{

    private const FILE_NAME = "apiKey.csv";
    private string $JWT;

    private function generateJWT()
    {
        try {

            [$identity, $secret_key] = $this->getCredentials();

        }catch (Throwable $e) {
//            Дописать тригер на ошибку
            report($e);

            return false;
        }

        $this->JWT = $this->JWT($identity, $secret_key);
    }

    /**
     * @throws \Exception
     */
    private function getCredentials() : array
    {
        $file_path = storage_path("app/private/").self::FILE_NAME;
        if(file_exists($file_path)) {
            $row = 0;
            if (($handle = fopen($file_path, 'rb')) !== FALSE) {
                while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                    $row++;
                    foreach ($data as $cValue) {
                        if ($row === 2) {
                            fclose($handle);
                            return explode(';', $cValue);
                        }
                    }
                }
            }

//            If the key wasn't found
            throw new \Exception("Invalid credentials");
        }
//            If the file wasn't found
        throw new \Exception("File Not Found");
    }


    private function base64url_encode($data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function JWT($identity, $secret): string
    {
//            Identity key
            $iss = $identity;
//            Live time for JWT token
            $iat = time();
//           Expiration time for JWT,maximum 64 seconds
//          $iat < $exp - TIME <= 64
            $exp = $iat + 60;
            $header = base64_encode('{
                "typ": "JWT",
                "alg": "HS512"
              }');
            $payload = base64_encode('{"iat": '. time() .', "iss": "'. $identity.'", "exp": '. $exp.'}');
            $signature = $this->base64url_encode(hash_hmac('sha512', $header .'.'. $payload , $secret, true));
            return $header .'.'. $payload .'.'. $signature;

    }

    public function __toString(): string
    {
        $this->generateJWT();
        return $this->JWT;
    }
}
