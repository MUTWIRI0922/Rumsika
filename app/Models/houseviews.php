<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class houseviews extends Model
{
    use HasFactory;
    protected $fillable = ['house_id', 'client_ip'];
    protected $table = 'houseviews';

}
