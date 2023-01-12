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
        $this->token = new CreateSnapTokenService();
    }
    public function store($id_masif)
    {
        $id = $this->pembayaran->id();
        $id_pembayaran = $id + 1;
        $masif = $this->pesan_masif->detailData($id_masif);
        $total = $masif->qty * $masif->harga;
        $snapToken = $this->token->getSnapToken($id_masif, $id_pembayaran);
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
        return redirect()->route('masif');
    }
}
