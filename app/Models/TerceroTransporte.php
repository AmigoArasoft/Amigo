<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerceroTransporte extends Model{
    use HasFactory;

    protected $table = 'tercero_transporte';
    
    protected $fillable = ['tercero_id', 'transporte_id'];

    public $timestamps = false;
}