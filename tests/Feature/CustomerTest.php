<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class CustomerTest extends TestCase
{
    /**
     * Test that the customer list returns status 200
     *
     * @return void
     */

    public function test_creating_individual_customer_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/api/customers', ['id' => 99999999, 'name' => 'Test Customer 1', 'email' => 'testcustomer@example.com']);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_individual_customer_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/customers/99999999');

        $response->assertOk();
    }

    public function test_editing_individual_customer_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->putJson('/api/customers/99999999', ['name' => 'Test Customer 2']);

        $response->assertOk();
    }

    public function test_deleting_individual_customer_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->delete('/api/customers/99999999');

        $response->assertOk();
    }

    public function test_customers_list_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/customers');

        $response->assertOk();
    }
}
