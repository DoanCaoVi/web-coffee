@extends('Admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Xem Thông Tin chi tiết của đơn hàng
    </div>
    <div class="row w3-res-tb">
      
    </div>
    <div class="table-responsive">
    <?php
      $message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
      if($message){
         echo '<span class = "text-alert">',$message,'</span>';
          Session::put('message', null);
        }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
                STT
            </th>
            <th>Tên Sản phẩm</th>
            <th>Số lượng tồn kho còn</th>
            <th>Giá sản phẩm</th>
            <th>Số lượng</th>
            <!-- <th>Mã giảm giá</th> -->
            <th>Xuất sứ</th>
            <th>Tổng Tiền của mỗi sản phẩm</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @php
          $a = 0;
          $total = 0;
        @endphp
              @foreach($order_details_product as $key => $details)
              @php
                $a++;
                $subtotal = $details->product_price*$details->product_sales_quantity;
                $total += $subtotal;
              @endphp
          <tr class="color_qty_{{$details->product_id}}">
            <td><i>{{$a}}</i></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->product_quantity}}</td>
            <td>{{number_format($details->product_price,0,',','.')}} VNĐ</td>
            <td>
              <input type="number" min="1" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
              <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
              @if($order_status!=2)
                <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order">cập nhật</button>
              @endif
            <td>
            <!-- <td>@if($details->product_coupon!='no')
                  {{$details->product_coupon}}
    
                @else
                  Không có mã giảm giá!
                @endif
            </td> -->
            <td>{{number_format($subtotal,0,',','.')}} VNĐ</td>
            <td>{{number_format($subtotal,0,',','.')}} VNĐ</td>
            
          </tr>
        @endforeach
        <tr>
            <td colspan="2" style="color:#6c7d8b;font-weight:bold;font-size:1rem;">
            
            <!-- @php
              $total_coupon = 0;
              $tota=0;
            @endphp -->
            <!-- @if($coupon_condition == 1)
              @php
                $total_after_coupon = ($total*$coupon_number)/100;
                echo 'Tổng giảm:'.number_format($total_after_coupon,0,',','.').' VNĐ'.'</br>';
                $total_coupon = $total - $total_after_coupon;
              @endphp
            @else
              @php
                echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').' VNĐ'.'</br>';
               
              @endphp
            @endif -->
           
            Tổng Tiền chi: {{number_format($total,0,',','.')}} VNĐ
            </td>
        </tr>
        <tr>
          <td colspan="6" style="color:#6c7d8b;font-weight:bold;font-size:1rem;">
          @foreach($order as $key => $or)
            @if($or->order_status == 1)
            <form action="">
               @csrf
              <select class="form-control order_details">
                <option  value="">----------Vui lòng chọn hình thức xử lý----------</option>
                <option data-id="{{$or->order_id}}" value="1" selected>Chưa xử lý</option>
                <option data-id="{{$or->order_id}}" value="2">Đã xử lý</option>
                <!-- <option data-id="{{$or->order_id}}" value="3">Hủy đơn</option> -->
              </select>              
            </form>
            @elseif($or->order_status == 2)
            <form action="">
              @csrf
              <select class="form-control order_details">
                <option  value="">----------Vui lòng chọn hình thức xử lý----------</option>
                <option data-id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                <option data-id="{{$or->order_id}}" value="2" selected>Đã xử lý</option>
                <!-- <option data-id="{{$or->order_id}}" value="3">Hủy đơn</option> -->
              </select>              
            </form>
            @else
            <form action="">
              @csrf
              <select class="form-control order_details">
                <option  value="">----------Vui lòng chọn hình thức xử lý----------</option>
                <option data-id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                <option data-id="{{$or->order_id}}" value="2">Đã xử lý</option>
                <!-- <option data-id="{{$or->order_id}}" value="3" selected>Hủy đơn</option> -->
              </select>              
            </form>
            @endif
          @endforeach
          </td>
        </tr>
        </tbody>
      </table>
      <!-- lệnh target = _blank khi bấm vào sẽ sinh ra một cái trang pdf mới -->
    </div>
    <a class="back" style="text-decoration:none;font-size: 24px;
      background: #737979;color: #fffdfd;font-weight: bold;
      border-radius: 32px;border: 5px solid #ffcccc;padding: 6px;margin-bottom:5px;" 
      target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
    <form action="{{url('export-orderdetails')}}" method="POST" style="margin-top:50px;">
            @csrf
        <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
    </form>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Xem Thông Đơn Hàng
    </div>
    
    <div class="table-responsive">
    <?php
      $message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
      if($message){
         echo '<span class = "text-alert">',$message,'</span>';
          Session::put('message', null);
        }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Tên người mua</th>
            <th>Số điện thoại</th>
            <th>Email</th>
        


            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
  
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>

   
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Xem Thông vận chuyển
    </div>
    
    <div class="table-responsive">
    <?php
      $message = Session::get('message');//lấy cái key message bên routes trong web.php qua và hiển thị nội dung của nó
      if($message){
         echo '<span class = "text-alert">',$message,'</span>';
          Session::put('message', null);
        }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số Điện Thoại</th>
            <th>Ghi chú</th>
            <th>Email</th>
            <th>Hình Thức Thanh Toán</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
  
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_notes}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>@if($shipping->shipping_method==0) Chuyển Khoản @else Tiền mặt @endif</td>
          </tr>
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
<br></br>

@endsection        