<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedores;
use Illuminate\Support\Str;

class FornecedoresSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 registros de Fornecedores com o Factory
        Fornecedores::factory(10)->create();
    }
} 
