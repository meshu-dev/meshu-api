<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $table = 'repositories';

    protected $fillable = ['name', 'url'];

    public $timestamps = false;
}
