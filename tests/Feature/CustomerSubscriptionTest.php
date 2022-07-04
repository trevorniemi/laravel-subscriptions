<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class CustomerSubscriptionTest extends TestCase
{
    /**
     * Test that the customer subscription list returns status 200
     *
     * @return void
     */

    public function test_creating_individual_subscription_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/api/customer-subscriptions', [
            'id' => 99999999,
            'subscription_id' => 10,
            'customer_id' => 10,
            'quantity' => 1,
            'status' => "active",
            'frequency' => "monthly",
            'term' => "6",
            'price' => "100.00",
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_individual_subscription_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/customer-subscriptions/99999999');

        $response->assertOk();
    }

    public function test_editing_individual_subscription_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->putJson('/api/customer-subscriptions/99999999', ['frequency' => 'yearly']);

        $response->assertOk();
    }

    public function test_deleting_individual_subscription_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->delete('/api/customer-subscriptions/99999999');

        $response->assertOk();
    }

    public function test_customer_subscriptions_list_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/customer-subscriptions');

        $response->assertOk();
    }
}
