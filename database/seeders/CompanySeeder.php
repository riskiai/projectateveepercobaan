<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::insert([
            [
                'contact_type_id' => 1,
                'name' => 'PT ABC',
                'address' => 'Jl. Merdeka No. 1',
                'npwp' => '123456789012345',
                'pic_name' => 'John Doe',
                'phone' => '081234567890',
                'email' => 'john@abc.com',
                'file' => 'file1.pdf',
                'bank_name' => 'BCA',
                'branch' => 'Jakarta',
                'account_name' => 'PT ABC',
                'currency' => 'IDR',
                'account_number' => '1234567890',
                'swift_code' => 'CENAIDJA',
            ],
            // Tambahkan data lainnya (9 data lagi)
            [
                'contact_type_id' => 3,
                'name' => 'PT DEF',
                'address' => 'Jl. Kemenangan No. 2',
                'npwp' => '987654321098765',
                'pic_name' => 'Jane Doe',
                'phone' => '082345678901',
                'email' => 'jane@def.com',
                'file' => 'file2.pdf',
                'bank_name' => 'Mandiri',
                'branch' => 'Surabaya',
                'account_name' => 'PT DEF',
                'currency' => 'IDR',
                'account_number' => '9876543210',
                'swift_code' => 'BMRIIDJA',
            ],
            // Tambahkan data lainnya hingga 10 data.
        ]);
    }
}
