<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile_picture',
    ];
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'lister_id')->latest();
    }
}
