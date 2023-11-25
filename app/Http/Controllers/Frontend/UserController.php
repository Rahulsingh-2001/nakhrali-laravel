<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Http\Requests\Frontend\UserProfileRequest;
use App\Models\Cart;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\WishList;
use Auth;
use Illuminate\Http\Request;
use JsValidator;

class UserController extends Controller
{
    public function cart()
    {
        $user_id = Auth::id();
        $cart_item = Cart::where(['user_id' => $user_id, 'order_status' => 'PENDING'])->with(['product', 'variant'])->get();
        return view('frontend.user.cart', compact('cart_item'));
    }

    public function wishList()
    {
        $user_id = Auth::id();
        $wish_list_items = WishList::where('user_id', $user_id)->with(['product'])->get();
        return view('frontend.user.wishlist', compact('wish_list_items'));
    }

    public function removeItemFromCart(Request $request)
    {
        $item_id = $request->item_id;
        $user_id = Auth::id();
        if ($item_id) {
            $is_removed = Cart::where(['id' => $item_id, 'user_id' => $user_id])->delete();

            if ($is_removed) {
                return true;
            }

            return false;
        }
    }
    public function removeItemFromWishlist(Request $request)
    {
        $item_id = $request->item_id;
        $user_id = Auth::id();
        if ($item_id) {
            $is_removed = WishList::where(['id' => $item_id, 'user_id' => $user_id])->delete();

            if ($is_removed) {
                return true;
            }

            return false;
        }
    }

    public function clearCart()
    {
        $user_id = Auth::id();
        $is_cleared = Cart::where('user_id', $user_id)->delete();

        if ($is_cleared) {
            return true;
        }
        return false;
    }

    public function addToWishList(Request $request)
    {
        $res = [];
        $product_id = $request->product_id ?? 0;
        $data = ['product_id' => $product_id, 'user_id' => Auth::id()];

        $is_item_added = WishList::insert($data);

        $res = route('frontend.user.wish-list');

        return $res;
    }

    public function checkoutProcess(CheckoutRequest $request)
    {
        $user_id = Auth::id();
        $validated_data = $request->validated();
        $cart_items = Cart::with(['product'])->where(['user_id' => $user_id, 'order_status' => 'PENDING'])->get();
        $amount = 0;

        foreach ($cart_items as $item) {
            $item_price = $item->product->sale_price;
            $total_quantity = $item->quantity;
            $amount += ($item_price * $total_quantity);
        }
    }

    public function profile()
    {
        $validator = JsValidator::formRequest(UserProfileRequest::class, '#userProfileForm');
        return view('frontend.user.profile', compact(['validator']));
    }

    public function updateProfile(UserProfileRequest $request)
    {
        $validated_data = $request->validated();
        $is_profile_updated = User::updateOrCreate(['id' => Auth::id()], $validated_data);
        return redirect(route('frontend.user.profile'))->with('sucess', 'Profile has been updated');
    }

    public function referAFriend()
    {
        return view('frontend.user.refer');
    }
}
