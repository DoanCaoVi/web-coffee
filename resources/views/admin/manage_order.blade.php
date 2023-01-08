@extends('Admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách tất cả các đơn hàng đã đặt
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
            <th>Số Thứ Tự</th>
            <th>Mã code order</th>
            <th>Thời gian gửi</th>
            <th>Tình trạng order</th>
          </tr>
        </thead>
        <tbody>
          @php
          $a = 0;
          @endphp
              @foreach($order as $key => $ord)
              @php
                $a++;
              @endphp
  
          <tr>
            <td><i>{{$a}}</i></label></td>
            <td>{{$ord->order_code}}</td>
            <td>{{$ord->created_at}}</td>
            <td>
                @if($ord->order_status==1)
                  Đơn hàng mới
                @else
                  Đã xử lý
                @endif
            </td>
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-eye text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn rằng là muốn Xoá đơn Này Không ???')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-delete" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>

          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
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
@endsection        