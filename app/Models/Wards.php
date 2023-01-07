<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable = [//có thể insert dữ liệu và chỉ controller đc thừa kế bởi thằng class coupon mới sử dụng đc những trường này
        'name_xaphuongthitran','type','maqh'
    ];
    protected $primaryKey = 'xaid';// nếu ko có trường này thì sẽ tự động lấy khoá chính là id và thường sẽ lỗi code
    protected $table = 'tbl_xaphuongthitran';//lấy table
}
