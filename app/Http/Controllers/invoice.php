<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pembayaran;
use App\Models\pesan_masif;
use App\Services\Midtrans\CreateSnapTokenService;

class invoice extends Controller
{
    public function __construct()
    {
        $this->pesan_masif = new pesan_masif();
        $this->pembayaran = new pembayaran();
    }
    public function store($id_masif)
    {
        $id = $this->pembayaran->id();
        $id_pembayaran = $id + 1;
        $masif = $this->pesan_masif->detailData($id_masif);
        $total = $masif->qty * $masif->harga;
        $midtrans = new CreateSnapTokenService($id_masif, $id_pembayaran);
        $snapToken = $midtrans->getSnapToken();
        $data = [
            'id_pembayaran' => $id_pembayaran,
            'id_pengguna' => $masif->id_pengguna,
            'id_paket' => $masif->id_paket,
            'email' => $masif->email,
            'qty' => $masif->qty,
            'total_harga' => $total,
            'status' => "tertunda",
            'snap_token' => $snapToken,
        ];
        $this->pembayaran->addData($data);
        return view('orders.show', $data);
    }
}
