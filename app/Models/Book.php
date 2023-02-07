<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'page_count',
        'description',
        'author_id',
        'category_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    //Sąryšis su category per category_id
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
