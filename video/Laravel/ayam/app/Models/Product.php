<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'price', 'image', 'is_promo', 'discount_percentage'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDiscountedPrice()
    {
        if ($this->is_promo && $this->discount_percentage > 0) {
            return $this->price - ($this->price * $this->discount_percentage / 100);
        }
        return $this->price;
    }
}


?>