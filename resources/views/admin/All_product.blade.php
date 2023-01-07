@extends('Admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Tất Cả Các Sản Phẩm
    </div>
    <div class="row w3-res-tb">
      <!-- <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>   -->              
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
  <!--       <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div> -->
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số sượng tồn kho</th>
            <th>Danh mục</th>
            <th>Hình ảnh</th>
            <th>Xuất xứ</th>
            <th>Loại</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
              @foreach($all_product as $key => $pro_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$pro_pro->product_name}}</td>
            <td>{{$pro_pro->product_price}}</td>
            <td>{{$pro_pro->product_quantity}}</td>
            <td>{{$pro_pro->category_name}}</td>
            <td><img src="public/uploads/product/{{$pro_pro->product_image}} " height="200px" width="300px"> </td> <!-- hiện hình ảnh đã có -->
            <td>{{$pro_pro->product_origin}}</td>
            <td>{{$pro_pro->material_name}}</td>

            <td><span class="text-ellipsis">
              <?php
              if($pro_pro->product_status==0){
                ?>
                <a href = "{{URL::to('/unactive-product/'.$pro_pro->product_id)}}"><span class ="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
              } else{
                ?>
                <a href = "{{URL::to('/active-product/'.$pro_pro->product_id)}}"><span class ="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
              }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro_pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc chắn rằng là muốn Xoá Danh Mục Này Không ???')" href="{{URL::to('/delete-product/'.$pro_pro->product_id)}}" class="active styling-delete" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>

          @endforeach
        </tbody>
      </table>
    </div>
    
<!--     <form action="{{url('import-product')}}" method="POST" enctype="multipart/form-data">
          @csrf
        <input type="file" name="file" accept=".xlsx"><br>
        <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
   </form> -->
              <!-- export-data -->
    <form action="{{url('export-product')}}" method="POST">
            @csrf
        <input type="submit" value="Xuất ra file Excel" name="export_csv" class="btn btn-success">
    </form>

    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
         <!--  <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> -->
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