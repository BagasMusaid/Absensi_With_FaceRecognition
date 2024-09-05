<?php

namespace Database\Factories;

use App\Models\master_data\Walikelas;
use App\Models\presensi\Guru;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\master_data\walikelas>
 */
class WalikelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static ?string $password;
    protected $model = Walikelas::class;
    public function definition(): array
    {
        return [
            'guru_id' => Guru::factory(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
