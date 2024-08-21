<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emplooyees extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $fillable = [
        'firstName',
        'lastName',
        'NIC',
        'address',
        'pNo',
        'joinDate',
        'email',
        'password',
        'userRole',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'userId';

    public $incrementing = true;
}
