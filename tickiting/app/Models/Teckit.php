<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types;


class Teckit extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status','current_date','current_time','solution','user_id','tecknetion_id'];
    protected $casts = [
        'type_ids' => 'array', // Add this line
    ];

    
    public function types()
    {
        return $this->hasMany(TypeTeckit::class);
    }

    public function types2()
    {
        return $this->hasMany(TypeTeckit::class,'teckit_id');
    }

    public function images()
    {
        return $this->hasMany(TeckitImage::class);
    }

    public function actionUser()
    {
        return $this->belongsTo(User::class, 'tecknetion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}


