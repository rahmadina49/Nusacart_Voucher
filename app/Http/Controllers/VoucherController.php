<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        // Data dummy voucher untuk keperluan pengujian dan screenshot tugas
        $vouchers = [
            (object)['id' => 1, 'code' => 'DISC50', 'discount' => '50%'],
            (object)['id' => 2, 'code' => 'FREESHIP', 'discount' => 'Gratis Ongkir'],
        ];

        return view('vouchers.index', compact('vouchers'));
    }
}