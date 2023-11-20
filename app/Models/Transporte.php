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
            $tabla->fecha_nombre = Carbon::parse($tabla->fecha)->formatLocalized('%d de %B de %Y');
        });
    }

    public function terceros(){
        return $this->belongsToMany(Tercero::class, 'tercero_transporte', 'transporte_id', 'tercero_id');
    }
}