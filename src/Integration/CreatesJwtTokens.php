<?php

/*
 * Open Source
 */

namespace M1guelpf\Integration;

use Lcobucci\JWT\Token;
use Lcobucci\JWT\Builder as JWT;
use Lcobucci\JWT\Signer\Rsa\Sha256;

trait CreatesJwtTokens
{
    /**
     * Create a new JWT token.
     *
     * @return JWT
     */
    protected function createToken() : Token
    {
        return (new JWT)
             ->setIssuer(config('github.application.id'))
             ->setIssuedAt(time())
             ->setExpiration(time() + 60)
             ->sign(new Sha256(), config('github.application.pem'))
             ->getToken();
    }
}
