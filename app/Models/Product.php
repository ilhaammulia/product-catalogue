<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'price',
        'currency',
        'stock',
        'link',
        'stock_status',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function attachments()
    {
        return $this->hasMany(ProductAttachment::class, 'product_id');
    }

    public function scopeFilter($query)
    {

        if (request('categories') && request('brands')) {
            $query->whereHas('categories', function ($q) {
                return $q->whereIn('category_id', request('categories'));
            });
            $query->orWhereIn('brand_id', request('brands'));
        } else if (request('brands')) {
            $query->whereIn('brand_id', request('brands'));
        } else if (request('categories')) {
            $query->whereHas('categories', function ($q) {
                return $q->whereIn('category_id', request('categories'));
            });
        }

        $minPrice = request('min_price');
        $maxPrice = request('max_price');

        if ($minPrice && $minPrice['value']) {
            $rate = ExchangeRate::where('currency', $minPrice['currency'])->first();
            $query->where('price', '>=', $minPrice['value'] * ($rate ? $rate->value : 1));
        }

        if ($maxPrice && $maxPrice['value']) {
            $rate = ExchangeRate::where('currency', $maxPrice['currency'])->first();
            $query->where('price', '<=', $maxPrice['value'] * ($rate ? $rate->value : 1));
        }

        if (request('search')) {
            $query->where(DB::raw('LOWER(name)'), 'like', '%' . Str::lower(request('search')) . '%');
        }
    }

    public function related_products()
    {
        $relatedProducts = DB::table('products as p1')
            ->inRandomOrder()
            ->limit(10)
            ->join('product_categories as pc1', 'p1.id', '=', 'pc1.product_id')
            ->join('categories as c1', 'pc1.category_id', '=', 'c1.id')
            ->join('product_categories as pc2', function ($join) {
                $join->on('c1.id', '=', 'pc2.category_id')
                    ->on('pc1.product_id', '<>', 'pc2.product_id');
            })
            ->join('products as p2', 'pc2.product_id', '=', 'p2.id')
            ->join('brands as b1', 'p2.brand_id', '=', 'b1.id')
            ->join('products as p3', function ($join) {
                $join->on('b1.id', '=', 'p3.brand_id')
                    ->on('p2.id', '<>', 'p3.id');
            })
            ->where('p1.id', '<>', $this->id)
            ->select(
                'p2.id as product_id_1',
                'p2.name as product_name_1',
                'p2.description as product_description_1',
                'p2.slug as product_slug_1',
                'p2.price as product_price_1',
                'p3.id as product_id_2',
                'p3.name as product_name_2',
                'p3.description as product_description_2',
                'p3.slug as product_slug_2',
                'p3.price as product_price_2'
            )
            ->get();

        $flatRelatedProducts = collect($relatedProducts)->flatMap(function ($product) {
            $image1 = $this->find($product->product_id_1)->attachments()->where('type', 'image')->first();
            $image2 = $this->find($product->product_id_2)->attachments()->where('type', 'image')->first();

            return [
                [
                    'id' => $product->product_id_1,
                    'name' => $product->product_name_1,
                    'description' => $product->product_description_1,
                    'slug' => $product->product_slug_1,
                    'price' => $product->product_price_1,
                    'image' => $image1 ? Storage::url($image1->path) : '/assets/img/product-placeholder.png',
                ],
                [
                    'id' => $product->product_id_2,
                    'name' => $product->product_name_2,
                    'description' => $product->product_description_2,
                    'slug' => $product->product_slug_2,
                    'price' => $product->product_price_2,
                    'image' => $image2 ? Storage::url($image2->path) : '/assets/img/product-placeholder.png',
                ],
            ];
        });

        return $flatRelatedProducts->unique('id')->values()->all();
    }
}
