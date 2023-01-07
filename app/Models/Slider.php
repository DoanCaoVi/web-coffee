<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable = [//có thể insert dữ liệu và chỉ controller đc thừa kế bởi thằng class coupon mới sử dụng đc những trường này
        'slider_name','slider_image','slider_status','slider_desc'
    ];
    protected $primaryKey = 'slider_id';// nếu ko có trường này thì sẽ tự động lấy khoá chính là id và thường sẽ lỗi code
    protected $table = 'tbl_slider';//lấy table
}
