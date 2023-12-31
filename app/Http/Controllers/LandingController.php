<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\RequestTicket;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LandingController extends Controller
{
    public function home()
    {
        $products = Product::popular()->get();
        $products = $products->map(function ($product) {
            $image = $product->attachments?->first();
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'slug' => $product->slug,
                'price' => $product->price,
                'image' => $image ? Storage::url($image->path) : '/assets/img/product-placeholder.png',
            ];
        });
        return Inertia::render('Landing/Home', [
            'products' => $products,
        ]);
    }

    public function products(Request $request)
    {
        $brands = Brand::all();
        $categories = Category::all();

        $products = Product::filter()
            ->get()
            ->map(function ($product) {
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
            'related_products' => $product->related_products(),
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
        $productQuery = new Product();
        $total_products = $productQuery->count();
        $total_stocks = $productQuery->sum('stock');

        $notifications = RequestTicket::whereDate('created_at', Carbon::now())->get()->map(function ($notif) {
            return [
                'name' => $notif->name,
                'message' => $notif->message,
                'created_at' => $notif->created_at->format('d-m-Y')
            ];
        });

        return Inertia::render('Admin/Dashboard', [
            'meta' => [
                'total_products' => $total_products,
                'total_stocks' => $total_stocks,
                'total_tickets' => RequestTicket::count(),
                'total_users' => User::count(),
            ],
            'notifications' => $notifications
        ]);
    }

    public function fetch(Request $request)
    {
        $brands = Brand::all();
        $categories = Category::all();

        $products = Product::filter()
            ->get()
            ->map(function ($product) {
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

        return redirect()->to(route('landing.products'))->with([
            'brands' => $brands,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
