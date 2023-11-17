<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tercero extends Model{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $fillable = ['persona_id', 'comprador_id', 'documento_id', 'frente_id', 'documento', 'nombre', 'direccion', 'telefono', 'email', 'operador', 'transporte', 'rucom', 'firma', 'activo'];

    protected static function boot(){
        parent::boot();
        static::creating(function ($tabla) {
            $tabla->user_create_id = $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
        });
        static::updating(function ($tabla) {
            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
        });
    }

	public function persona(){
        return $this->belongsTo(Parametro::class, 'persona_id');
    }

    public function tipo(){
        return $this->belongsTo(Parametro::class, 'documento_id');
    }

    public function comprador(){
        return $this->belongsTo(Parametro::class, 'comprador_id');
    }

    public function frente(){
        return $this->belongsTo(Parametro::class, 'frente_id');
    }

    public function vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }

    public function conductor_viajes(){
        return $this->hasMany(Viaje::class, 'conductor_id');
    }

    public function operador_viajes(){
        return $this->hasMany(Viaje::class, 'operador_id');
    }

    public function transporte_viajes(){
        return $this->hasMany(Viaje::class, 'transporte_id');
    }

    public function contactos(){
        return $this->belongsToMany(Tercero::class, 'tercero_contacto', 'tercero_id', 'contacto_id');
    }

    public function gerente(){
        return $this->belongsToMany(Tercero::class, 'tercero_contacto', 'tercero_id', 'contacto_id')->where('funcion_id', 8)->first();
    }

    public function conductores(){
        return $this->belongsToMany(Tercero::class, 'tercero_contacto', 'tercero_id', 'contacto_id')->where('funcion_id', 11);
    }

    public function materiales(){
        return $this->belongsToMany(Material::class, 'tercero_material', 'tercero_id', 'material_id');
    }

    public function tarifas(){
        return $this->belongsToMany(Tarifa::class, 'tercero_tarifa', 'tercero_id', 'tarifa_id');
    }

    public function transportes(){
        return $this->belongsToMany(Tercero::class, 'tercero_transporte', 'tercero_id', 'transporte_id');
    }

    public function operadores(){
        return $this->belongsToMany(Tercero::class, 'tercero_transporte', 'transporte_id', 'tercero_id');
    }

    public function transportesVehiculos(){
        return $this->hasManyDeep(
            Vehiculo::class,
            ['tercero_transporte', Tercero::class],
            ['tercero_id', 'id', 'tercero_id'],
            ['id', 'transporte_id', 'id']
        );
    }

    public function cubicajes(){
        return $this->hasMany(Cubicaje::class);
    }
}
