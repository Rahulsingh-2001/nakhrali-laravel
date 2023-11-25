<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail(Product $slug)
    {
        $product = $slug;
        $products = Product::with(['media'])->where('id', '!=', $product->id)->where(['status' => 1, 'type_id' => $product->type_id])->latest()->limit(10)->get();
        $similar_product_list = view('frontend.products-listing', compact(['products']));

        return view('frontend.product-detail', compact('similar_product_list', 'product'));
    }

    public function getSizes(Request $request)
    {
        $product_id = $request->product_id;
        $color_id = $request->color_id;

        $variants = ProductVariant::where(['color_id' => $color_id, 'product_id' => $product_id])->get();
        $variant = view('frontend.widgets.sizes', compact(['variants']));

        return $variant;
    }

    public function addToCart(Request $request)
    {
        $res = [];
        $res['type'] = 'url';
        if (Auth::check()) {
            $product_id = $request->product_id ?? 0;
            $color_ids = $request->selected_color_id ?? [];

            foreach ($color_ids as $color_id) {
                $data = ['product_id' => $product_id, 'variant_id' => $color_id, 'user_id' => Auth::id()];
                $is_item_added = Cart::insert($data);
            }

            $res['url'] = route('frontend.user.cart');
        } else {
            $res['url'] =  route('frontend.auth.login');
        }

        return $res;
    }
}
