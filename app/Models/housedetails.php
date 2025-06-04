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
    ];
    public $timestamps = false;
}
