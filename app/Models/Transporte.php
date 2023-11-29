<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transporte extends Model{
    use HasFactory;

    protected $table = 'transporte';
    
    protected $fillable = ['id', 'activo', 'nombre', 'fecha_nombre', 'created_at', 'updated_at', 'deleted_at'];

    protected static function boot(){
        parent::boot();
        static::creating(function ($tabla) {
            $fecha = Carbon::parse($tabla->fecha);
            $fecha->locale('es');
            $dia = $fecha->isoFormat('D'); 
            $mes = $fecha->isoFormat('MMMM'); 
            $año = $fecha->isoFormat('Y'); 
            $output = "{$dia} de {$mes} de {$año}";
            $tabla->fecha_nombre = $output;
        });
    }

    public function terceros(){
        return $this->belongsToMany(Tercero::class, 'tercero_transporte', 'transporte_id', 'tercero_id');
    }
}