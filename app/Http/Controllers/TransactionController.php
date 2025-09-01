<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
 public function cart(Request $request)
    {
        $store = User::where('username', $request->username)->first();

        if (!$store) {
            abort(404);
        }

        // Fetch products associated with the store
        $products = $store->products; // Assuming User model has a 'products' relationship

        return view('pages.cart', compact('store', 'products'));
    }
    public function customerInformation(Request $request)
    {
        $store = User::where('username', $request->username)->first();

        if (!$store){
            abort(404);
        }

        return view('pages.customer-information', compact('store'));
    }

    public function checkout(Request $request)
{
    $store = User::where('username', $request->username)->first();

    if (!$store) {
        abort(404);
    }

    $carts = json_decode($request->cart, true);

    // 1. Validasi jika cart kosong atau tidak valid
    if (empty($carts)) {
        Log::error('Checkout attempt with empty or invalid cart data.', ['request' => $request->all()]);
        return redirect()->back()->withErrors('Keranjang Anda kosong atau tidak valid.');
    }

    // 2. Optimasi Query: Ambil semua produk sekaligus
    $productIds = array_column($carts, 'id');
    $products = Product::whereIn('id', $productIds)->get()->keyBy('id'); // keyBy('id') untuk pencarian mudah

    $totalPrice = 0;
    foreach ($carts as $cart) {
        // 3. Cek jika produk ada di database
        if (!isset($products[$cart['id']])) {
            // Bisa redirect dengan pesan error atau skip produk ini
            continue; 
        }
        $product = $products[$cart['id']];
        $totalPrice += $product->price * $cart['qty'];
    }

    // 4. Buat ID transaksi yang lebih unik
    $transactionCode = 'TRX-' . strtoupper(Str::random(10));

    $transaction = $store->transactions()->create([
        'code' => $transactionCode,
        'name' => $request->name,
        'phone_number' => $request->phone_number,
        'table_number' => $request->table_number,
        'payment_method' => $request->payment_method,
        'total_price' => $totalPrice,
        'status' => 'pending',
    ]);

    foreach ($carts as $cart) {
        if (!isset($products[$cart['id']])) {
            continue;
        }
        $product = $products[$cart['id']];
        $transaction->transactionDetails()->create([
            'product_id' => $product->id,
            'quantity' => $cart['qty'],
            'note' => $cart['note'] ?? '',
        ]);
    }

    if ($request->payment_method == 'cash') {

    return redirect()->route('success', [
        'username' => $store->username,
        'order_id' => $transaction->code,
    ]);
    } else {
        \Midtrans\Config::$serverKey = config('midtrans.serverkey');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->code,
                'gross_amount' => $transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'phone' => $request->phone_number,
            ],
        ];

        try {
            // === PERUBAHAN UTAMA DI SINI ===
            // Ganti createTransaction()->redirect_url menjadi getSnapToken()
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Simpan snap token ke database jika perlu (opsional, tapi bagus untuk re-payment)
            $transaction->payment_token = $snapToken;
            $transaction->save();
            
            // Kembalikan Snap Token sebagai response JSON
            return response()->json([
                'snap_token' => $snapToken,
                'redirect_url_success' => route('success', ['username' => $store->username, 'order_id' => $transaction->code])
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans Snap Error: ' . $e->getMessage());
            // Kembalikan response error dalam format JSON
            return response()->json(['error' => 'Gagal memproses pembayaran. Silakan coba lagi.'], 500);
        }
    }
}

    public function success(Request $request)
    {
        $transaction = Transaction::where('code', $request->order_id)->first();
        $store = User::where('username', $request->username)->first();

        if (!$store){
            abort(404);
        }

        return view('pages.success', compact('store', 'transaction'));
    }


    
}
