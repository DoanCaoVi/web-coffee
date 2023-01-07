<?php

namespace App\Imports;

use App\CategoryProduct;
use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class Imports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CategoryProduct([
            'meta_keywords' => $row[0], //lấy dữ liểu để in ra excel
            'category_name' => $row[1],
            'meta_desc' => $row[2],
            'category_desc' => $row[3],
            'category_status' => $row[4],
        ]);

        return new Product([
            'product_name' => $row[0], //lấy dữ liểu để in ra excel
            'product_desc' => $row[1],
            'product_content' => $row[2],
            'product_price' => $row[3],
            'product_images' => $row[4],
            'product_status' => $row[5],
            'material_id' => $row[6],
            'category_id' => $row[7],
        ]);
    }
}







