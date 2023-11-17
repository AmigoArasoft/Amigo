<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable{
    use HasRoles;
    use HasFactory, Notifiable;

    protected $fillable = [
        'tercero_id', 
        'name', 
        'email', 
        'password', 
        'telefono', 
        'activo'
    ];

    protected $hidden = [
        'password', 
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($tabla){
            $tabla->user_create_id = $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
        });
        static::updating(function ($tabla){
            $tabla->user_update_id = (Auth::check()) ? Auth::id() : 1;
        });
    }

    public function setPasswordAttribute($value){
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function empresa(){
        return $this->belongsTo(Tercero::class, 'tercero_id');
    }
}