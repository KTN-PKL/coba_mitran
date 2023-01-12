<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Midtrans\CallbackService;

class PaymentCallbackController extends Controller
{
    public function __construct()
    {
        $this->pembayaran = new pembayaran();
    }
    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();

            if ($callback->isSuccess()) {
                $data = ['status' => "lunas"];
                $this->pembayaran->editData($order->id, $data);
            }

            if ($callback->isExpire()) {
                $data = ['status' => "kadaluarsa"];
                $this->pembayaran->editData($order->id, $data);
            }

            if ($callback->isCancelled()) {
                $data = ['status' => "batal"];
                $this->pembayaran->editData($order->id, $data);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}
