<?php


namespace Database\Factories;

use App\Models\Clinic;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClinicFactory extends Factory
{
    protected $model = Clinic::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
'department_id' => Department::factory(), ];
    }
}
