<?php

namespace App\Http\Controllers;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use PDF;
use Session;

use App\Imports\ExcelImports;
use App\Exports\ExportsDetailsOrder;
use Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
session_start();


class OrderController extends Controller
{
    public function update_qty(Request $request){
        $data = $request->all();
        $order_details = OrderDetails::where('product_id', $data['order_product_id'])->where('order_code', $data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }

    public function update_order_qty(Request $request){
        //update order
        $data = $request ->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if($order->order_status==2){
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){

                    if($key == $key2){
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                    }

                }

            }
        }elseif($order->order_status!=2 && $order->order_status!=3){
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){

                    if($key == $key2){
                        $pro_remain = $product_quantity + $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold - $qty;
                        $product->save();
                    }

                }

            }
        }
    }

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin_managers');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::where('order_code',$checkout_code)->get();
        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id =$ord->customer_id;
            $shipping_id =$ord->shipping_id;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        // $order_details_product = OrderDetails::where('order_code',$checkout_code)->get();
        // foreach($order_details as $key => $order_d){
        //     $product_coupon = $order_d->product_coupon;
        // }
        // if($product_coupon!='no'){
        //     $coupon = Coupon::Where('coupon_code',$product_coupon)->first();;
        //     $coupon_condition = $coupon['coupon_condition'];
        //     $coupon_number = $coupon['coupon_number'];
        //     if($coupon_condition==1){
        //         $coupon_echo = $coupon_number.' %';
        //     }elseif($coupon_condition==2){
        //         $coupon_echo = number_format($coupon_number,0,',','.').' VNĐ';
        //     }
        // }else{
        //     $coupon_condition = 2;
        //     $coupon_number = 0;
        //     $coupon_echo = '0';
        // }
        $output = '';
        //$coupon_echo = number_format($coupon_number,0,',','.').' VNĐ';
        $output.='
            <style>
                body{
                    font-family:Dejavu sans;
                }
            .table-styling{
                border: 1px solid #000;
                width: 100%;
                max-width: 100%;
            }

            .table-styling tbody tr td{
                border: 1px solid #000;
            }
            </style>
                <h4><center>Độc lập - tự do - Hạnh phúc</center></h4>
                <h4><center>Hoá Đơn</center></h4>
                <p>Người đặt hàng: </p>
                <table class="table-styling">
                    <thead>
                        <tr>
                            <th>Tên Khách hàng đặt</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>';
             $output.='
                        <tr>
                            <td>'.$customer->customer_name.'</td>
                            <td>'.$customer->customer_phone.'</td>
                            <td>'.$customer->customer_email.'</td>
                        </tr>';
            $output.='  
                    </tbody>
                </table>
                

        <p>Giao hàng tới: </p>
                <table class="table-styling">
                    <thead>
                        <tr>
                            <th>Tên người nhận</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>';
             $output.='
                        <tr>
                            <td>'.$shipping->shipping_name.'</td>
                            <td>'.$shipping->shipping_email.'</td>
                            <td>'.$shipping->shipping_address.'</td>
                            <td>'.$shipping->shipping_phone.'</td>
                            <td>'.$shipping->shipping_notes.'</td>
                        </tr>';
            $output.='  
                    </tbody>
                </table>

    <p>Chi tiết đơn hàng: </p>
                <table class="table-styling">
                    <thead>
                        <tr>
                            <th>Tên Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá tiền của sản phẩm</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>';

                    $total = 0;

                    foreach($order_details as $key => $product){
                    $subtotal = $product->product_price*$product->product_sales_quantity;
                    $total += $subtotal;

                    // if($product->product_coupon!='no'){
                    //     $product_coupon = $product->product_coupon;
                    // }else{
                    //     $product_coupon = "Không có mã giảm giá";
                    // }
   
                    $output.='
                        <tr>
                            <td>'.$product->product_name.'</td>
                           
                            <td>'.$product->product_sales_quantity.'</td>
                            <td>'.number_format($product->product_price,0,',','.').' VNĐ'.'</td>
                            <td>'.number_format($subtotal,0,',','.').' VNĐ'.'</td>

                        </tr>';
                    }
                    // if($coupon_condition == 1){
                    //     $total_after_coupon = ($total*$coupon_number)/100;
                    //     /* echo 'Tổng giảm:'.number_format($total_after_coupon,0,',','.').' VNĐ'.'</br>'; */
                    //     $total_coupon = $total - $total_after_coupon;
                    // }else{
                    //     /* echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').' VNĐ'.'</br>'; */
                       
                    // }
            $output.='
                    <tr>
                        <td colspan="2">
                            <p>Tổng tiền chi: '.'</br>'.number_format($total,0,',','.').' VNĐ'.'</p>
                        </td>
                    </tr>';
            $output.='   
                    </tbody>
                </table>
                
        <p>Ký tên </p>
                <table >
                    <thead>
                        <tr>
                            <th  style="width:200px;">Người lập phiếu</th>
                            <th style="width:800px;">Người nhận</th>
                        </tr>
                    </thead>
                    <tbody>';
            $output.='  
                    </tbody>
                </table>';

        return $output;//nhớ trả về
    }

    public function view_order($order_code){
        $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
            $customer_id =$ord->customer_id;
            $shipping_id =$ord->shipping_id;
            $order_status =$ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code',$order_code)->get();

        foreach($order_details as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
        }
        // if($product_coupon!='no'){
        //     $coupon = Coupon::Where('coupon_code',$product_coupon)->first();;
        //     $coupon_condition = $coupon['coupon_condition'];
        //     $coupon_number = $coupon['coupon_number'];
        // }else{
        //     $coupon_condition = 2;
        //     $coupon_number = 0;
        // }

        return view('admin.view_order')->with(compact('order_details', 'customer', 'shipping', 'order_details_product', 'order','order_status'));
    }

    public function delete_order($order_code){
        $this->AuthLogin();
        Order::where('order_code',$order_code)->delete();
        Session::put('message','Xoá danh thông tin thành công');
        return Redirect::to('manage-order');
    }

    public function manage_order(){
        $order = Order::orderby('created_at','DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
    
    public function export_orderdetails(){
        return Excel::download(new ExportsDetailsOrder, 'orderdetails.xlsx');
    }
}
