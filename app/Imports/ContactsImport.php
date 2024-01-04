<?php

namespace App\Imports;

use App\Models\contacts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ContactsImport implements ToModel, WithUpserts, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function uniqueBy()
    {
        return 'phone';
    }


    // Define the starting row (second row)
    public function startRow(): int
    {
        return 2;
    }


    public function model(array $row)
    {

        // $validator = Validator::make($row, [
        //     2 => ['regex:/^(09|07)[5|6|7][0-9]{7}$/'],
        // ]);
        
        // if ($validator->fails()) {
        //     throw ValidationException::withMessages([
        //         'phone' => 'Please enter valid phone number(s).',
        //     ]);
        // }

        return new contacts([
            'first_name' => $row[0],
            'last_name' => $row[1],
            'user_id' => auth()->user()->id,
            'phone' => $row[2],
            'email' => $row[3],
            'address' => $row[4],
            'company' => $row[5],
            'nationality' => $row[6],
            'tag' => $row[7],
        ]);
    }
}