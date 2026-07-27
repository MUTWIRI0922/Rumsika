<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminAuthMiddlewareTest extends TestCase
{
    public function test_admin_routes_redirect_when_admin_guard_is_not_authenticated(): void
    {
        $response = $this->get('/test-admin-middleware');

        $response->assertRedirect('/adminsrstrd/login');
    }

    public function test_admin_routes_allow_access_when_admin_guard_is_authenticated(): void
    {
        $user = new User(['id' => 1, 'email' => 'admin@example.com']);
        Auth::guard('admin')->login($user);

        $response = $this->get('/test-admin-middleware');

        $response->assertOk();
        $response->assertSee('ok');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app['router']->middleware('admin.auth')->group(function () {
            $this->app['router']->get('/test-admin-middleware', function () {
                return 'ok';
            });
        });
    }
}
