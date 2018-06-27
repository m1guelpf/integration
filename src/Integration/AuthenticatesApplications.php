<?php

/*
 * Written by Miguel Piedrafita <soy@miguelpiedrafita.com>
 */

namespace M1guelpf\Integration;

use Github\Client as GitHub;
use Lcobucci\JWT\Token as JWT;

trait AuthenticatesApplications
{
    /**
     * Authenticates as an installation.
     *
     * @param int     $installation_id
     * @param GitHub  $github
     * @param JWT     $jwt
     *
     * @return GitHub
     */
    protected function authenticateAsInstallation(int $installation_id, GitHub $github, JWT $jwt) : GitHub
    {
        $token = $github->api('apps')->createInstallationToken($installation_id);
        $github->authenticate($token['token'], null, GitHub::AUTH_HTTP_TOKEN);

        return $github;
    }

    /**
     * Authenticates as an application.
     *
     * @param GitHub  $github
     * @param JWT     $jwt
     *
     * @return GitHub
     */
    protected function authenticateAsApplication(GitHub $github, JWT $jwt) : GitHub
    {
        $github->authenticate($jwt, null, GitHub::AUTH_JWT);

        return $github;
    }
}
