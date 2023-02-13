<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'page_count',
        'description',
        // 'author_id', užkometuotas perėjus prie multiple authors
        'category_id',
    ];

    protected $with = ['category', 'authors'];

    public function authors(): BelongsToMany   //pakeičiau į authors perėjus prie many
    {
        return $this->belongsToMany(Author::class); //pakeičiau iš belongsTo perėjus prie multiple authors
    }

    //Sąryšis su category per category_id
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
