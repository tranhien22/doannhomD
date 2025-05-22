<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $user_id = session('cart')['user_id'];
        
        $cart = DB::table('carts')
        ->where('id_user', "=", $user_id)
        ->first();

        $order = DB::table('order')
        ->where('id_user', "=", $user_id)
        ->where('total_order', "=", '0')
        ->first();        

        if($cart == null)
        {
            return redirect()->route('cart.indexCart');
        }
        else
        {
            if($order) {
                DB::table('order')->where('id_order', '=', $order->id_order)->delete();
                Order::create([
                    'id_user' => $user_id,
                    'total_order' => 0,
                    'address' => ""
                ]);
            }
            else
            {
                Order::create([
                    'id_user' => $user_id,
                    'total_order' => 0,
                    'address' => ""
                ]);                
            }
            
            // Cập nhật số lượng đơn hàng
            $orderCount = Order::where('id_user', $user_id)->count();
            session(['order_count' => $orderCount]);
            
            return redirect()->route('payment.paymentindex');
        }        
    }

    public function orderIndex()
    {
        $user_id = session('cart')['user_id'];

        $order = DB::table('order')
        ->where('id_user', "=", $user_id)
        ->get();

        return view('user.myorder', ['order' => $order]);
    }
    
    public function showOrder()
    {
        $order = Order::where('id_user', auth()->id())->orderBy('created_at', 'desc')->get();
    
        return view('user.myorder', compact('order')); 
    }

    public function getCount()
    {
        if (!session('cart') || !isset(session('cart')['user_id'])) {
            return response()->json(['count' => 0]);
        }

        $orderCount = Order::where('id_user', session('cart')['user_id'])->count();
        return response()->json(['count' => $orderCount]);
    }
    public function deleteOrder($id_order)
    {
        $user_id = session('cart')['user_id'];
        Order::where('id_order', $id_order)->delete();
        
        // Cập nhật số lượng đơn hàng
        $orderCount = Order::where('id_user', $user_id)->count();
        session(['order_count' => $orderCount]);
        
        return redirect()->back();
    }


}
