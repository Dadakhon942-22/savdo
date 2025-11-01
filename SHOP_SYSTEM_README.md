# 3 Rolga Ega E-commerce Tizimi

## Yaratilgan Tizim

Sizning Laravel ilovangizga 3 ta rol bilan ishlaydigan to'liq do'kon tizimi qo'shildi:

### 1️⃣ Admin Roli
**Kirish:** admin@example.com / password

**Vakolatlari:**
- ✅ Do'kon kategoriyalarini yaratish va boshqarish
- ✅ Do'konlarni yaratish va sotuvchilarga tayinlash
- ✅ Barcha do'konlar va mahsulotlarni ko'rish
- ✅ Mahsulot kategoriyalarini boshqarish
- ✅ Buyurtmalarni boshqarish

**Admin Paneli:**
- Route: `/admin`
- Do'kon kategoriyalari: `/admin/shop-categories`
- Do'konlar: `/admin/shops`
- Mahsulot kategoriyalari: `/admin/categories`
- Mahsulotlar: `/admin/products`

### 2️⃣ Sotuvchi (Seller) Roli
**Kirish:** seller@example.com / password

**Vakolatlari:**
- ✅ O'z do'konidagi mahsulotlarni qo'shish
- ✅ O'z mahsulotlarini tahrirlash
- ✅ O'z mahsulotlarini o'chirish
- ❌ Boshqa sotuvchilarning mahsulotlarini ko'ra olmaydi

**Sotuvchi Paneli:**
- Route: `/seller/products`

### 3️⃣ Foydalanuvchi (Customer) Roli
**Yaratilishi:** Ro'yxatdan o'tish orqali

**Vakolatlari:**
- ✅ Mahsulotlarni ko'rish
- ✅ Savatga qo'shish
- ✅ Xarid qilish
- ✅ Buyurtmalarini ko'rish

---

## Yaratilgan Fayllar

### 📁 Models
- `app/Models/Shop.php` - Do'kon modeli
- `app/Models/ShopCategory.php` - Do'kon kategoriyasi modeli
- `app/Policies/ProductPolicy.php` - Mahsulot huquqlari

### 📁 Migrations
- `2025_10_29_071908_create_shop_categories_table.php`
- `2025_10_29_071923_create_shops_table.php`
- `2025_10_29_071932_add_shop_id_to_products_table.php`

### 📁 Controllers
**Admin:**
- `app/Http/Controllers/Admin/ShopCategoryController.php`
- `app/Http/Controllers/Admin/ShopController.php`

**Seller:**
- `app/Http/Controllers/Seller/ProductController.php`

### 📁 Middleware
- `app/Http/Middleware/AdminMiddleware.php`
- `app/Http/Middleware/SellerMiddleware.php`

### 📁 Views
**Admin - Do'kon kategoriyalari:**
- `resources/views/admin/shop-categories/index.blade.php`
- `resources/views/admin/shop-categories/create.blade.php`
- `resources/views/admin/shop-categories/edit.blade.php`

**Admin - Do'konlar:**
- `resources/views/admin/shops/index.blade.php`
- `resources/views/admin/shops/create.blade.php`
- `resources/views/admin/shops/edit.blade.php`

**Seller - Mahsulotlar:**
- `resources/views/seller/products/index.blade.php`
- `resources/views/seller/products/create.blade.php`
- `resources/views/seller/products/edit.blade.php`

### 📁 Seeders
- `database/seeders/ShopCategorySeeder.php`
- `database/seeders/ShopSeeder.php`
- Yangilangan `database/seeders/ProductSeeder.php`
- Yangilangan `database/seeders/DatabaseSeeder.php`

### 📁 Language Files
- Yangilangan `lang/uz/messages.php`
- Yangilangan `lang/en/messages.php`
- Yangilangan `lang/ru/messages.php`

---

## Ma'lumotlar Bazasi Strukturasi

### ShopCategories (Do'kon kategoriyalari)
- id
- name
- slug
- description
- image
- timestamps

### Shops (Do'konlar)
- id
- user_id (sotuvchi)
- shop_category_id
- name
- slug
- description
- logo
- phone
- address
- is_active
- timestamps

### Products (Mahsulotlar - Yangilangan)
- Qo'shilgan ustun: `shop_id`
- Har bir mahsulot endi do'kon bilan bog'langan

---

## Ishlatish

### Demo Ma'lumotlar
Tizimda quyidagi demo foydalanuvchilar va ma'lumotlar mavjud:

**Admin:**
- Email: admin@example.com
- Parol: password

**Sotuvchi:**
- Email: seller@example.com
- Parol: password
- Do'kon: "Demo Do'kon"

**Do'kon Kategoriyalari:**
1. Oziq-ovqat
2. Kiyim-kechak
3. Elektronika
4. Uy-ro'zg'or
5. Sport va salomatlik

### Yangi Sotuvchi Qo'shish
1. Admin panelga kirish
2. `/admin/shops/create` ga o'tish
3. Sotuvchini tanlash (yoki yangi sotuvchi yaratish)
4. Do'kon kategoriyasini tanlash
5. Do'kon ma'lumotlarini to'ldirish
6. Saqlash

### Sotuvchi Sifatida Mahsulot Qo'shish
1. Sotuvchi hisobi bilan kirish
2. "Mening Mahsulotlarim" tugmasini bosish
3. "Yangi mahsulot" ni bosish
4. Mahsulot ma'lumotlarini kiritish
5. Saqlash

---

## Route'lar

### Admin Route'lar
```php
/admin                          - Dashboard
/admin/shop-categories          - Do'kon kategoriyalari
/admin/shop-categories/create   - Yangi kategoriya
/admin/shops                    - Do'konlar
/admin/shops/create             - Yangi do'kon
/admin/products                 - Mahsulotlar
/admin/categories               - Mahsulot kategoriyalari
/admin/orders                   - Buyurtmalar
```

### Seller Route'lar
```php
/seller/products                - Mening mahsulotlarim
/seller/products/create         - Yangi mahsulot
/seller/products/{id}/edit      - Mahsulotni tahrirlash
```

### Public Route'lar
```php
/                               - Bosh sahifa
/products                       - Mahsulotlar
/cart                           - Savat
/orders                         - Buyurtmalar
/login                          - Kirish
/register                       - Ro'yxatdan o'tish
```

---

## Xavfsizlik

### Middleware
- `admin` - Faqat admin huquqi
- `seller` - Faqat sotuvchi huquqi
- `auth` - Autentifikatsiya talab qiladi

### Policy
- `ProductPolicy` - Sotuvchi faqat o'z mahsulotlarini boshqarishi mumkin

---

## Keyingi Qadamlar

1. ✅ Tizim ishga tushirildi va to'ldirildi
2. Ilovani ishga tushiring: `php artisan serve`
3. Admin hisobiga kiring va tizimni sinab ko'ring
4. Kerak bo'lsa qo'shimcha do'konlar va sotuvchilar qo'shing

---

## Texnik Ma'lumotlar

- **Laravel Version:** 11.x
- **Database:** SQLite
- **Frontend:** Tailwind CSS
- **Til:** 3 til (O'zbek, Ingliz, Rus)

---

Muvaffaqiyatli amalga oshirildi! ✅





