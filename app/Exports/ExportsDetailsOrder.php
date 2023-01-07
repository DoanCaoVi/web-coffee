<?php

namespace App\Exports;

use App\Models\OrderDetails;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportsDetailsOrder implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrderDetails::all();
    }

}