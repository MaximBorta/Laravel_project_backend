<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'post_img', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
