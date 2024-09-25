<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function technologies(): BelongsToMany{
        return $this->belongsToMany(Technology::class);
    }

    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class, 'project_category');
    }

    public function images(): HasMany{
        return $this->hasMany(Image::class);
    }
}
