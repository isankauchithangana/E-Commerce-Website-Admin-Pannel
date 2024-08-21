<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryName',
    ];

    public function items()
    {
        return $this->hasMany(items::class, 'categoryID', 'categoryID');
    }
}
