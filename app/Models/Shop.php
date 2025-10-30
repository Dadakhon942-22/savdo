<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    protected $fillable = [
        'user_id',
        'shop_category_id',
        'name',
        'slug',
        'description',
        'logo',
        'phone',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shopCategory(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
