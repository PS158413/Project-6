<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected $fillable = [
        'article_number',
        'name',
        'description',
        'price',
        'image',
        'color',
        'height_cm',
        'width_cm',
        'depth_cm',
        'weight_gr',
        'created_at',
        'updated_at',
        'barcode',
        'stock',
    ];
}
