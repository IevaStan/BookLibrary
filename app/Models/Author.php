<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $dates = ['birthdate'];

    protected $fillable = [
        'name',
        'surname',
        'country',
        'birthdate'
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function getFullNameAttribute(): string
    {
        return sprintf('%s %s (%s)', $this->name, $this->surname, $this->country);
    }
}
