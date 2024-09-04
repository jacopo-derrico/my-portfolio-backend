<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'description',
        'cover_path',
        'link',
        'git_link'
    ];

    // autogenerate the slug from title
    public static function generateSlug($title){
        return Str::slug($title, '-');
    }
}
