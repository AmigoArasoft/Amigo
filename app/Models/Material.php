<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Material extends Model{
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

    public function submateriales(){
        return $this->belongsToMany(Parametro::class, 'material_submaterial', 'material_id', 'submaterial_id')->orderBy('nombre');
    }
}