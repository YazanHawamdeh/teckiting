<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teckit;


class TypeTeckit extends Model
{


    use HasFactory;
    protected $table = 'teckit_types';

    // If the pivot table does not have an id column, you can disable incrementing
    public $incrementing = false;

    // If your pivot table includes timestamps
    public $timestamps = true;

    // Specify the primary keys for the pivot table if necessary
    protected $primaryKey = ['teckit_id', 'type_id'];

    // Since we have composite primary keys, we should let Eloquent know
    public $keyType = 'array';

    // Allow mass assignment for these fields
    protected $fillable = ['teckit_id', 'type_id'];

    public function type(){
       return $this->belongsTo(Type::class);
    }


}
