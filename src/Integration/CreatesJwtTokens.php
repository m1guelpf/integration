<?php

/*
 * This file is part of UnMarkDocs.
 *
 * Copyright (c) Miguel Piedrafita - All Rights Reserved
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by Miguel Piedrafita <soy@miguelpiedrafita.com>
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
