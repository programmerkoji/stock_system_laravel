<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'name',
        'price',
        'number',
    ];

    /**
     * @return BelongsTo
     */
    public function product_category(): BlongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
