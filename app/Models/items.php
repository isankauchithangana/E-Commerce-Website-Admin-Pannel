<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'itemId';

    public $incrementing = false;

    protected $keyType = 'string'; 

    protected $fillable = [
        'itemName',
        'brandID',
        'price',
        'categoryID',
        'origin',
        'shipping',
        'availableFrom',
        'availableTo',
        'imageID',
    ];

    public function category()
    {
        return $this->belongsTo(categories::class, 'categoryID', 'categoryID');
    }

    public function brand()
    {
        return $this->belongsTo(brands::class, 'brandID', 'brandID');
    }

    public function image()
    {
        return $this->belongsTo(images::class, 'imageID', 'imageID');
    }
}
