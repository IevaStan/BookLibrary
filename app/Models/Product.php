<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    // const CREATED_AT = "create_date";

    protected $primaryKey = "category_id";
    protected $keyType = "string";

    // public $timestamps = false;
    protected $connection = 'sqlite';
}
