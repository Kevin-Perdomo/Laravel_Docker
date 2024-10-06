<?php

namespace Database\Factories;

use App\Models\Fornecedores;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FornecedoresFactory extends Factory
{
    protected $model = Fornecedores::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->company,
            'site' => $this->faker->url,
            'uf' => $this->faker->stateAbbr,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
