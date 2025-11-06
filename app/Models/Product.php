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
        'sale_end_date',
        'sale_duration_days',
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
        'sale_end_date' => 'datetime',
        'sale_duration_days' => 'integer',
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

    // Aksiya muddati tugaganga tekshirish
    public function getIsSaleActiveAttribute()
    {
        if (!$this->is_on_sale || $this->discount_percentage <= 0) {
            return false;
        }
        
        // Agar muddat belgilanmagan bo'lsa, aksiya faol
        if (!$this->sale_end_date) {
            return true;
        }
        
        // Muddat hali tugamagan bo'lsa, aksiya faol
        return now()->lte($this->sale_end_date);
    }

    // Aksiya tugashiga qolgan vaqtni hisoblash
    public function getRemainingSaleTimeAttribute()
    {
        if (!$this->is_sale_active || !$this->sale_end_date) {
            return null;
        }

        $now = now();
        $end = $this->sale_end_date;

        if ($now->greaterThanOrEqualTo($end)) {
            return null; // Aksiya tugagan
        }

        $diff = $now->diff($end);

        $parts = [];
        if ($diff->days > 0) {
            $parts[] = $diff->days . ' ' . __('messages.days');
        }
        if ($diff->h > 0) {
            $parts[] = $diff->h . ' ' . __('messages.hours');
        }
        if ($diff->i > 0 && $diff->days == 0) { // Faqat kunlar 0 bo'lsa minutlarni ko'rsatamiz
            $parts[] = $diff->i . ' ' . __('messages.minutes');
        }

        if (empty($parts)) {
            return __('messages.less_than_a_minute'); // Agar 1 minutdan kam qolgan bo'lsa
        }

        return implode(' ', $parts);
    }

    // Chegirmadagi narxni hisoblash
    public function getDiscountedPriceAttribute()
    {
        if ($this->is_sale_active && $this->discount_percentage > 0) {
            return $this->price - ($this->price * $this->discount_percentage / 100);
        }
        return $this->price;
    }

    // Chegirma miqdorini hisoblash
    public function getDiscountAmountAttribute()
    {
        if ($this->is_sale_active && $this->discount_percentage > 0) {
            return $this->price * $this->discount_percentage / 100;
        }
        return 0;
    }

    // Aksiya muddati tugaganda avtomatik o'chirish va sale_end_date ni hisoblash
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // Yangi mahsulot yaratilganda - sale_duration_days bo'lsa, sale_end_date ni hisoblash
            // Agar controller'da allaqachon sale_end_date belgilangan bo'lsa, uni o'zgartirmaymiz
            if ($product->is_on_sale && $product->sale_duration_days && $product->sale_duration_days > 0 && !$product->sale_end_date) {
                $product->sale_end_date = now()->addDays($product->sale_duration_days);
            }
        });

        static::updating(function ($product) {
            // Mahsulot yangilanayotganda
            // Agar aksiya o'chirilsa
            if ($product->isDirty('is_on_sale') && !$product->is_on_sale) {
                $product->sale_end_date = null;
                $product->sale_duration_days = null;
                $product->discount_percentage = 0;
                return;
            }
            
            // Agar aksiya yoqilgan bo'lsa
            if ($product->is_on_sale) {
                // Agar sale_duration_days kiritilgan bo'lsa
                if ($product->sale_duration_days && $product->sale_duration_days > 0) {
                    // Agar sale_duration_days o'zgarsa yoki is_on_sale yoqilgan bo'lsa yoki sale_end_date yo'q bo'lsa yoki sale_end_date o'tmishda bo'lsa
                    $shouldRecalculate = $product->isDirty('sale_duration_days') 
                        || $product->isDirty('is_on_sale') 
                        || !$product->sale_end_date
                        || ($product->sale_end_date && now()->gt($product->sale_end_date));
                    
                    if ($shouldRecalculate) {
                        // Yaratilgan vaqtdan boshlab hisoblaymiz
                        $createdAt = $product->getOriginal('created_at') 
                            ? \Carbon\Carbon::parse($product->getOriginal('created_at'))
                            : ($product->created_at ? \Carbon\Carbon::parse($product->created_at) : now());
                        
                        $product->sale_end_date = $createdAt->copy()->addDays($product->sale_duration_days);
                    }
                } else {
                    // Cheksiz aksiya - sale_end_date null bo'lishi kerak
                    // Faqat agar sale_duration_days o'zgarganda yoki is_on_sale yoqilganda
                    if ($product->isDirty('sale_duration_days') || $product->isDirty('is_on_sale')) {
                        $product->sale_end_date = null;
                    }
                }
            }
        });

        static::saving(function ($product) {
            // Agar aksiya muddati tugagan bo'lsa, aksiyani o'chirish
            if ($product->is_on_sale && $product->sale_end_date && now()->gt($product->sale_end_date)) {
                $product->is_on_sale = false;
                $product->discount_percentage = 0;
                $product->sale_duration_days = null;
                $product->sale_end_date = null;
            }
        });
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
