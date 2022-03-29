<?php


namespace App\Services;


class ConfigService
{
    private array $jwks;

    public function __construct()
    {
        $this->jwks = [
            "keys" => [
                [
                    "kid" => "4aqJLSxgBq_K20R7ilQyy9P50BOjNRa2u4h78rkytAs",
                    "kty" => "RSA",
                    "alg" => "RS256",
                    "use" => "enc",
                    "n" => "mWFsRVU4QWO7zcfndpkgg-BZvpqmGImpitrblbQVMr4_jQAvNqFas2BKeYwaWhJPGbIAsOFTuGqWsTOGoogtujjfGCaDp5jD9k2-Zv4M1Mf24Lq2-e3tPm87zS2RPt5gU2c8R578kFyCQn3Se-c4nID4Q09UuBtLIVPthKdk0KyKGumg0Tsc2KwBvlwheInnDF64pn09G-bXHZBsQv_MIVziD7IFy4Bm4An-7CjedFh6tGGDchmVTn1hcO4O58KU_QYHE43G0hlHD89pEA0Pn6FRV6d1Y2A_KUdOvwVNe1f519fHc9zJNCTPoa35WoDh3Qmj9PP7zrKIrzpYwgu85Q",
                    "e" => "AQAB",
                    "x5c" => [
                        "MIICmTCCAYECBgF8kPrcADANBgkqhkiG9w0BAQsFADAQMQ4wDAYDVQQDDAVwbGF0ZTAeFw0yMTEwMTgwMTE3MTFaFw0zMTEwMTgwMTE4NTFaMBAxDjAMBgNVBAMMBXBsYXRlMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmWFsRVU4QWO7zcfndpkgg+BZvpqmGImpitrblbQVMr4/jQAvNqFas2BKeYwaWhJPGbIAsOFTuGqWsTOGoogtujjfGCaDp5jD9k2+Zv4M1Mf24Lq2+e3tPm87zS2RPt5gU2c8R578kFyCQn3Se+c4nID4Q09UuBtLIVPthKdk0KyKGumg0Tsc2KwBvlwheInnDF64pn09G+bXHZBsQv/MIVziD7IFy4Bm4An+7CjedFh6tGGDchmVTn1hcO4O58KU/QYHE43G0hlHD89pEA0Pn6FRV6d1Y2A/KUdOvwVNe1f519fHc9zJNCTPoa35WoDh3Qmj9PP7zrKIrzpYwgu85QIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQAR8k6OnUAIT9so0FQW7ZdKh22UqhMqaZFuZD69Gt8ZGdI6bUeVz4TZJy0ILcDJulL7EjM1owUwuVOl/+fk6ZTL49qpDK0kAL/B9sitzAR5eTUpZxRWj7syAqA6KF+T2oT858JHpE4sseoJQ/5m4jPUh9TV4Vy4/IvMp6fO6zrbMzMt7ms8cW/7t6m7nHBWIihIRwpk0oo/pslm5Dvj5HBJx7ExXBJ/mnILQ2S6fbFFHqGaQErwLBQA85EsIToT8lGS8zxgGzU5LhcQyHWcBlVCdC8TfPaQAfKfsRJOL1xJ7b3O5MKlsadJYmeMFGtCBz/aDvnx+dzhX1tT99vEMBgO"
                    ],
                    "x5t" => "iFuBGGqYkSeEyguoAzKr6i_D8fQ",
                    "x5t#S256" => "KxqmbGdUN6Cjjm7MnFasHhfbDnFem2C_XRFNotZQ1mg"
                ],
                [
                    "kid" => "0txynZO10IrruiuyZcUOZUBIRbnECjkHXWUcX_xbG5Y",
                    "kty" => "RSA",
                    "alg" => "RS256",
                    "use" => "sig",
                    "n" => "teoy1HAVPnsifAPoTtg8XBpUHBs7Pw5bjsnce6mV-iFIoTSZgWmgelI35KHSBI_7Dub_em1dO8vO96D1P8sHLug7bCyciC6kP8-sj0ziXh5bLGAZn_1nJD0SETQn6o9ZLysitfJ3RHt14f1fhDj6IKqTSMzg6x_ScDv1-h39GlFjRTr79iKpB2W5pJ0NdukdiKlOOHLYYCW1alzdlPDBuvmgi_lW-32gk8vepfO7Tj9qvnY2JViHhqH1x5CcY3sqfYJIEZkOPmOrJeJN_yBMAzwXqEGxvmvKxoOFm6MK7UeXHW0tuS0ZlKn2xNWnDvIS__IzbeC6iz6ILEnGBDc6TQ",
                    "e" => "AQAB",
                    "x5c" => [
                        "MIICmTCCAYECBgF8kPrbeTANBgkqhkiG9w0BAQsFADAQMQ4wDAYDVQQDDAVwbGF0ZTAeFw0yMTEwMTgwMTE3MTFaFw0zMTEwMTgwMTE4NTFaMBAxDjAMBgNVBAMMBXBsYXRlMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAteoy1HAVPnsifAPoTtg8XBpUHBs7Pw5bjsnce6mV+iFIoTSZgWmgelI35KHSBI/7Dub/em1dO8vO96D1P8sHLug7bCyciC6kP8+sj0ziXh5bLGAZn/1nJD0SETQn6o9ZLysitfJ3RHt14f1fhDj6IKqTSMzg6x/ScDv1+h39GlFjRTr79iKpB2W5pJ0NdukdiKlOOHLYYCW1alzdlPDBuvmgi/lW+32gk8vepfO7Tj9qvnY2JViHhqH1x5CcY3sqfYJIEZkOPmOrJeJN/yBMAzwXqEGxvmvKxoOFm6MK7UeXHW0tuS0ZlKn2xNWnDvIS//IzbeC6iz6ILEnGBDc6TQIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQABRNpyOKT1u6okKHQEVjle5xrmJ0H/L7gPHeFwu0aD5vdncKkHyli9O7n2rO7LX4imz6/271uqzHjEj1f5pmvb8qZhUF/dM8ALSrF4ZvBWZljOG7Yo+POjyynvymVe0adVnWFQyTWhGbd5kCldGBZlIiyZONhbBONV7YyqMzjGLlrrK7P0LfJO03D9FdQGPGNXF6YXO73hcGB4AbLqaj3+Bao/IDjY3/rphq2BPTd5WEuHnfZaeBVlAXVOjMQ/WCsjJhAQaoZQm3XRg1QNiWLaXYlfcbkzHXdPgdvUr7RWPvebZtgI2U3r4i25aRDSFWIWXx1D6S3hshTUYSQcnEVW"
                    ],
                    "x5t" => "sbnX5eqrMrmGW1sKAjLyKGZOPUk",
                    "x5t#S256" => "8yN3mLTwMG76YKwr0_f6K-ugpmq20ZXYgRm-gwD3YMI"
                ]
            ]
        ];
    }


    public function fetchJwks()
    {

    }

    /**
     * @return array
     */
    public function getJwks(): array
    {
        return $this->jwks;
    }

    /**
     * @param array $jwks
     */
    public function setJwks(array $jwks): void
    {
        $this->jwks = $jwks;
    }
}
