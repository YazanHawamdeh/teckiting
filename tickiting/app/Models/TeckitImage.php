<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeckitImage extends Model
{
    use HasFactory;
    protected $table = 'teckit-images';

    // If the pivot table does not have an id column, you can disable incrementing
    public $incrementing = false;

    // If your pivot table includes timestamps
    public $timestamps = true;

    // Specify the primary keys for the pivot table if necessary
    protected $primaryKey = ['teckit_id', 'image_url'];

    // Since we have composite primary keys, we should let Eloquent know
    public $keyType = 'array';

    // Allow mass assignment for these fields
    protected $fillable = ['teckit_id', 'image_url'];



}
