<?php

namespace App\Imports;

use App\Models\distributor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DistributorImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * 
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new distributor([
            'nama_distributor' => $row['nama_distributor'],
            'lokasi' => $row['lokasi'],
            'kontak' => $row['kontak'],
            'email' => $row['email'],
        ]);
    }
}