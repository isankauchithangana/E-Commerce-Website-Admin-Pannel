<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagePath',
    ];

    public function items()
    {
        return $this->hasMany(items::class, 'imageID', 'imageID');
    }
}
