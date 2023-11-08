<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;


    protected $fillable = [
        'nombre',
        'telefono',
        'fecha_nacimiento',
        'fecha_compra',
        'created_at'
    ];





}
