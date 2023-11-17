<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Especificacion extends Model{
    use HasFactory;

    protected $fillable = ['nombre', 'activo'];

    protected static function boot(){
        parent::boot();
        static::creating(function ($tabla) {
            $tabla->user_create_id = $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
        });
        static::updating(function ($tabla) {
            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
        });
    }

    public function normas(){
        return $this->belongsToMany(Parametro::class, 'especificacion_parametro', 'especificacion_id', 'parametro_id');
    }
}