<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeHeader extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'img'];

    protected $guarded = [];
}
