<?php

namespace App\Model;

use App\Core\Model;

class Person extends Model
{
    protected $table = 'people';

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
    ];
}