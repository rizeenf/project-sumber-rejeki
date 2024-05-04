<?php

namespace App\Exports;

use App\Models\HeaderVisit;
use App\Models\DetailOutletVisit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportVisitOutlet implements FromCollection ,WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HeaderVisit::whereHas('customer', function($query){
            $query->where('type', 'O');
        })->get();
    }

    public function map($headervisit): array
    {
        if($headervisit->status_registration == 'Y'){
            $stat = 'SMClub';
        }elseif($headervisit->status_registration == 'M'){
            $stat = "Mixing";
        }else{
            $stat = 'Non-SMClub';
        }

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
                $stat,
                $headervisit->activity,
                $headervisit->note,
                implode(",", collect($headervisit->detail_outlet)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->sales_amount;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->detail_outlet)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        empty($i->customer->code) ? '' : $i->customer->code.' - '.$i->customer->name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->detail_outlet)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->store_name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->detail_outlet)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->market_name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->detail_outlet)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->mark;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->used_product)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->product->name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->used_product)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->purchase_price;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->outlet_reason)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->unproductive_reason->name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->gift)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->product->name;
                        return array_unique($acc);
                    }, 
                [])),
                implode(",", collect($headervisit->gift)
                    ->reduce(function($acc, $i) {$acc[] = 
                        // $i->{'Nama Kolom'};
                        $i->qty;
                        return $acc;
                    }, 
                [])),
            ],
        ];
    }

    public function headings(): array{
        return [
            'Tanggal Kunjungan',
            'Nama Staff',
            'Kode Gerai',
            'Nama Gerai',
            'Alamat Alamat',
            'Waktu Mulai',
            'Waktu Selesai',
            'Latitude',
            'Longitude',
            'Banner',
            'Tipe Gerai',
            'Aktifitas',
            'Catatan Kunjungan',
            'Qty Penjualan Perhari',
            'Toko Beli(Sudah Register)',
            'Nama Toko Beli(Belum Register)',
            'Pasar Lokasi Toko Beli',
            'Patokan Lokasi',
            'Produk yang Dipakai',
            'Harga Beli Ditoko',
            'Alasan Belum Pakai Produk',
            'Sampel yang Diberikan',
            'Qty Sampel'
        ];
    }
}
