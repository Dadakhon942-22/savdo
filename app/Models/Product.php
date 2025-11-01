<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'shop_id',
        'category_id',
        'name',
        'name_uz',
        'name_ru',
        'name_en',
        'slug',
        'description',
        'description_uz',
        'description_ru',
        'description_en',
        'price',
        'discount_percentage',
        'is_on_sale',
        'image',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean',
        'is_on_sale' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    // Chegirmadagi narxni hisoblash
    public function getDiscountedPriceAttribute()
    {
        if ($this->is_on_sale && $this->discount_percentage > 0) {
            return $this->price - ($this->price * $this->discount_percentage / 100);
        }
        return $this->price;
    }

    // Chegirma miqdorini hisoblash
    public function getDiscountAmountAttribute()
    {
        if ($this->is_on_sale && $this->discount_percentage > 0) {
            return $this->price * $this->discount_percentage / 100;
        }
        return 0;
    }

    // Joriy tilga mos nomni qaytarish
    public function getLocalizedNameAttribute()
    {
        $locale = session('locale', 'uz');
        $field = 'name_' . $locale;
        
        return $this->$field ?? $this->name;
    }

    // Joriy tilga mos tavsifni qaytarish
    public function getLocalizedDescriptionAttribute()
    {
        $locale = session('locale', 'uz');
        $field = 'description_' . $locale;
        
        return $this->$field ?? $this->description;
    }
}
