<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerceroTarifa extends Model{
    use HasFactory;

    protected $table = 'tercero_tarifa';
    
    protected $fillable = ['tercero_id', 'tarifa_id', 'tarifa'];
}