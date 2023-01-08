@extends('Admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Xem Thông Tin chi tiết của nhập kho
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
            <th>Xuất xứ</th>
            <th>Tổng Tiền của sản phẩm</th>
          </tr>
        </thead>
        <tbody>
        @php
          $a = 0;
          $total = 0;
        @endphp
          @php
            $b = 0;
            $detailsprint = 0;
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
            </td>
            <td>{{$details->product->product_origin}}</td>
            <td>{{number_format($subtotal,0,',','.')}} VNĐ</td>
          </tr>
              @php
                $b++;
                $detailsprint +=$order_status+$b;
              @endphp
            @if($detailsprint==2 || $detailsprint==3)
              <button>
                <a class="box" target="_blank" href="{{url('/print-order/'.$details->order_code)}}">Print....</a>
              </button>
            @endif
        @endforeach
        <tr>
            <td colspan="2" style="color:#6c7d8b;font-weight:bold;font-size:1rem;">
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

  <form action="{{url('export-orderdetails')}}" method="POST" style="margin-top:20px;">
    @csrf
    <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
  </form>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <!-- <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li> -->
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người nhập kho
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

            <th>Tên người nhập</th>
            <th>Số điện thoại</th>
            <th>Email</th>
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
            <!-- <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li> -->
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
<br></br>

@endsection        