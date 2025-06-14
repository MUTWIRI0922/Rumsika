<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class housedetails extends Model
{
    use HasFactory;
    protected $table = 'housedetails';

    protected $fillable = [
        'Type',
        'Location',
        'Description',
        'Rate',
        'image',
        'landlord_id',
        'image_inside',
        'Image_outside',
        'Amenities',
    ];
    public $timestamps = false;
    /**
     * Get the landlord that owns the house details.
     */
    public function landlord()
    {
        return $this->belongsTo(\App\Models\Landlord::class, 'landlord_id');
    }
}
