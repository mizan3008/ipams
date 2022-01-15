<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_view_a_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/dashboard');
    }

    /**
     * @test
     */
    public function user_can_login_with_correct_credentials()
    {
        $password = 'password';

        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        $response = $this->post('/authenticate', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->from('/login')->post('/authenticate', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * @test
     * @dataProvider invalidCredentials
     */
    public function user_can_not_login_through_the_form_using_invalid_credentials($invalid_credentials, $expected)
    {
        $response = $this->post('/authenticate', $invalid_credentials);

        $response->assertStatus(302);
        $response->assertSessionHasErrors($expected);
        $this->assertGuest();
    }

    public function invalidCredentials()
    {
        return [
            [
                ['password' => 'password'],
                ['email']
            ],
            [
                ['email' => 'admin@example', 'password' => 'password'],
                ['email']
            ],
            [
                ['email' => 'admin@example.com', 'password' => ''],
                ['password']
            ],
            [
                ['email' => 'admin@example.com', 'password' => '1234'],
                ['password']
            ]
        ];
    }
}
