<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class CompanyTest extends TestCase
{
    /**
     * Test that the companies list returns status 200
     *
     * @return void
     */

    public function test_creating_individual_companies_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/api/companies', ['id' => 99999999, 'name' => 'Test Company 1', 'user_id' => 1]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_individual_companies_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/companies/99999999');

        $response->assertOk();
    }

    public function test_editing_individual_companies_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->putJson('/api/companies/99999999', ['name' => 'Test Company 2']);

        $response->assertOk();
    }

    public function test_deleting_individual_companies_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->delete('/api/companies/99999999');

        $response->assertOk();
    }

    public function test_companies_list_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/companies');

        $response->assertOk();
    }
}
