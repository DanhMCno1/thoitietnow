<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'summary',
        'content',
        'status'
    ];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
