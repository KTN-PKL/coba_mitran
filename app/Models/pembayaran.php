<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pembayaran extends Model
{
    use HasFactory;

    public function addData($data)
    {
        DB::table('pembayarans')->insert($data);
    }
    public function Data($id)
    {
        return DB::table('pembayarans')->where('id_pembayaran', $id)->first();
    }
    public function id()
    {
        return DB::table('pembayarans')->count();
    }
    public function editData($id, $data)
    {
        DB::table('pembayarans')->where('id_pembayaran', $id)->update($data);
    }
}
