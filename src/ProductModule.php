<?php

namespace CodeWithDiki\ProductModule;

use CodeWithDiki\ProductModule\Data\CategoryData;
use CodeWithDiki\ProductModule\Data\ProductData;
use CodeWithDiki\ProductModule\Data\ProductVariantData;
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

}
