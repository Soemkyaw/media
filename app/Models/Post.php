<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }

    public function scopeFilter($query,$search)
    {
        $query->when($search ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($query) use($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        });
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}
