@extends('Admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách mã giảm giá
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
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
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Điều kiện</th>
            <th>Số tiền giảm</th>
          </tr>
        </thead>
        <tbody>
              @foreach($coupon as $key => $cou)
          <tr>
          <td>{{$cou->coupon_name}}</td>
          <td>{{$cou->coupon_code}}</td>
            <td>{{$cou->coupon_times}}</td>
            <td>
                <span class="text-ellipsis">
                    <?php
                    if($cou->coupon_condition==1){
                        ?>
                        Giảm theo %
                        <?php
                    } else{
                        ?>
                       Giảm theo tiền
                        <?php
                    }
                    ?>
                </span>
            </td>
            <td>
                <span class="text-ellipsis">
                    <?php
                    if($cou->coupon_condition==1){
                        ?>
                        Giảm {{$cou->coupon_number}} %
                        <?php
                    } else{
                        ?>
                        Giảm {{$cou->coupon_number}} VNĐ
                        <?php
                    }
                    ?>
                </span>
            </td>
            <td>
              
              <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn rằng là muốn Xoá mã này không Này Không ???')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-delete" ui-toggle-class="">
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