<?php
namespace Tests\Feature;

use App\Http\Resources\CustomerResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;

class CustomerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Helper method to generate customer data
    private function generateCustomerData()
    {
        $accountNo = '';
        for ($i = 0; $i < 3; $i++) {
            $segment = str_pad($this->faker->numberBetween(1, 999999999), 9, '0', STR_PAD_LEFT);
            $accountNo .= $segment;
        }
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
            'phone_number' => '0913' . $this->faker->unique()->numberBetween(1000000, 9999999),
            //'phone_number' => '09368211959',
            'email' => $this->faker->unique()->safeEmail,
            //'bank_account_number' => $this->faker->randomNumber(24),
            'bank_account_number' => $accountNo,
        ];
    }

    /** @test */
    public function it_can_create_a_customer()
    {
        $customerData = $this->generateCustomerData();
        $response = $this->post('/api/customer', $customerData, ['accept' => 'application/json']);

        $response->assertStatus(201)
            ->assertJson(['success' => true])
            ->assertJson(['message' => 'Customer created successfully']);

        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseHas('customers', ['email' => $customerData['email']]);
    }

    /** @test */
    public function it_can_read_a_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->get("/api/customer/{$customer->id}");

        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJsonStructure(['customer']);
    }

    /** @test */
    public function it_can_update_a_customer()
    {
        $customer = Customer::factory()->create();
        $updatedData = $this->generateCustomerData();

        $response = $this->put("/api/customer/{$customer->id}", $updatedData, ['accept' => 'application/json']);

        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJson(['message' => 'Customer updated successfully']);

        $this->assertDatabaseHas('customers', ['id' => $customer->id, 'email' => $updatedData['email']]);
    }

    /** @test */
    public function it_can_delete_a_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->delete("/api/customer/{$customer->id}", [], ['accept' => 'application/json']);

        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJson(['message' => 'Customer deleted successfully']);

        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
