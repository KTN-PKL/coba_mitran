<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class paket extends Model
{
    use HasFactory;

    public function wisataData($id_wisata)
    {
        return DB::table('paket')->where('id_wisata', $id_wisata)->get();
    }

    public function addData($data)
    {
        DB::table('paket')->insert($data);
    }
    public function deleteData($id_paket)
    {
        DB::table('paket')->where('id_paket', $id_paket)->delete();
    }
    public function deleteData2($id_paket)
    {
        DB::table('paket')->where('id_paket', $id_paket)->delete();
    }
    public function editData($id_paket, $data)
    {
        DB::table('paket')->where('id_paket', $id_paket)->update($data);
    }
}
