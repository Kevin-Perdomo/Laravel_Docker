<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;
    
    // Garante que o Eloquent ORM não vai errar o plural do nome da classe
    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'uf', 'e-mail'];

}
