<?php

namespace M1guelpf\Integration\Test;

use Mockery;
use M1guelpf\Integration;
use Github\Client as GitHub;
use M1guelpf\Integration\IntegrationFacade;

class IntegrationTest extends TestCase
{
    /**
     * @test
     */
    public function the_facade_resolves_to_the_class()
    {
        $this->assertInstanceOf(Integration::class, IntegrationFacade::getFacadeRoot());
    }

    /**
     * @test
     */
    public function you_can_get_a_valid_client()
    {
        $integration = new class extends Integration {
            public $github;

            public function __construct(GitHub $client = null)
            {
                parent::__construct($client);
            }
        };

        $this->assertInstanceOf(GitHub::class, $integration->github);
    }

    /**
     * @test
     */
    public function you_can_reuse_the_jwt_token()
    {
        $integration = new class extends Integration {
            public static $jwt;
        };

        $integration2 = new class extends Integration {
            public static $jwt;
        };

        $this->assertNotNull($integration::$jwt);
        $this->assertNotNull($integration2::$jwt);
        $this->assertEquals($integration::$jwt, $integration2::$jwt);
    }

    /**
     * @test
     */
    public function you_can_authenticate_as_an_application()
    {
        $client = Mockery::mock(GitHub::class);

        $client->shouldReceive('authenticate')->once()->withArgs(['Lcobucci\JWT\Token', null, 'jwt'])->andReturnSelf();

        $integration = IntegrationFacade::withClient($client)->authenticate();
    }

    /**
     * @test
     */
    public function you_can_authenticate_as_an_installation()
    {
        $client = Mockery::mock(GitHub::class);

        $client->shouldReceive('api')->once()->withArgs(['apps'])->andReturnSelf();
        $client->shouldReceive('createInstallationToken')->once()->withArgs([1234])->andReturn(['token' => 'token']);
        $client->shouldReceive('authenticate')->once()->withArgs(['token', null, GitHub::AUTH_HTTP_TOKEN])->andReturnSelf();

        $integration = IntegrationFacade::withClient($client)->asInstallation(1234);
    }

    /**
     * @test
     */
    public function you_can_use_the_api_wrapper()
    {
        $client = Mockery::mock(GitHub::class);

        $client->shouldReceive('api')->once()->withArgs(['md-example'])->andReturn(new \Github\Api\Markdown($client));

        $this->assertInstanceOf(\Github\Api\Markdown::class, IntegrationFacade::withClient($client)->api('md-example'));
    }
}
