<?php

namespace Database\Factories;

use App\Models\Api\PermanentModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermanentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PermanentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id'  => 1,
            'device_name'  => $this->faker->name(),
            'serial_number' => $this->faker->name(),
            'temp_device_id'  => $this->faker->name(),
            'status'  => 'offline',
            'retry'  => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }

    public function published()
    {
        return $this->state(function (array $attributes){
            return [
                'publish' => true,
            ];
        });
    }
}
