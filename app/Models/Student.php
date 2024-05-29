<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'dni',
        'group',
        'birthdate',
        'curso'
    ];
    
    public function assists()
    {
        return $this->hasMany(Assist::class);
    }



}
