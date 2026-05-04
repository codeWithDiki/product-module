<?php

namespace CodeWithDiki\ProductModule;

use CodeWithDiki\ProductModule\Data\CategoryData;
use CodeWithDiki\ProductModule\Data\ProductColorData;
use CodeWithDiki\ProductModule\Data\ProductData;
use CodeWithDiki\ProductModule\Data\ProductReviewData;
use CodeWithDiki\ProductModule\Data\ProductSizeData;
use CodeWithDiki\ProductModule\Data\ProductVariantData;
use CodeWithDiki\ProductModule\Data\ProductWrapperData;
use CodeWithDiki\ProductModule\Models\Product;
use CodeWithDiki\ProductModule\Models\ProductVariant;

class ProductModule {

    public function createProduct(ProductData $productData) : \Illuminate\Database\Eloquent\Model|Product
    {
        // Logic to create a product using the provided data

        return config("product-module.product_class")::create([
            "name" => $productData->name,
            "slug" => $productData->slug,
            "type" => $productData->type,
            "price" => $productData->price,
            "discount_price" => $productData->discount_price,
            "description" => $productData->description,
            "stock" => $productData->stock,
            "brand_id" => $productData->brand_id,
            "sku" => $productData->sku,
            "is_active" => $productData->is_active,
            "tags" => $productData->tags,
            "meta_data" => $productData->meta_data
        ]);
    }

    public function createProductVariant(ProductVariantData $productVariantData) : \Illuminate\Database\Eloquent\Model|ProductVariant
    {
        // Logic to create a product variant using the provided data

        return config("product-module.product_variant_class")::create([
            "product_id" => $productVariantData->product_id,
            "name" => $productVariantData->name,
            "slug" => $productVariantData->slug,
            "price" => $productVariantData->price,
            "discount_price" => $productVariantData->discount_price,
            "description" => $productVariantData->description,
            "stock" => $productVariantData->stock,
            "sku" => $productVariantData->sku,
            "is_active" => $productVariantData->is_active,
        ]);
    }

    public function createCategory(CategoryData $categoryData) : \Illuminate\Database\Eloquent\Model|\CodeWithDiki\ProductModule\Models\Category
    {
        // Logic to create a category using the provided data
        
        return config("product-module.category_class")::create([
            "name" => $categoryData->name,
            "slug" => $categoryData->slug,
            "thumbnail_url" => $categoryData->thumbnail_url,
            "description" => $categoryData->description,
            "is_active" => $categoryData->is_active
        ]);
    }

    public function assignProductToCategory(int $productId, int $categoryId) : void
    {
        // Logic to assign a product to a category

        $product = config("product-module.product_class")::findOrFail($productId);
        $category = config("product-module.category_class")::findOrFail($categoryId);

        $product->categories()->attach($category);
    }

    public function removeProductFromCategory(int $productId, int $categoryId) : void
    {
        // Logic to remove a product from a category

        $product = config("product-module.product_class")::findOrFail($productId);
        $category = config("product-module.category_class")::findOrFail($categoryId);

        $product->categories()->detach($category);
    }

    public function getProductCategories(int $productId) : \Illuminate\Database\Eloquent\Collection
    {
        // Logic to retrieve categories of a product

        $product = config("product-module.product_class")::findOrFail($productId);
        return $product->categories;
    }

    public function getCategoryProducts(int $categoryId) : \Illuminate\Database\Eloquent\Collection
    {
        // Logic to retrieve products of a category

        $category = config("product-module.category_class")::findOrFail($categoryId);
        return $category->products;
    }

    public function updateProduct(int $productId, ProductData $productData) : \Illuminate\Database\Eloquent\Model|Product
    {
        // Logic to update a product using the provided data

        $product = config("product-module.product_class")::findOrFail($productId);
        $product->update([
            "name" => $productData->name,
            "slug" => $productData->slug,
            "type" => $productData->type,
            "price" => $productData->price,
            "discount_price" => $productData->discount_price,
            "description" => $productData->description,
            "stock" => $productData->stock,
            "brand_id" => $productData->brand_id,
            "sku" => $productData->sku,
            "is_active" => $productData->is_active,
            "meta_data" => $productData->meta_data
        ]);

        return $product;
    }

