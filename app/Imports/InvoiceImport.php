<?php

namespace App\Imports;

use App\Models\Invoice;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoiceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
            //
            'serie' => $row[0],
            'base' => $row[1],
            'iva' => $row[2],
            'total' => $row[3],
            'user_id' => 1,
            'created_at' => $myDate = is_numeric($row[4]) ? Carbon::instance(Date::excelToDateTimeObject($row[4])) : Carbon::createFromFormat('d/m/Y',$row[4]),
        ]);
    }
}
