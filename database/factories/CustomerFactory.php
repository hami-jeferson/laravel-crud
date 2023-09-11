<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
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
            'email' => $this->faker->unique()->safeEmail,
            'bank_account_number' => $accountNo,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
