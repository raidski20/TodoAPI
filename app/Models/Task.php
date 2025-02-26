<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'task_tag');
    }

    public function scopeFilterByStatus(Builder $query, ?string $status): Builder
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeFilterByTag(Builder $query, ?string $tag): Builder
    {
        return $tag ? $query->whereHas('tags', fn($q) => $q->where('name', $tag)) : $query;
    }
}
