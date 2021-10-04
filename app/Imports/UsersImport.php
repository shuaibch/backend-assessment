<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToCollection ;
use Maatwebsite\Excel\Concerns\WithUpserts;


class UsersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new User([
    //         // 'id'        =>$row[0],
    //         'name'     => $row[0],
    //         'email'    => $row[1],
    //         'password' => bcrypt($row[2]),
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            User::updateOrCreate(
                [
                    'id' => $row[0],
                    'name' => $row[1],
                    'email' => $row[2],
                    'password' => bcrypt($row[3]),
                ]
            );
        }
    }

    public function uniqueBy()
    {
        return 'email';
    }
}
