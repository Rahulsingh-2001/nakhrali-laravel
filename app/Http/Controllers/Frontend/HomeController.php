<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Tests\Integration\Database\EloquentHasManyThroughTest\Category;
use Str;

class HomeController extends Controller
{
    public function home()
    {

        $featured_products = Product::with(['media'])->where(['status' => 1, 'is_featured' => 1])->limit(8)->get();

        $latest_products = Product::with('media')->where('status', 1)->latest('created_at')->get();

        $top_selling_products = Product::with('media')->where(['status' => 1, 'is_top_selling' => 1])->limit(8)->get();

        $product_types = ProductType::where(['status' => 1])->get();

        return view('frontend.home', compact('featured_products', 'latest_products', 'top_selling_products', 'product_types'));
    }

    public function listing(Request $request)
    {

        $search = $request->search ?? null;

        $product_types = ProductType::where(['status' => 1])->get();

        $products_query = Product::with(['media'])->where(['status' => 1]);

        $cat = 0;

        if (isset($request->cat)) {
            $cat = $request->cat;
            $products_query = $products_query->whereHas('type', function ($query) use ($cat) {
                return $query->where('title', 'like', $cat);
            });
        }

        if ($search) {
            $products_query = $products_query->where('title', 'LIKE', "%$search%");
        }

        $products =  $products_query->limit(10)->get();

        $product_list = view('frontend.products-listing', compact(['products']));

        return view('frontend.listing', compact(['product_list', 'product_types', 'cat']));
    }

    public function loadMore(Request $request)
    {
        $type_id = $request->type ?? 0;
        $sort = $request->sort ?? 0;
        $price = $request->price ?? 0;
        $search_val = $request->search_val ? Str::of($request->search_val)->replace('+', ' ') : '';

        $products_query = Product::with(['media'])->where(['status' => 1]);

        if ($price > 0) {
            $prices  = explode('-', $price);
            $products_query = $products_query->whereBetween('sale_price', $prices);
        }

        if ($type_id > 0) {
            $products_query = $products_query->where('type_id', $type_id);
        }

        if ($sort > 0) {
            switch ($sort) {
                case 'latest':
                    $products_query = $products_query->latest();
                    break;

                case 'name':
                    $products_query = $products_query->orderBy('title');
                    break;

                case 'low_price':
                    $products_query = $products_query->orderBy('sale_price');
                    break;

                case 'high_price':
                    $products_query = $products_query->orderBy('sale_price', 'desc');
                    break;

                case 'featured':
                    $products_query = $products_query->where('is_featured', 1);
                    break;

                default:
                    $products_query = $products_query->latest();
                    break;
            }
        }

        if ($search_val) {
            $products_query = $products_query->where('title', 'LIKE', "%$search_val%");
        }

        $products = $products_query->paginate(10);

        $product_list = view('frontend.products-listing', compact(['products']));

        return $product_list;
    }
}
