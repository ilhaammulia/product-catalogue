<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;

class LandingController extends Controller
{
    public function products()
    {
        $brands = Brand::all();
        $categories = Category::all();

        $products = Product::all()->map(function ($product) {
            $image = $product->attachments()->where('type', 'image')->first();
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'slug' => $product->slug,
                'price' => $product->price,
                'image' => $image ? Storage::url($image->path) : '/assets/img/product-placeholder.png'
            ];
        });

        return Inertia::render('Landing/Products', [
            'brands' => $brands,
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function product_detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->to(route('landing.products'));
        }

        return Inertia::render('Product/Detail', [
            'product' => $product != null ? [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'stock_status' => $product->stock_status,
                'link' => $product->link,
                'brand' => $product->brand?->toArray(),
                'categories' => $product->categories->toArray(),
                'attachments' => $product->attachments->map(function ($file) {
                    return [
                        'src' => Storage::url($file->path),
                        'type' => $file->type
                    ];
                }),
            ] : null,
        ]);
    }

    public function terms()
    {
        return Inertia::render('Landing/Terms');
    }

    public function about()
    {
        return Inertia::render('Landing/About');
    }

    public function contact()
    {
        return Inertia::render('Landing/Contact');
    }

    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard');
    }
}
