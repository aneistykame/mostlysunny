<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'color', 
        'category_id',
        'stock', 
        'material'
    ];

    //relácia na obrázky produktu
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id')
                    ->where('is_main', true);
    }
}