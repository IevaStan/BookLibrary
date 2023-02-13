<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'enabled'
    ];

    protected $attributes = [
        'enabled' => false
    ];

    //One to many saryšis, kuris pagal category_id prie knygos sugebės išrišti informaciją
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }


}
