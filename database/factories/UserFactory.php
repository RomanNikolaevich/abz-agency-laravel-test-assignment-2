<?php

namespace Database\Factories;

use App\Models\Position;
use App\Services\GenerateUkrainianPhoneNumberService;
use App\Services\ImageProcessing\ImageProcessorService;
use App\Services\ImageProcessing\Strategies\UrlImageSourceService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'remember_token' => Str::random(10),
            'photo' => $this->generateRandomUserPhoto(),
            'phone' => $this->generateUkrainianPhoneNumber(),
            'position_id' => Position::inRandomOrder()->first()->id,
        ];
    }

    private function generateUkrainianPhoneNumber(): string
    {
        $service = new GenerateUkrainianPhoneNumberService();

        return $service();
    }

    private function generateRandomUserPhoto(): string
    {
        $imageSource = new UrlImageSourceService('https://thispersondoesnotexist.com/');
        $processor = new ImageProcessorService($imageSource);

        try {
            return $processor->processAndStoreImage();
        } catch (\Exception $e) {
            \Log::error('Error generating user photo: ' . $e->getMessage());
            return 'images/users/default.jpeg';
        }
    }
}
