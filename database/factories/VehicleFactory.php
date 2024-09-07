<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $fillable = [
            'type',
            'name',
            'model',
            'length',
            'width',
            'load_capacity',
            'id',
            'created_at',
            'updated_at',
        ];

        return [
            'type' => $this->faker->randomElement(['truck', 'trailer']),
            'name' => $this->faker->company,
            'model' => $this->faker->word,
            'length' => $this->faker->numberBetween(10, 30),
            'width' => $this->faker->numberBetween(5, 10),
            'load_capacity' => $this->faker->numberBetween(1000, 5000),'id' => null,
            'created_at' => null,
            'updated_at' => null,
        ] ;
    }
}