<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $fillable = [
        'reviewer',
        'rating',
        'review',
        'lister_id',
    ];
    public function landlord()
    {
        return $this->belongsTo(Landlord::class, 'lister_id');
    }
}
