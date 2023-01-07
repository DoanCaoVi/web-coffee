<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable = [//có thể insert dữ liệu và chỉ controller đc thừa kế bởi thằng class Material mới sử dụng đc những trường này
        'product_id','product_name','product_price','product_sales_quantity','product_coupon','product_feeship','order_code'
    ];
    protected $primaryKey = 'order_details_id';// nếu ko có trường này thì sẽ tự động lấy khoá chính là id và thường sẽ lỗi code
    protected $table = 'tbl_order_details';//lấy table

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
