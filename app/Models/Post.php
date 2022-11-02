<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'votes'
    ];

    protected $with = ['category', 'status', 'user:name,id,mc_uuid,email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => $query->where(fn($query) => $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')));

        $query->when($filters['category'] ?? false, fn($query, $categories) => $query->whereHas('category', fn($query) => $query->whereIn('name', $categories)));

        $query->when($filters['tags'] ?? false, function ($query, $tags) {
            foreach ($tags as $tag) {
                $query->whereRelation('tags', 'name', $tag);
            }
        });
    }

    public function scopeSort($query, $value)
    {
        switch ($value) {
            case ("top"):
                $value = 'likes_count';
                break;
            case ("new"):
                $value = 'id';
                break;
            default:
                $value = 'likes_count';
        }

        return $query->orderby($value, 'desc');

    }

    public function scopeActive($query)
    {
        $query->whereRelation('category', 'active', true);
    }
}
