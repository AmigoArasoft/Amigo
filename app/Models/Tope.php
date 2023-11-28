<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tope extends Model
{
    use HasFactory;

    protected $table = "tope";
    protected $fillable = ['id', 'tope'];
    public $timestamps = false;
}
