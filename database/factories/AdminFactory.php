<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'avatar' => null,
            'phone' => $this->faker->numerify('0#########'),
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement([0, 1]), // 0 = nam, 1 = nữ
            'experience' => rand(1, 10),
            'department_id' => 1, // hoặc tạo kèm factory nếu có
            'clinic_id' => 1,
            'status' => 1,
            'token_reset_password' => null,
            'token_duration' => null,
        ];
    }
}
