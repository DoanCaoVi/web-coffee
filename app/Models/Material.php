<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable = [//có thể insert dữ liệu và chỉ controller đc thừa kế bởi thằng class Material mới sử dụng đc những trường này
        'material_name','material_desc','material_status'
    ];
    protected $primaryKey = 'material_id';// nếu ko có trường này thì sẽ tự động lấy khoá chính là id và thường sẽ lỗi code
    protected $table = 'tbl_material';//lấy table
/*     public function chatlieu(){
        return $this->belongsTo('App\Models','material_id');
    } */
}
