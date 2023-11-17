<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Materia extends Model{
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

    public function especificaciones(){
        return $this->belongsToMany(Especificacion::class, 'material_especificacion', 'material_id', 'especificacion_id');
    }
    
}