<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=> $this->faker->unique()->name(),
            "author"=> $this->faker->name(),
            "about"=> $this->faker->text(),
            "filename"=> $this->faker->name(),
            "covername"=> $this->faker->name()
        ];
    }
}
