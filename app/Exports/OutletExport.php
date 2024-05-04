<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OutletExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select('code', 'name', 'phone', 'address', 'LA', 'LO', 'area', 'subarea')
        ->where('type', 'O')
        ->get();
    }

    public function headings(): array{
        return [
            'Kode',
            'Nama',
            'No. Telfon',
            'Alamat',
            'Latitude',
            'Longitude',
            'Area',
            'Sub Area'
        ];
    }
}