    public function updateProductVariant(int $variantId, ProductVariantData $productVariantData) : \Illuminate\Database\Eloquent\Model|ProductVariant
    {
        // Logic to update a product variant using the provided data

        $variant = config("product-module.product_variant_class")::findOrFail($variantId);
        $variant->update([
            "product_id" => $productVariantData->product_id,
            "name" => $productVariantData->name,
            "slug" => $productVariantData->slug,
            "price" => $productVariantData->price,
            "discount_price" => $productVariantData->discount_price,
            "description" => $productVariantData->description,
            "stock" => $productVariantData->stock,
            "sku" => $productVariantData->sku,
            "is_active" => $productVariantData->is_active,
        ]);

        return $variant;
    }

    public function updateCategory(int $categoryId, CategoryData $categoryData) : \Illuminate\Database\Eloquent\Model|\CodeWithDiki\ProductModule\Models\Category
    {
        // Logic to update a category using the provided data

        $category = config("product-module.category_class")::findOrFail($categoryId);
        $category->update([
            "name" => $categoryData->name,
            "slug" => $categoryData->slug,
            "thumbnail_url" => $categoryData->thumbnail_url,
            "description" => $categoryData->description,
            "is_active" => $categoryData->is_active
        ]);

        return $category;
    }

    public function deleteProduct(int $productId) : void
    {
        // Logic to delete a product

        $product = config("product-module.product_class")::findOrFail($productId);
        $product->delete();
    }

    public function getProductByTag(string $tag) : \Illuminate\Database\Eloquent\Collection
    {
        // Logic to retrieve products by tag

        return config("product-module.product_class")::whereJsonContains("tags", $tag)->get();
    }

    public function getTags() : array
    {
        // Logic to retrieve all unique tags from products

        if(config("database.default") === "sqlite") {
            // For SQLite, we need to use a different approach to extract tags
            return config("product-module.product_class")::query()->selectRaw("DISTINCT json_each.value AS tag")
                ->fromRaw('products, json_each(products.tags)')
                ->pluck("tag")
                ->toArray();
        }

        return config("product-module.product_class")::selectRaw("DISTINCT JSON_UNQUOTE(JSON_EXTRACT(tags, '$[*]')) AS tag")
            ->pluck("tag")
            ->toArray();
    }

    public function createProductColor(ProductColorData $productColorData) : \Illuminate\Database\Eloquent\Model|\CodeWithDiki\ProductModule\Models\ProductColor
    {
        // Logic to create a product color using the provided data

        return config("product-module.product_color_class")::create([
            "product_id" => $productColorData->product_id,
            "label" => $productColorData->label,
            "color_hex" => $productColorData->color_hex,
            "is_primary" => $productColorData->is_primary,
            "is_active" => $productColorData->is_active
        ]);
    }

    public function createProductSize(ProductSizeData $productSizeData) : \Illuminate\Database\Eloquent\Model|\CodeWithDiki\ProductModule\Models\ProductSize
    {
        // Logic to create a product size using the provided data

        return config("product-module.product_size_class")::create([
            "product_id" => $productSizeData->product_id,
            "label" => $productSizeData->label,
            "value" => $productSizeData->value,
            "stock" => $productSizeData->stock,
            "is_active" => $productSizeData->is_active,
            "is_primary" => $productSizeData->is_primary
        ]);
    }

    public function createProductReview(ProductReviewData $productReviewData) : \Illuminate\Database\Eloquent\Model|\CodeWithDiki\ProductModule\Models\ProductReview
    {
        // Logic to create a product review using the provided data

        return config("product-module.product_review_class")::create([
            "product_id" => $productReviewData->product_id,
            "from" => $productReviewData->from,
            "rating" => $productReviewData->rating,
            "message" => $productReviewData->message
        ]);
    }

    public function createProductWrapper(ProductWrapperData $productWrapperData) : \Illuminate\Database\Eloquent\Model|\CodeWithDiki\ProductModule\Models\ProductWrapper
    {
        // Logic to create a product wrapper using the provided data

        return config("product-module.product_wrapper_class")::create([
            "product_id" => $productWrapperData->product_id,
            "product_variant_id" => $productWrapperData->product_variant_id,
            "color_id" => $productWrapperData->product_color_id,
            "size_id" => $productWrapperData->product_size_id
        ]);
    }

