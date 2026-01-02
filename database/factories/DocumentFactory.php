<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition(): array
    {
        $fileTypes = ['pdf', 'docx', 'xlsx', 'jpg'];

        $fileType = $this->faker->randomElement($fileTypes);
        $fileName = $this->faker->words(3, true) . '.' . $fileType;

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'file_name' => $fileName,
            'file_path' => 'documents/' . Str::random(10) . '.' . $fileType,
            'file_type' => $fileType,
            'file_size' => $this->faker->numberBetween(10_000, 5_000_000), // bytes
            'user_id' => User::factory(), // otomatis buat user
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}