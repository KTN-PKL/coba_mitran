<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\pesan_masif;

class CreateSnapTokenService extends Midtrans
{
	public function __construct($order, $id)
	{
		$this->pesan_masif = new pesan_masif();
		parent::__construct();

		$this->order = $order;
		$this->id = $id;
	}

	public function getSnapToken()
	{
		$masif = $this->pesan_masif->detailData($this->order);
        $total = $masif->qty * $masif->harga;
		$params = [
			/**
			 * 'order_id' => id order unik yang akan digunakan sebagai "primary key" oleh Midtrans untuk
			 * 				 membedakan order satu dengan order lain. Key ini harus unik (tidak boleh ada duplikat).
			 * 'gross_amount' => merupakan total harga yang harus dibayar customer.
			 */
			'transaction_details' => [
				'order_id' => $this->id,
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
}
