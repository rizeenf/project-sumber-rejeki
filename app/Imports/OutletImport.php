<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Branch;
use App\Models\User;
use App\Models\Owner;

use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class OutletImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row ) 
        {   
            // return dd($row);
            if(empty($row['Kode Toko'])){
                $branch = Branch::where('code', $row['Kode Cabang'])->first();
                $user = User::where('username', $row['Username'])->first();
                // $codeBranch = Branch::where('code', $row['Kode Cabang'])->first()->code;
                $codeBranch = $row['Kode Cabang'];
                $lastCodeCustomer = Customer::orderBy('code', 'desc')->where('code', 'LIKE', '%'.$codeBranch.'%')->first();

                if(empty($lastCodeCustomer)){
                    $row['Kode Toko'] = $codeBranch.'001';
                }else{
                    $lastDigit = intval(substr($lastCodeCustomer->code,3));
                    if($lastDigit < 10){
                        if($lastDigit == 0){
                            $generator = '001';    
                        }else{
                            $generator = '00'.$lastDigit+1;
                        }
                    }elseif($lastDigit >= 10 && $lastDigit <100){
                        $generator = '0'.$lastDigit+1;
                    }else{
                        $generator = $lastDigit+1;
                    }
                    $row['Kode Toko'] = $codeBranch.$generator;
                }

                Customer::create([
                    'code' => str_replace('/',' - ',$row['Kode Toko']),
                    'name' => str_replace('/',' - ',$row['Nama Toko']),
                    'phone' => $row['No Telepon Toko'],
                    'address' => $row['Alamat Toko'],
                    'LA' => $row['Latitude'],
                    'LO' => $row['Longitude'],
                    'area' => $row['Area'],
                    'subarea' => $row['Sub Area'],
                    'status_registration' => empty($row['Registrasi']) ? 'N' : $row['Registrasi'],
                    'type' => 'O',
                    'banner' => empty($row['Spanduk']) ? 0 : $row['Spanduk'],
                    'branch_id' => empty($branch) ? NULL : $branch->id,
                    'user_id' => empty($user) ? NULL : $user->id,
                    'status' => empty($row['Status']) ? 1 : $row['Status'],
                    'created_by' => Auth::user()->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }else{
                $customer = Customer::where('code', $row['Kode Toko'])->first();
                $branch = Branch::where('code', $row['Kode Cabang'])->first();
                $user = User::where('username', $row['Username'])->first();

                if($customer){
                    $customer->update([
                        'name' => str_replace('/',' - ',$row['Nama Toko']),
                        'phone' => $row['No Telepon Toko'],
                        'address' => $row['Alamat Toko'],
                        'LA' => $row['Latitude'],
                        'LO' => $row['Longitude'],
                        'area' => $row['Area'],
                        'subarea' => $row['Sub Area'],
                        'status_registration' => empty($row['Registrasi']) ? 'N' : $row['Registrasi'],
                        'type' => 'O',
                        'banner' => empty($row['Spanduk']) ? 0 : $row['Spanduk'],
                        'branch_id' => empty($branch) ? NULL : $branch->id,
                        'user_id' => empty($user) ? NULL : $user->id,
                        'status' => empty($row['Status']) ? 1 : $row['Status'],
                        'updated_by' => Auth::user()->id,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }else{
                    Customer::create([
                        'code' => str_replace('/',' - ',$row['Kode Toko']),
                        'name' => str_replace('/',' - ',$row['Nama Toko']),
                        'phone' => $row['No Telepon Toko'],
                        'address' => $row['Alamat Toko'],
                        'LA' => $row['Latitude'],
                        'LO' => $row['Longitude'],
                        'area' => $row['Area'],
                        'subarea' => $row['Sub Area'],
                        'status_registration' => empty($row['Registrasi']) ? 'N' : $row['Registrasi'],
                        'type' => 'O',
                        'banner' => empty($row['Spanduk']) ? 0 : $row['Spanduk'],
                        'branch_id' => empty($branch) ? NULL : $branch->id,
                        'user_id' => empty($user) ? NULL : $user->id,
                        'status' => empty($row['Status']) ? 1 : $row['Status'],
                        'created_by' => Auth::user()->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}
