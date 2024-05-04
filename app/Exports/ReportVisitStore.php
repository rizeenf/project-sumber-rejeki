<?php

namespace App\Exports;

use App\Models\HeaderVisit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportVisitStore implements FromCollection ,WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // protected $from, $to;

    // function __construct($from, $to){
    //     $this->from = $from;
    //     $this->to = $to;
    // }

    public function collection()
    {
        return HeaderVisit::whereHas('customer', function($query){
            $query->where('type', 'S');
        })
        // ->whereBetween('date', [$this->from, $this->to])
        ->get();
    }

    public function map($headervisit): array
    {
        $headervisit->banner == 1 ? $banner = 'Sudah Pasang' : $banner = 'Belum Pasang';
        return [
            [
                date('d/m/Y', strtotime($headervisit->date)),
                $headervisit->user->name,
                $headervisit->customer->code,
                $headervisit->customer->name,
                $headervisit->customer->address,
                $headervisit->time_in,
                $headervisit->time_out,
                $headervisit->LA,
                $headervisit->LO,
                $banner,
                $headervisit->activity,
                $headervisit->note,
                implode(",", collect($headervisit->detail_store)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->display->name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->detail_store)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->category->name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->available_stok)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->brand->name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->store_reason)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->unproductive_reason->name;
                        return array_unique($acc);
                    }, 
                [])),
            ],
        ];
    }

    public function headings(): array{
        return [
            'Tanggal Kunjungan',
            'Nama Staff',
            'Kode Toko',
            'Nama Toko',
            'Alamat Toko',
            'Waktu Mulai',
            'Waktu Selesai',
            'Latitude',
            'Longitude',
            'Banner',
            'Aktifitas',
            'Catatan Kunjungan',
            'Display Produk',
            'Kategori Produk',
            'Stok Di Toko(Brand)',
            'Alasan Tidak Display',
        ];
    }
}
