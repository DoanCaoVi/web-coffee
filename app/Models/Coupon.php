<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
 
    public $timestamps = false;//set time to false
    protected $fillable = [//có thể insert dữ liệu và chỉ controller đc thừa kế bởi thằng class coupon mới sử dụng đc những trường này
        'coupon_name','coupon_code','coupon_times','coupon_number','coupon_condition'
    ];
    protected $primaryKey = 'coupon_id';// nếu ko có trường này thì sẽ tự động lấy khoá chính là id và thường sẽ lỗi code
    protected $table = 'tbl_coupon';//lấy table
}
