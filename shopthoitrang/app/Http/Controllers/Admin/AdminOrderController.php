<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\DetailsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function orderindexAdmin(Request $request)
    {
        // Kiểm tra tham số page
        if ($request->has('page')) {
            $page = $request->get('page');
            
            // Kiểm tra nếu page không phải là số
            if (!is_numeric($page)) {
                return redirect()->route('admin.orderindexAdmin')->with('error', 'Trang không hợp lệ');
            }
            
            // Kiểm tra nếu page là số âm hoặc quá lớn
            $totalOrders = Order::count();
            $perPage = 2; // Số đơn hàng trên mỗi trang
            $maxPage = ceil($totalOrders / $perPage);
            
            if ($page < 1 || $page > $maxPage) {
                return redirect()->route('admin.orderindexAdmin')->with('error', 'Trang không tồn tại');
            }
        }

        $order = Order::paginate(2);
        return view('admin.order.orderindex', ['order' => $order]);
    }

    public function adminDetailsOrderIndex(Request $request)
    {
        $id_order = $request->get('id_order');
        
        // Kiểm tra nếu id_order không phải là số
        if (!is_numeric($id_order)) {
            return redirect()->route('admin.orderindexAdmin')->with('error', 'Không tìm thấy trang');
        }
        
        // Kiểm tra xem đơn hàng có tồn tại không
        $orderExists = Order::where('id_order', $id_order)->exists();
        if (!$orderExists) {
            return redirect()->route('admin.orderindexAdmin')->with('error', 'Không tìm thấy trang');
        }

        $order = DB::table('products')
        ->join('detailsorder', 'products.id_product', "=", 'detailsorder.id_product')
        ->join('order', 'detailsorder.id_order', "=", 'order.id_order')
        ->where('order.id_order', "=", $id_order)
        ->get();

        return view('admin.order.detailorder', ['order' => $order]);
    }

    public function admindetailsorderdelete(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $id_order = $request->get('id_order');
            
            // Kiểm tra xem đơn hàng có tồn tại không
            $order = Order::where('id_order', $id_order)->first();
            
            if (!$order) {
                DB::rollBack();
                return redirect()->route('admin.orderindexAdmin')->with('error', 'Xóa không hợp lệ vui lòng load lại trang');
            }
            
            // Xóa chi tiết đơn hàng
            DetailsOrder::where('id_order', $id_order)->delete();
            
            // Xóa đơn hàng
            $order->delete();
            
            DB::commit();
            return redirect()->route('admin.orderindexAdmin')->with('success', 'Xóa đơn hàng thành công');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.orderindexAdmin')->with('error', 'Xóa không hợp lệ vui lòng load lại trang');
        }
    }

    public function adminSearchOrder(Request $request)
    {
        $data = $request->all();
        $search = $data['id'];
        $orders = Order::where('id_order', $search)
        ->orWhere('id_user', $search)->get();
        return view('admin.order.findorder', ['orders' => $orders]);
    }
}