    public function decreaseStock(int $productId, int $quantity) : void
    {
        // Logic to decrease stock of a product

        $product = config("product-module.product_class")::findOrFail($productId);
        $product->decrement("stock", $quantity);
        $product->save();
    }

    public function increaseStock(int $productId, int $quantity) : void
    {
        // Logic to increase stock of a product

        $product = config("product-module.product_class")::findOrFail($productId);
        $product->increment("stock", $quantity);
        $product->save();
    }

    public function decreaseVariantStock(int $variantId, int $quantity) : void
    {
        // Logic to decrease stock of a product variant

        $variant = config("product-module.product_variant_class")::findOrFail($variantId);
        $variant->decrement("stock", $quantity);
        $variant->save();
    }

    public function increaseVariantStock(int $variantId, int $quantity) : void
    {
        // Logic to increase stock of a product variant

        $variant = config("product-module.product_variant_class")::findOrFail($variantId);
        $variant->increment("stock", $quantity);
        $variant->save();
    }

    public function decreaseProductColorStock(int $colorId, int $quantity) : void
    {
        // Logic to decrease stock of a product color

        $color = config("product-module.product_color_class")::findOrFail($colorId);
        $color->decrement("stock", $quantity);
        $color->save();
    }

    public function increaseProductColorStock(int $colorId, int $quantity) : void
    {
        // Logic to increase stock of a product color

        $color = config("product-module.product_color_class")::findOrFail($colorId);
        $color->increment("stock", $quantity);
        $color->save();
    }

    public function decreaseProductSizeStock(int $sizeId, int $quantity) : void
    {
        // Logic to decrease stock of a product size

        $size = config("product-module.product_size_class")::findOrFail($sizeId);
        $size->decrement("stock", $quantity);
        $size->save();
    }

    public function increaseProductSizeStock(int $sizeId, int $quantity) : void
    {
        // Logic to increase stock of a product size

        $size = config("product-module.product_size_class")::findOrFail($sizeId);
        $size->increment("stock", $quantity);
        $size->save();
    }

    public function getProductStock(int $productId) : int
    {
        // Logic to get stock of a product

        $product = config("product-module.product_class")::findOrFail($productId);
        return $product->stock;
    }

    public function getVariantStock(int $variantId) : int
    {
        // Logic to get stock of a product variant

        $variant = config("product-module.product_variant_class")::findOrFail($variantId);
        return $variant->stock;
    }

    public function getProductColorStock(int $colorId) : int
    {
        // Logic to get stock of a product color

        $color = config("product-module.product_color_class")::findOrFail($colorId);
        return $color->stock;
    }

    public function getProductSizeStock(int $sizeId) : int
    {
        // Logic to get stock of a product size

        $size = config("product-module.product_size_class")::findOrFail($sizeId);
        return $size->stock;
    }

    public function getProductColors(int $productId) : \Illuminate\Database\Eloquent\Collection
    {
        // Logic to get colors of a product

        $product = config("product-module.product_class")::findOrFail($productId);
        return $product->colors;
    }

    public function getProductSizes(int $productId) : \Illuminate\Database\Eloquent\Collection
    {
        // Logic to get sizes of a product

        $product = config("product-module.product_class")::findOrFail($productId);
        return $product->sizes;
    }

    public function getProductReviews(int $productId) : \Illuminate\Database\Eloquent\Collection
    {
        // Logic to get reviews of a product

        $product = config("product-module.product_class")::findOrFail($productId);
        return $product->reviews;
    }

    public function findProductById(int $productId) : \Illuminate\Database\Eloquent\Model|Product
    {
        // Logic to find a product by ID

        return config("product-module.product_class")::findOrFail($productId);
    }

    public function findProductVariantById(int $variantId) : \Illuminate\Database\Eloquent\Model|ProductVariant
    {
        // Logic to find a product variant by ID

        return config("product-module.product_variant_class")::findOrFail($variantId);
    }

    public function findCategoryById(int $categoryId) : \Illuminate\Database\Eloquent\Model|\CodeWithDiki\ProductModule\Models\Category
    {
        // Logic to find a category by ID

        return config("product-module.category_class")::findOrFail($categoryId);
    }


}
