<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
use App\Models\pembayaran;
use App\Models\pesan_masif;


 
class CreateSnapTokenService extends Midtrans
{
 
    public function __construct()
    {
        $this->pesan_masif = new pesan_masif();
        $this->pembayaran = new pembayaran();
    }
 
    public function getSnapToken($id_masif, $id_pembayaran)
    {
        $masif = $this->pesan_masif->detailData($id_masif);
        $total = $masif->qty * $masif->harga;
        $params = [
            'transaction_details' => [
                'order_id' => $id_pembayaran,
                'gross_amount' => $total,
            ],
            'item_details' => [
                [
                    'id_paket' => $masif->id_paket,
                    'price' => $masif->harga,
                    'quantity' => $masif->qty,
                    'name' => $masif->paket,
                ]
            ],
            'customer_details' => [
                'first_name' => $masif->name,
                'email' => $masif->email,
                'phone' => $masif->kontak,
            ]
        ];
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}