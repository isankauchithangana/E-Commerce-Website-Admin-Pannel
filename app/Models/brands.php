<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    use HasFactory;

    protected $fillable = [
        'brandName',
        'imagePath',
    ];

    public function items()
    {
        return $this->hasMany(items::class, 'brandID', 'brandID');
    }
}
