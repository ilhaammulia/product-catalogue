<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttachment;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productQuery = new Product();
        $total_products = $productQuery->count();
        $total_stocks = $productQuery->sum('stock');
        $total_out_of_stocks = $productQuery->where('stock', '<', 1)->count();
        $products = $productQuery->orderBy('created_at', 'desc')->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'link' => $product->link,
                'stock' => $product->stock,
                'stock_status' => $product->stock_status,
                'brand' => [
                    'name' => $product->brand?->name,
                ],
                'created_at' => Carbon::parse($product->created_at)->format('d-m-Y')
            ];
        });

        return Inertia::render('Admin/Product', [
            'meta' => [
                'total_products' => $total_products,
                'total_stocks' => $total_stocks,
                'total_out_of_stocks' => $total_out_of_stocks,
            ],
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::get();
        $brands = Brand::get();


        return Inertia::render('Admin/Product/Add', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!is_numeric($request->brand_id)) {
                $brand = Brand::create(['name' => $request->brand_id]);
            } else {
                $brand = ['id' => $request->brand_id];
            }

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => Str::slug(now()->timestamp . ' ' . $request->name),
                'price' => $request->price,
                'currency' => $request->currency,
                'stock' => $request->stock,
                'stock_status' => $request->stock_status,
                'link' => $request->link,
                'brand_id' => $brand['id'],
            ]);


            foreach ($request->file('files') as $file) {
                $path = $file->store('products', ['disk' => 'public']);
                ProductAttachment::create([
                    'filename' => $file->getClientOriginalName(),
                    'path' => $path,
                    'type' => str_contains($file->getMimeType(), 'video') ? 'video' : 'image',
                    'product_id' => $product->id
                ]);
            }

            if ($request->categories) {
                foreach ($request->categories as $category) {
                    ProductCategory::create([
                        'product_id' => $product->id,
                        'category_id' => $category['id']
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->to(route('admin.product.add'));
        }

        return redirect()->to(route('admin.product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $product = Product::find($id);
        if (!$product) {
            return redirect()->to(route('admin.product'));
        }

        return Inertia::render('Admin/Product/Edit', [
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'slug' => $product->slug,
                'price' => $product->price,
                'link' => $product->link,
                'stock' => $product->stock,
                'stock_status' => $product->stock_status,
                'categories' => $product->categories->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'created_at' => $category->created_at,
                        'updated_at' => $category->updated_at
                    ];
                }),
                'brand_id' => $product->brand?->name,
                'files' => $product->attachments,
                'created_at' => Carbon::parse($product->created_at)->format('d-m-Y')
            ],
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $is_brand_exists = Brand::where('name', $request->brand_id)->first();

            if ($is_brand_exists) {
                $brand = $is_brand_exists;
            } else if (is_string($request->brand_id)) {
                $brand = Brand::create(['name' => $request->brand_id]);
            } else {
                $brand = ['id' => $request->brand_id];
            }

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'currency' => $request->currency,
                'stock' => $request->stock,
                'stock_status' => $request->stock_status,
                'link' => $request->link,
                'brand_id' => $brand->id,
            ]);

            if ($request->deleted_files) {
                foreach ($request->deleted_files as $deleted) {
                    Storage::disk('public')->delete($deleted['path']);
                    $find = ProductAttachment::find($deleted['id']);
                    $find->delete();
                }
            }

            if ($request->file('new_files')) {
                foreach ($request->file('new_files') as $file) {
                    $path = $file->store('products', ['disk' => 'public']);
                    ProductAttachment::create([
                        'filename' => $file->getClientOriginalName(),
                        'path' => $path,
                        'type' => str_contains($file->getMimeType(), 'video') ? 'video' : 'image',
                        'product_id' => $product->id
                    ]);
                }
            }

            if ($request->categories) {
                ProductCategory::where('product_id', $product->id)->delete();
                foreach ($request->categories as $category) {
                    ProductCategory::create([
                        'product_id' => $product->id,
                        'category_id' => $category['id']
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->to(route('admin.product.edit', ['id' => $product->id]));
        }

        return redirect()->to(route('admin.product'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->to(route('admin.product'));
        }
        DB::beginTransaction();
        try {
            foreach ($product->attachments as $file) {
                Storage::disk('public')->delete($file->path);
                $find = ProductAttachment::find($file->id);
                $find->delete();
            }

            $product->delete();
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th);
        }

        return redirect()->to(route('admin.product'));
    }
}
