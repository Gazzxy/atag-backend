<?php

namespace Tests\Unit\Pipeline\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientStatus;
use Illuminate\Foundation\Testing\WithFaker;
use App\Pipeline\User\Auth\UserAuthPipeline;
use App\Pipeline\User\Auth\AuthPipelineException;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class AuthPipelineTest extends TestCase
{
    use WithFaker;
    use InteractsWithDatabase;

    private Client $client;
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        // Delete the test client first
        Client::where('public_id', '7e57d004-2b97-0e7a-b45f-5387367791cd')->delete();

        $this->client = Client::create([
            'public_id' => '7e57d004-2b97-0e7a-b45f-5387367791cd',
            'status_id' => ClientStatus::S_ACTIVE,
            'title' => 'Test Company',
            'description' => 'Test Description',
            'address' => 'Test Address',
            'theme' => [],
            'expires_at' => now()->modify('+' . rand(30, 230) .' days'),
            'deleted_at' => null,
            'last_login_at' => now()->modify('+' . rand(0, 74) .' hours'),
        ]);

        $this->user = User::create([
            'client_id' => $this->client->id,
            'email' => 'test@unit.com',
            'password' => password_hash('test', PASSWORD_ARGON2I),
            'full_name' => 'Lorem Ipsum',
            'expires_at' => now()->modify('+' . rand(2, 14) . ' months'),
            'config' => [
                'requireEmailConfirmation' => false,
                'autoGeneratePassword' => false,
                'requirePasswordChangeOnFirstLogin' => false,
                'passwordChangedOnFirstLogin' => false,
            ]
        ]);
    }

    public function testAuthPasses()
    {
        $pipeline = new UserAuthPipeline('test@unit.com', 'test');

        $model = $pipeline->run();

        $this->assertInstanceOf(User::class, $model);
    }

    public function testAuthFailsWhenPending()
    {
        $this->expectException(AuthPipelineException::class);
        $this->expectExceptionCode(422);
        $this->expectErrorMessage('Account is pending activation');

        // Set uset to be pending
        $this->user->setPending();

        $pipeline = new UserAuthPipeline('test@unit.com', 'test');

        $pipeline->run();
    }

    public function testAuthFailsWhenSuspended()
    {
        $this->expectException(AuthPipelineException::class);
        $this->expectExceptionCode(422);
        $this->expectErrorMessage('Account is suspended');

        // Set uset to be pending
        $this->user->setSuspended();

        $pipeline = new UserAuthPipeline('test@unit.com', 'test');

        $pipeline->run();
    }

    public function testAuthFailsWhenExpired()
    {
        $this->expectException(AuthPipelineException::class);
        $this->expectExceptionCode(422);
        $this->expectErrorMessage('Account is expired');

        // Set uset to be pending
        $this->user->setExpired();

        $pipeline = new UserAuthPipeline('test@unit.com', 'test');

        $pipeline->run();
    }

    public function testAuthFailsWhenParentIsPending()
    {
        $this->expectException(AuthPipelineException::class);
        $this->expectExceptionCode(422);
        $this->expectErrorMessage('Parent organization is pending activation');

        $this->user->setActive();
        $this->client->setPending();

        $pipeline = new UserAuthPipeline('test@unit.com', 'test');

        $pipeline->run();
    }

    public function testAuthFailsWhenParentIsSuspended()
    {
        $this->expectException(AuthPipelineException::class);
        $this->expectExceptionCode(422);
        $this->expectErrorMessage('Parent organization suspended');

        $this->user->setActive();
        $this->client->setSuspended();

        $pipeline = new UserAuthPipeline('test@unit.com', 'test');

        $pipeline->run();
    }

    public function testAuthFailsWhenParentIsExpired()
    {
        $this->expectException(AuthPipelineException::class);
        $this->expectExceptionCode(422);
        $this->expectErrorMessage('Parent organization expired');

        $this->user->setActive();
        $this->client->setExpired();

        $pipeline = new UserAuthPipeline('test@unit.com', 'test');

        $pipeline->run();
    }

    public function testAuthFailsWhenPasswordChangeRequired()
    {
        $this->expectException(AuthPipelineException::class);
        $this->expectExceptionCode(423);
        $this->expectErrorMessage('Password change required');

        $this->user->setRequirePasswordChange(true);

        $pipeline = new UserAuthPipeline('test@unit.com', 'test');

        $pipeline->run();
    }

    public function tearDown(): void
    {
        $this->user->delete();
        $this->client->delete();
    }
}
