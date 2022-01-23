<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCard extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['title', 'description', 'card_img'];
}
