<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAbout extends Model
{
    protected $fillable = [
        'title',
        'short_discription',
        'long_discription',
    ];
    use HasFactory;
}
