<?php

namespace Database\Factories;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Admin User',
            'lastName' => 'atefi',
            'mobileNumber' => '09160055185',
//            'email' => 'admin@example.com',
            'employeeID' => 600,
            'unitID' => 2,
            'employmentTypeID' => 2,
            'birthday' => '2024-10-10',
            'gender' => 'male',
            'isActive' => 1,
            'role_id' => 0,
            'nationalCode' => 1234567,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
