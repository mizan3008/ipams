<?php

namespace Tests\Feature;

use App\Models\IpAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IPAddressControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function unauthenticated_user_can_not_access_list()
    {
        $response = $this->get('ip-address');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function authenticated_user_can_access_list()
    {
        $this->actingAsUser();

        $response = $this->get('ip-address');
        $response->assertOk();
    }

    /**
     * @test
     */
    public function authenticated_user_can_view_create_ip_page()
    {
        $this->actingAsUser();

        $response = $this->get('ip-address/create');
        $response->assertOk();
    }

    /**
     * @test
     */
    public function unauthenticated_user_can_not_view_create_ip_page()
    {
        $response = $this->get('ip-address/create');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function unauthenticated_user_can_not_create_ip_address()
    {
        $this->assertCount(0, IpAddress::all());

        $response = $this->post('ip-address', $this->data());
        $this->assertCount(0, IpAddress::all());
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function authenticated_user_can_create_ip_address()
    {
        $this->actingAsUser();

        $this->assertCount(0, IpAddress::all());

        $data = $this->data();

        $response = $this->post('ip-address', $data);
        $response->assertRedirect('ip-address');
        $this->assertCount(1, IpAddress::all());
    }

    /**
     * @test
     */
    public function authenticated_user_can_view_edit_ip_page()
    {
        $this->actingAsUser();

        $ipAddress = IpAddress::factory()->create();

        $response = $this->get("ip-address/{$ipAddress->id}/edit");
        $response->assertOk();
    }

    /**
     * @test
     */
    public function unauthenticated_user_can_not_view_edit_ip_page()
    {
        $ipAddress = IpAddress::factory()->create();

        $response = $this->get("ip-address/{$ipAddress->id}/edit");
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function unauthenticated_user_can_not_update_ip_address()
    {
        $ipAddress = IpAddress::factory()->create([
            'label' => 'My Label'
        ]);

        $response = $this->put("ip-address/{$ipAddress->id}", [
            'label' => 'New Label'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $ip = IpAddress::first();
        $this->assertEquals('My Label', $ip->label);
    }

    /**
     * @test
     */
    public function authenticated_user_can_update_ip_address()
    {
        $this->actingAsUser();

        $ipAddress = IpAddress::factory()->create([
            'label' => 'My Label'
        ]);

        $data = $this->data();
        $data['label'] = 'New Label';

        $response = $this->put("ip-address/{$ipAddress->id}", $data);
        $response->assertRedirect('ip-address');
        $ip = IpAddress::first();
        $this->assertEquals('New Label', $ip->label);
    }

    /**
     * @test
     */
    public function authenticate_use_can_not_update_other_users_ip_address()
    {
        $ipAddress = IpAddress::factory()->create([
            'user_id' => 99,
            'created_by' => 99,
        ]);

        $this->actingAsUser();

        $response = $this->put("ip-address/{$ipAddress->id}", $this->data());

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function label_is_required_to_create_ip_address()
    {
        $this->actingAsUser();

        $data = $this->data();
        unset($data['label']);

        $response = $this->post('ip-address', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['label']);
    }

    /**
     * @test
     */
    public function ip_is_required_to_create_ip_address()
    {
        $this->actingAsUser();

        $data = $this->data();
        unset($data['ip_address']);

        $response = $this->post('ip-address', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['ip_address']);
    }

    /**
     * @test
     */
    public function label_is_required_to_update_ip_address()
    {
        $this->actingAsUser();

        $ipAddress = IpAddress::factory()->create();

        $data = $this->data();
        unset($data['label']);

        $response = $this->put("ip-address/{$ipAddress->id}", $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['label']);
    }

    /**
     * @test
     */
    public function user_can_not_create_ip_address_with_duplicate_one()
    {
        $this->actingAsUser();

        $ipAddress = IpAddress::factory()->create();

        $this->assertCount(1, IpAddress::all());

        $data = $this->data();

        $data['ip_address'] = $ipAddress->ip_address;

        $response = $this->post('ip-address', $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('ip_address');
        $this->assertCount(1, IpAddress::all());
    }

    private function data()
    {
        return [
            'label' => 'My Label',
            'ip_address' => '127.0.0.1',
        ];
    }

    private function actingAsUser(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
