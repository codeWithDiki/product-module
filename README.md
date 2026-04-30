# Product Module

Pernah nggak kamu bikin aplikasi Laravel dan harus nulis fitur produk dari nol lagi? Mulai dari model, migrasi, relasi, sampai panel admin — semuanya berulang terus. **Product Module** hadir untuk menyelesaikan masalah itu.

Package ini menyediakan sistem manajemen produk yang sudah siap pakai: brand, kategori, varian, warna, ukuran, ulasan, gambar, hingga manajemen stok — semuanya dalam satu package yang bisa langsung kamu pasang ke aplikasi Laravel-mu.

---

## Daftar Isi

- [Apa Saja yang Bisa Dilakukan?](#apa-saja-yang-bisa-dilakukan)
- [Kebutuhan Sistem](#kebutuhan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Integrasi Filament](#integrasi-filament)
- [Cara Penggunaan](#cara-penggunaan)
  - [Produk](#produk)
  - [Kategori](#kategori)
  - [Varian Produk](#varian-produk)
  - [Warna & Ukuran](#warna--ukuran)
  - [Ulasan Produk](#ulasan-produk)
  - [Product Wrapper](#product-wrapper)
  - [Manajemen Stok](#manajemen-stok)
  - [Tag Produk](#tag-produk)
- [Skema Database](#skema-database)
- [Changelog](#changelog)
- [Lisensi](#lisensi)

---

## Apa Saja yang Bisa Dilakukan?

Sebelum mulai, ini gambaran singkat apa yang kamu dapatkan dari package ini:

- **Katalog produk multi-varian** — satu produk bisa punya banyak varian dengan harga dan stok masing-masing
- **Brand & kategori** — produk bisa dikaitkan ke brand dan beberapa kategori sekaligus (many-to-many)
- **Warna & ukuran** — setiap produk bisa didefinisikan pilihannya sendiri, masing-masing dengan stok
- **Product Wrapper** — container SKU yang mengikat satu kombinasi produk + varian + warna + ukuran menjadi satu unit beli
- **Manajemen stok** — tambah/kurangi stok di level produk, varian, warna, maupun ukuran
- **Tag berbasis JSON** — filter produk berdasarkan tag yang disimpan di kolom JSON
- **DTO type-safe** — semua operasi data melewati Data Transfer Object dari [Spatie Laravel Data](https://github.com/spatie/laravel-data)
- **Panel admin Filament** — plugin opsional yang langsung menyediakan 8 resource CRUD di dashboard Filament v3
- **Model yang bisa diganti** — semua model bisa di-swap dengan implementasi kustom milikmu via config

---

## Kebutuhan Sistem

Pastikan lingkungan kamu sudah memenuhi spesifikasi berikut sebelum memasang package ini:

- **PHP** versi 8.4 ke atas
- **Laravel** versi 11, 12, atau 13

---

## Instalasi

Sebelum menginstal Product Module, kamu harus membuat akun terlebih dahulu di : [sini](https://dikiakbarasyidiq.dev/auth/register). Setelah membuat akun buka halaman (Dashboard → Account) untuk melihat license key kamu.

Copy license key kamu lalu jalankan command ini :

```bash
composer config bearer.dikiakbarasyidiq.dev <license_key>
```

Setelah menjalankan command diatas, tambahkan repository berikut di file composer.json. (Jika Belum Ada)
```
{
"repositories": [
        {
            "type" : "composer",
            "url" : "https://dikiakbarasyidiq.dev"
        }
    ]
}
```

Setelah menambahkan repository, update composer terlebih dahulu:

```bash
composer update
```

Lalu kamu akan bisa melakukan installasi via composer di project kamu dengan command :

```bash
composer require codewithdiki/product-module
```

Setelah terpasang, publish dan jalankan migrasi untuk membuat semua tabel yang dibutuhkan:

```bash
php artisan vendor:publish --tag="product-module-migrations"
php artisan migrate
```

Perintah di atas akan membuat 10 tabel baru di database-mu, mulai dari `brands`, `products`, hingga `product_wrappers`.

---

## Konfigurasi

Publish file konfigurasi untuk menyesuaikan package dengan kebutuhan aplikasimu:

```bash
php artisan vendor:publish --tag="product-module-config"
```

File `config/product-module.php` akan muncul dengan isi seperti ini:

```php
return [
    "brand_class"            => \CodeWithDiki\ProductModule\Models\Brand::class,
    "category_class"         => \CodeWithDiki\ProductModule\Models\Category::class,
    "product_class"          => \CodeWithDiki\ProductModule\Models\Product::class,
    "product_image_class"    => \CodeWithDiki\ProductModule\Models\ProductImage::class,
    "product_variant_class"  => \CodeWithDiki\ProductModule\Models\ProductVariant::class,
    "product_color_class"    => \CodeWithDiki\ProductModule\Models\ProductColor::class,
    "product_size_class"     => \CodeWithDiki\ProductModule\Models\ProductSize::class,
    "product_wrapper_class"  => \CodeWithDiki\ProductModule\Models\ProductWrapper::class,
    "product_review_class"   => \CodeWithDiki\ProductModule\Models\ProductReview::class,
];
```

Setiap key di sini bisa kamu ganti dengan model kustom milikmu. Misalnya, kalau kamu punya model `Product` sendiri yang extend model bawaan package, cukup daftarkan di sini dan package akan menggunakannya di semua operasi.

---

## Integrasi Filament

Kalau aplikasimu menggunakan Filament v3 sebagai panel admin, kamu bisa langsung aktifkan plugin bawaan package ini. Cukup daftarkan `ProductModuleFilament` di panel provider-mu:

```php
use CodeWithDiki\ProductModule\ProductModuleFilament;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            ProductModuleFilament::make(),
        ]);
}
```

Setelah itu, 8 resource CRUD akan otomatis muncul di panel admin-mu:

| Resource | Deskripsi |
|---|---|
| BrandResource | Kelola brand produk |
| CategoryResource | Kelola kategori produk |
| ProductResource | Kelola produk utama |
| ProductVariantResource | Kelola varian produk |
| ProductImageResource | Kelola gambar produk |
| ProductColorResource | Kelola pilihan warna |
| ProductSizeResource | Kelola pilihan ukuran |
| ProductReviewResource | Kelola ulasan pelanggan |

---

## Cara Penggunaan

Semua operasi tersedia melalui facade `ProductModule`. Import facade-nya sekali dan kamu bisa mengakses semua fitur dari mana saja.

```php
use CodeWithDiki\ProductModule\Facades\ProductModule;
```

### Produk

Produk adalah entitas utama dalam package ini. Setiap produk memiliki nama, slug, tipe (FnB / Digital / Goods), harga, stok, SKU, dan bisa dilengkapi dengan tag serta meta_data berbasis JSON.

```php
use CodeWithDiki\ProductModule\Data\ProductData;
use CodeWithDiki\ProductModule\Enums\ProductType;

// Membuat produk baru
$product = ProductModule::createProduct(new ProductData(
    name: 'Kaos Polos',
    slug: 'kaos-polos',
    type: ProductType::Goods,
    price: 150000,
    discount_price: 120000,
    description: 'Kaos katun yang nyaman dipakai.',
    stock: 100,
    brand_id: 1,
    sku: 'KPS-001',
    is_active: true,
    tags: ['pakaian', 'atasan'],
    meta_data: [],
));

// Memperbarui data produk
ProductModule::updateProduct($product->id, $productData);

// Menghapus produk
ProductModule::deleteProduct($product->id);
```

**`ProductType`** adalah enum dengan tiga pilihan:

| Nilai | Keterangan |
|---|---|
| `ProductType::FnB` | Makanan & Minuman |
| `ProductType::Digital` | Produk digital |
| `ProductType::Goods` | Barang fisik |

---

### Kategori

Produk bisa dikaitkan ke banyak kategori sekaligus. Relasi ini bersifat many-to-many, artinya satu kategori juga bisa menampung banyak produk.

```php
use CodeWithDiki\ProductModule\Data\CategoryData;

// Membuat kategori baru
$category = ProductModule::createCategory(new CategoryData(
    name: 'Pakaian',
    slug: 'pakaian',
    thumbnail_url: 'https://example.com/pakaian.jpg',
    description: 'Semua item pakaian.',
    is_active: true,
));

// Menambahkan produk ke kategori
ProductModule::assignProductToCategory($product->id, $category->id);

// Melepas produk dari kategori
ProductModule::removeProductFromCategory($product->id, $category->id);

// Mengambil semua kategori dari sebuah produk
ProductModule::getProductCategories($product->id);

// Mengambil semua produk dalam sebuah kategori
ProductModule::getCategoryProducts($category->id);
```

---

### Varian Produk

Varian digunakan ketika satu produk hadir dalam beberapa pilihan berbeda — misalnya "Kaos Merah L" dan "Kaos Biru M" adalah dua varian dari satu produk yang sama. Setiap varian punya harga dan stok sendiri.

```php
use CodeWithDiki\ProductModule\Data\ProductVariantData;

$variant = ProductModule::createProductVariant(new ProductVariantData(
    product_id: $product->id,
    name: 'Merah - Large',
    slug: 'merah-large',
    price: 150000,
    discount_price: 120000,
    description: 'Varian warna merah ukuran large.',
    stock: 50,
    sku: 'KPS-001-ML',
    is_active: true,
));

// Memperbarui varian
ProductModule::updateProductVariant($variant->id, $variantData);
```

---

### Warna & Ukuran

Selain varian, produk juga bisa didefinisikan pilihan warna dan ukurannya secara terpisah. Masing-masing pilihan punya stok sendiri dan bisa ditandai sebagai pilihan utama (`is_primary`).

```php
use CodeWithDiki\ProductModule\Data\ProductColorData;
use CodeWithDiki\ProductModule\Data\ProductSizeData;

// Menambahkan pilihan warna
ProductModule::createProductColor(new ProductColorData(
    product_id: $product->id,
    label: 'Merah',
    color_hex: '#FF0000',
    stock: 30,
    is_primary: true,
    is_active: true,
));

// Menambahkan pilihan ukuran
ProductModule::createProductSize(new ProductSizeData(
    product_id: $product->id,
    label: 'Large',
    value: 'L',
    stock: 40,
    is_primary: false,
    is_active: true,
));

// Mengambil semua warna / ukuran dari sebuah produk
ProductModule::getProductColors($product->id);
ProductModule::getProductSizes($product->id);
```

---

### Ulasan Produk

Ulasan pelanggan bisa disimpan langsung ke produk. Setiap ulasan berisi nama pemberi ulasan, rating, dan pesan.

```php
use CodeWithDiki\ProductModule\Data\ProductReviewData;

ProductModule::createProductReview(new ProductReviewData(
    product_id: $product->id,
    from: 'Budi Santoso',
    rating: 5,
    message: 'Produk bagus dan sesuai deskripsi!',
));

// Mengambil semua ulasan dari sebuah produk
ProductModule::getProductReviews($product->id);
```

---

### Product Wrapper

Product Wrapper adalah konsep yang sedikit unik. Ini adalah sebuah container SKU yang mengikat satu kombinasi spesifik dari produk + varian + warna + ukuran menjadi satu unit yang siap dibeli. Berguna untuk sistem checkout atau keranjang belanja yang butuh referensi SKU yang presisi.

```php
use CodeWithDiki\ProductModule\Data\ProductWrapperData;

ProductModule::createProductWrapper(new ProductWrapperData(
    product_id: $product->id,
    product_variant_id: $variant->id,
    product_color_id: $color->id,
    product_size_id: $size->id,
));
```

---

### Manajemen Stok

Package ini menyediakan operasi stok yang atomik menggunakan `increment` dan `decrement` bawaan Eloquent, sehingga aman digunakan dalam lingkungan concurrent. Stok bisa dikelola di empat level berbeda.

```php
// Level produk
ProductModule::increaseStock($product->id, 10);
ProductModule::decreaseStock($product->id, 5);
ProductModule::getProductStock($product->id);

// Level varian
ProductModule::increaseVariantStock($variant->id, 10);
ProductModule::decreaseVariantStock($variant->id, 5);
ProductModule::getVariantStock($variant->id);

// Level warna
ProductModule::increaseProductColorStock($color->id, 10);
ProductModule::decreaseProductColorStock($color->id, 5);
ProductModule::getProductColorStock($color->id);

// Level ukuran
ProductModule::increaseProductSizeStock($size->id, 10);
ProductModule::decreaseProductSizeStock($size->id, 5);
ProductModule::getProductSizeStock($size->id);
```

---

### Tag Produk

Tag disimpan sebagai array JSON di kolom `tags` pada tabel produk. Kamu bisa memfilter produk berdasarkan tag tertentu, atau mengambil semua tag unik yang ada di seluruh katalog.

```php
// Ambil semua produk yang memiliki tag 'pakaian'
$products = ProductModule::getProductByTag('pakaian');

// Ambil semua tag unik dari seluruh produk
$tags = ProductModule::getTags();
```

> **Catatan:** `getTags()` secara otomatis menyesuaikan query berdasarkan driver database yang digunakan. SQLite menggunakan `json_each`, sementara MySQL menggunakan `JSON_UNQUOTE` + `JSON_EXTRACT`.

---

## Skema Database

Berikut 10 tabel yang dibuat oleh package ini beserta field utamanya:

| Tabel | Field Utama | Keterangan |
|---|---|---|
| `brands` | name, slug, thumbnail_url, is_active | Katalog brand |
| `categories` | name, slug, thumbnail_url, is_active | Kategori produk |
| `category_product` | category_id, product_id | Pivot many-to-many |
| `products` | brand_id, name, slug, type, price, discount_price, stock, sku, tags (JSON), meta_data (JSON) | Tabel utama produk |
| `product_variants` | product_id, name, slug, price, stock, sku | Varian produk |
| `product_images` | product_id, image_url, is_primary | Gambar produk |
| `product_colors` | product_id, label, color_hex, stock, is_primary | Pilihan warna |
| `product_sizes` | product_id, label, value, stock, is_primary | Pilihan ukuran |
| `product_reviews` | product_id, from, rating, message | Ulasan pelanggan |
| `product_wrappers` | product_id, product_variant_id, product_color_id, product_size_id | Container SKU |

**Relasi antar model:**

```
Brand ──< Product >──< Category
              │
    ┌─────────┼──────────┬──────────┬──────────┐
 Variant   Image      Review    Color      Size    Wrapper
```

---

## Changelog

Lihat [CHANGELOG](CHANGELOG.md) untuk informasi perubahan di setiap versi.

---

## Lisensi

The MIT License (MIT). Lihat [LICENSE.md](LICENSE.md) untuk detail lengkapnya.
