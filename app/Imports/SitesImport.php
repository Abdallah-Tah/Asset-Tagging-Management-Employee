<?php

namespace App\Imports;

use App\Models\AmazonSite;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class SitesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AmazonSite([
            'region' => $row[0],
            'location' => $row[1],
            'address' => $row[2],
            'city' => $row[3],
            'state' => $row[4],
            'zip' => $row[5],
            'square_feet' => $row[6],
            'labor_budget' => $row[7],
            'labor_hours' => $row[8],
            'user_id' => Auth::id(),
        ]);
    }
}
