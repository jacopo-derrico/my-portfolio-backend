<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Generate a random color when the model is instantiated
        $this->color = $this->randomColor();
    }

    public function randomColor()
    {
        $colors = [
            "#FFDAB9", "#C5C3C5", "#A8B7CC", "#FFC080", "#90EE90",
            "#FFE4B5", "#FFA07A", "#98FB98", "#FA8072", "#00FFFF",
            "#DDA0DD", "#DC143C", "#FF6347", "#32CD32", "#00008B",
            "#4682B4", "#FF0000", "#00FFFF", "#A52A2A", "#808080",
            "#B22222", "#4B0082", "#FFD700", "#228B22", "#F0E68C",
            "#4682B4", "#006400", "#FF4500", "#800080", "#FF6347",
            "#8B4513", "#FFA500", "#00FF00", "#0000CD", "#800080",
            "#4682B4", "#008000", "#FF6347", "#DC143C", "#A52A2A",
            "#4B0082", "#228B22", "#FFD700", "#006400", "#FF4500",
            "#800080", "#FF6347", "#8B4513", "#FFA500", "#00FF00"
        ];
        

        return $colors[array_rand($colors)];
    }

    // autogenerate the slug from name
    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    public function projects(): BelongsToMany{
        return $this->belongsToMany(Project::class, 'project_category');
    }
}
