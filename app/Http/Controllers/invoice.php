<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pembayaran;
use App\Models\pesan_masif;
use App\Services\Midtrans\CreateSnapTokenService;
use Midtrans\Config;
use Midtrans\Snap;

class invoice extends Controller
{
    protected $serverKey;
	protected $isProduction;
	protected $isSanitized;
	protected $is3ds;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
		$this->isProduction = config('midtrans.is_production');
		$this->isSanitized = config('midtrans.is_sanitized');
		$this->is3ds = config('midtrans.is_3ds');

		$this->_configureMidtrans();
        $this->pesan_masif = new pesan_masif();
        $this->pembayaran = new pembayaran();
    }

    public function _configureMidtrans()
	{
		Config::$serverKey = $this->serverKey;
		Config::$isProduction = $this->isProduction;
		Config::$isSanitized = $this->isSanitized;
		Config::$is3ds = $this->is3ds;
	}
    public function getSnapToken($order, $id)
	{
		$masif = $this->pesan_masif->detailData($order);
        $total = $masif->qty * $masif->harga;
		$params = [
			/**
			 * 'order_id' => id order unik yang akan digunakan sebagai "primary key" oleh Midtrans untuk
			 * 				 membedakan order satu dengan order lain. Key ini harus unik (tidak boleh ada duplikat).
			 * 'gross_amount' => merupakan total harga yang harus dibayar customer.
			 */
			'transaction_details' => [
				'order_id' => $id,
				'gross_amount' => $total,
			],
			/**
			 * 'item_details' bisa diisi dengan detail item dalam order.
			 * Umumnya, data ini diambil dari tabel `order_items`.
			 */
			// 'item_details' => [
			// 	[
			// 		'id' => 1, // primary key produk
			// 		'price' => '150000', // harga satuan produk
			// 		'quantity' => 1, // kuantitas pembelian
			// 		'name' => 'Flashdisk Toshiba 32GB', // nama produk
			// 	],
			// 	[
			// 		'id' => 2,
			// 		'price' => '60000',
			// 		'quantity' => 2,
			// 		'name' => 'Memory Card VGEN 4GB',
			// 	],
			// ],
			'customer_details' => [
				// Key `customer_details` dapat diisi dengan data customer yang melakukan order.
				'first_name' => $masif->name,
				'email' => $masif->email,
				'phone' => $masif->kontak,
			]
		];
		
		$snapToken = Snap::getSnapToken($params);
		return $snapToken;
	}
    public function store($id_masif)
    {
        $id = $this->pembayaran->id();
        $id_pembayaran = $id + 1;
        $masif = $this->pesan_masif->detailData($id_masif);
        $total = $masif->qty * $masif->harga;
        $midtrans = $this->getSnapToken($id_masif, $id_pembayaran);
        $data = [
            'id_pembayaran' => $id_pembayaran,
            'id_pengguna' => $masif->id_pengguna,
            'id_paket' => $masif->id_paket,
            'email' => $masif->email,
            'qty' => $masif->qty,
            'total_harga' => $total,
            'status' => "tertunda",
            'snap_token' => $midtrans,
        ];
        $this->pembayaran->addData($data);
        return view('invoice.show', $data);
    }
    public function callback(Request $request)
    {
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$this->serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == "capture") {
                $data = ['status' => "lunas"];
                $this->pembayaran->editData($request->order_id, $data);
            }
        }
    }
}
