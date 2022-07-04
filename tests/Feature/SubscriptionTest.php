<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class SubscriptionTest extends TestCase
{
    /**
     * Test that the subscription list returns status 200
     *
     * @return void
     */

    public function test_creating_individual_subscription_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/api/subscriptions', [
            'id' => 99999999,
            'name' => "Test Subscripiton",
            'price' => "90.00",
            'frequency' => 'Monthly',
            'company_id' => 1,
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

        $response = $this->get('/api/subscriptions/99999999');

        $response->assertOk();
    }

    public function test_editing_individual_subscription_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->putJson('/api/subscriptions/99999999', ['name' => 'Test Subscription 2']);

        $response->assertOk();
    }

    public function test_deleting_individual_subscription_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->delete('/api/subscriptions/99999999');

        $response->assertOk();
    }

    public function test_subscriptions_list_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/subscriptions');

        $response->assertOk();
    }
}
