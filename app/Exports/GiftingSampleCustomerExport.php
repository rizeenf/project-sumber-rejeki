<?php

namespace App\Exports;

use App\Models\HeaderVisit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GiftingSampleCustomerExport implements FromCollection ,WithMapping, WithHeadings
{
    protected $from, $to, $staff;
    function __construct($from, $to, $staff){
        $this->from = $from;
        $this->to = $to;
        $this->staff = $staff;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = HeaderVisit::with('user')
            ->with('customer')
            ->with('gift')
            ->whereHas('gift', function($query){
                $query->where('product_id', '!=', null);
            });
        $query->whereBetween('date', [$this->from, $this->to]);
        if($this->staff != NULL){
            $query->where('staff_id', $this->staff);
        }

        return $query->get();
    }

    public function map($headervisit): array
    {
        return[
            date('d/m/Y', strtotime($headervisit->date)),
            $headervisit->user->name,
            $headervisit->customer->code,
            $headervisit->customer->name,
            implode(",", collect($headervisit->gift)
                    ->reduce(function($acc, $i) {
                        $acc[] = 
                        $i->product->code;
                        return array_unique($acc);
                    }, 
            [])),
            implode(",", collect($headervisit->gift)
                    ->reduce(function($acc, $i) {
                        $acc[] = 
                        $i->product->name;
                        return array_unique($acc);
                    }, 
            [])),
            implode(",", collect($headervisit->gift)
                    ->reduce(function($acc, $i) {
                        $acc[] = 
                        $i->qty;
                        return array_unique($acc);
                    }, 
            [])),
        ];
    }

    public function headings(): array{
        return [
            'Tanggal Kunjungan',
            'Nama Staff',
            'Kode Gerai',
            'Nama Gerai',
            'Kode Barang',
            'Nama Barang',
            'Qty Barang'
        ];
    }
}
