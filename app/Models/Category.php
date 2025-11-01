<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'name_uz',
        'name_ru',
        'name_en',
        'slug',
        'description',
        'description_uz',
        'description_ru',
        'description_en',
        'image',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
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
