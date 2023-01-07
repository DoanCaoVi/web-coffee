<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable = [//có thể insert dữ liệu và chỉ controller đc thừa kế bởi thằng class coupon mới sử dụng đc những trường này
        'fee_matp','fee_maqh','fee_xaid','fee_feeship'
    ];
    protected $primaryKey = 'fee_id';// nếu ko có trường này thì sẽ tự động lấy khoá chính là id và thường sẽ lỗi code
    protected $table = 'tbl_freeship';//lấy table

    public function city(){
        return $this->belongsTo('App\Models\City','fee_matp');
    }
    public function province(){
        return $this->belongsTo('App\Models\Province','fee_maqh');
    }
    public function wards(){
        return $this->belongsTo('App\Models\Wards','fee_xaid');
    }
}
