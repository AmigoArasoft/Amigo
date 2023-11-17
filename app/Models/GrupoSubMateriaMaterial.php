<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoSubMateriaMaterial extends Model{
    use HasFactory;

    protected $table = 'gruposubmat_material';
    
    protected $fillable = ['gruposubmat_id', 'material_id'];
}