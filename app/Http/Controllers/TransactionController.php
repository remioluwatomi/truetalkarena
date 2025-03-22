<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Contestant;
use App\Models\Course;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBook;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $postArray = $request->all();
        // dd($postArray);
        $cart = new CartController();
        $cart = $postArray['cartItems'];
        $orderCode = $postArray['tx_ref'];
        // $user=Session::get('user');
        foreach ($cart as $key => $item) {
            Order::create([
                'user_id' => $user_id,
                'book_id' => $item['id'],
                'amount' => $item['price'],
                'orderCode' => "$orderCode",
            ]);
        }
        $transaction = Transaction::create([
            'amount' => $postArray['amount'],
            'user_id' => $user_id,
            'orderCode' => "$orderCode",
            'tran_status' => 'pending'
        ]);
        if (!$transaction) {
            $responses = array(
                'message' => 'An error occurred',
                'type' => 'red',
                'icon' => 'fa-bell',
                'title' => 'Sorry!'
            );
        } else {
            $responses = array(
                'message' => 'Transaction Completed',
                'type' => 'green',
                'icon' => 'fa-check-circle',
                'title' => 'Thank you'
            );
        }
        return json_encode($responses);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($orderCode)
    {
        $order = Transaction::where('orderCode', '=', $orderCode)->first();
        return $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderCode)
    {
        $payment = $request->all();
        if ($payment['status'] === 'successful') {
            $count = Transaction::where('orderCode', '=', $orderCode)->count();
            if ($count > 0) {
                $tran = Transaction::where('orderCode', '=', $orderCode)->first();
                $orders = Order::where('orderCode', '=', $tran['orderCode'])->get();
                foreach ($orders as $key => $order) {
                    //course_id
                    $UserBook = UserBook::where('book_id', '=', $order['book_id'])->count();
                    if ($UserBook === 0) {
                        UserBook::create([
                            'user_id' => $order['user_id'],
                            'book_id' => $order['book_id']
                        ]);
                    }
                }
                $orderUpdate = Order::where('orderCode', '=', $tran['orderCode'])->update([
                    'order_status' => $payment['status']
                ]);
                $tranUpdate = Transaction::where('orderCode', '=', $orderCode)->update([
                    'tran_status' => $payment['status'],
                    'transaction_id' => $payment['transaction_id']
                ]);

                if (!$tranUpdate) {
                    $responses = array(
                        'message' => 'An error occurred',
                        'type' => 'red',
                        'icon' => 'fa-bell',
                        'title' => 'Sorry!'
                    );
                } else {
                    $responses = array(
                        'message' => 'Transaction Completed',
                        'type' => 'green',
                        'icon' => 'fa-check-circle',
                        'title' => 'Thank you'
                    );
                }
            } else {
                $responses = array(
                    'message' => 'Transaction does not exist.',
                    'type' => 'orange',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry!'
                );
            }
        } else {
            $tranUpdate = Transaction::where('orderCode', '=', $orderCode)->update([
                'tran_status' => $payment['status'],
                'transaction_id' => $payment['transaction_id']
            ]);
            if (!$tranUpdate) {
                $responses = array(
                    'message' => 'An error occurred',
                    'type' => 'red',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry!'
                );
            } else {
                $responses = array(
                    'message' => 'Transaction Completed',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            }
            $responses = array(
                'message' => 'Transaction was ' . $payment['status'],
                'type' => 'orange',
                'icon' => 'fa-bell',
                'title' => 'Sorry!'
            );
        }

        return json_encode($responses);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
