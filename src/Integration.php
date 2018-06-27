<?php

/*
 * Written by Miguel Piedrafita <soy@miguelpiedrafita.com>
 */

namespace M1guelpf;

use Github\Client as GitHub;
use Illuminate\Support\Traits\Macroable;
use M1guelpf\Integration\CreatesJwtTokens;
use M1guelpf\Integration\AuthenticatesApplications;

class Integration
{
    use CreatesJwtTokens, AuthenticatesApplications, Macroable;

    /**
     * @var \Lcobucci\JWT\Token
     */
    protected static $jwt;

    /**
     * @var GitHub
     */
    protected $github;

    /**
     * Create a new Integration instance.
     *
     * @param GitHub|null $client
     *
     * @return void
     */
    public function __construct(GitHub $client = null)
    {
        $this->github = $client ?? new GitHub(null, 'machine-man-preview');
        static::$jwt = $this->createToken();
    }

    /**
     * Use am specific Client.
     *
     * @return self
     */
    public function withClient(GitHub $client = null) : self
    {
        $this->github = $client ?? new GitHub(null, 'machine-man-preview');

        return $this;
    }

    /**
     * Authenticate as an application.
     *
     * @return self
     */
    public function authenticate() : self
    {
        $this->github = $this->authenticateAsApplication($this->github, static::$jwt);

        return $this;
    }

    /**
     * Authenticate as an installation.
     *
     * @param int $installation_id
     *
     * @return self
     */
    public function asInstallation(int $installation_id) : self
    {
        $this->github = $this->authenticateAsInstallation($installation_id, $this->github, static::$jwt);

        return $this;
    }

    /**
     * Access the GitHub API.
     *
     * @param string $name
     *
     * @throws \Github\Exception\InvalidArgumentException
     *
     * @return \Github\Api\ApiInterface
     */
    public function api(string $name) : \Github\Api\ApiInterface
    {
        return $this->github->api($name);
    }
}
