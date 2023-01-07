<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable = [//có thể insert dữ liệu và chỉ controller đc thừa kế bởi thằng class Material mới sử dụng đc những trường này
        'shipping_name','shipping_notes','shipping_method','shipping_address','shipping_phone','shipping_email'
    ];
    protected $primaryKey = 'shipping_id';// nếu ko có trường này thì sẽ tự động lấy khoá chính là id và thường sẽ lỗi code
    protected $table = 'tbl_shipping';//lấy table
}
