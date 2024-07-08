<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teckit;
use App\Models\UserTypes;



class Types extends Model
{
    use HasFactory;

    protected $fillable = ['id','title'];

    // public function teckits()
    // {
    //     return $this->belongsToMany(Teckit::class, 'teckit_types', 'type_id', 'teckit_id');
    // }

    public function typesTeckits()
    {
        return $this->hasMany(Types::class);
    }

    public function types()
    {
        return $this->hasMany(TypeTeckit::class);
    }

    public function types2()
    {
        return $this->hasMany(TypeTeckit::class,'type_id');
    }
    
    public function teckits()
    {
        return $this->belongsToMany(Teckit::class, 'teckit_types', 'type_id', 'teckit_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_types', 'type_id', 'user_id');
    }
}
