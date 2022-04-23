<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linha extends Model
{
    use HasFactory;
    /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
    protected $fillable = [
        'empresa_id',
        'nome',
        'numero',
        'tempo_de_espera',
        'valor',
      ];

    public function paradas() {
        return $this->hasMany("\App\Linhaeparada");
    }
    public function horarios() {
        return $this->hasMany("\App\Horario");
    }
}
