<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'enabled',
        'category_id',
    ];

    //į fillables įtraukiam tuos laukus, kuriuos norime gauti per requestus. 
    // pvz, šiuo atveju kviečiant Request:all neįtrauks token'ų

    protected $attributes = [
        'enabled' => false
    ];

    //One to many saryšis, kuris pagal category_id prie knygos sugebės išrišti informaciją
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories(): HasMany
    {
        return $this->hasMany(Category::class)->with('categories');
    }
}
