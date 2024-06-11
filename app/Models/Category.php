<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Project;

class Category extends Model
{
    
    use HasFactory;
    protected $fillable = ['name', 'slug'];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public static function generateSlug($name)
    {
        $slug = Str::slug($name, '-');
        $count = 1;
        while(Category::where('slug', $slug )->first()) {
            $slug= Str::slug($name) . '-' . $count . '-';
            $count++;
        }
        return $slug;
    }
}
