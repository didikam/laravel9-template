<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      $title = $this->faker->sentence;
      $slug = Str::slug($title);
      $status = ['draft', 'published'];
      return [
         'title' => $title,
         'slug' => $slug,
         'description' => $this->faker->paragraph,
         'image' => $this->faker->imageUrl(640, 480, 'news', true),
         'status' => $status[rand(0, 1)],
      ];
    }
}
