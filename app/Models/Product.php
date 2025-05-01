<?php
namespace App\Models;

class Product extends BaseModel
{
    protected $appends = ["image_link", "price_formatter"];

    protected $fillable = [
        'name',
        'price',
        'content',
        'description',
        'product_category_id',
        'image',
        'is_active',
    ];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getImageLinkAttribute()
    {
        return url("/") . "/uploads/" . $this->image;
    }

    public function getPriceFormatterAttribute()
    {
        return number_format( $this->price);
    }
}
