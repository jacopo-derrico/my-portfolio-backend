<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            'HTML',
            'CSS',
            'Javascript',
            'VueJS',
            'API',
            'PHP',
            'Laravel',
            'ReactJS',
            'AngularJS',
            'NuxtJS',
            'SvelteJS',
            'Python',
            'C',
            'Adobe Illustrator',
            'Adobe Photoshop',
            'Adobe Lightroom',
            'Figma',
            'Blender',
            'Rhinoceros',
            'Procreate'
        ];

        $colors = [
            "#E6DAC9", "#C5C3C5", "#A8B7CC", "#FFC080", "#90EE90",
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

        foreach ($technologies as $element) {
            $new_technology = new Technology();
            $new_technology->name = $element;
            $new_technology->slug = Str::slug($new_technology->name);
            $new_technology->color = $colors[array_rand($colors)]; //get random hex color
            $new_technology->icon = null;
            $new_technology->save();
        }
    }
}
