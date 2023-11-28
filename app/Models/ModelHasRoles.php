<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class ModelHasRoles extends Authenticatable{
    use HasRoles;
    use HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'model_type',
        'model_id'
    ];
}