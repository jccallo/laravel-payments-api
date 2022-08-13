<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'res' => true,
            'clients' => Client::all(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create($request->all());

        $payments = $request->paymentsList;
        foreach($payments as $payment) {
            Payment::create([
                'transactionid' => $payment['transactionid'],
                'amount' => $payment['amount'],
                'date' => $payment['date'],
                'client_id' => $client->id
            ]);
        }

        return response()->json([
            'res' => true,
            'client' => $client,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return response()->json([
            'res' => true,
            'client' => $client,
            'payments' => $client->payments_list,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        $payments = $request->paymentsList;
        foreach($payments as $payment) {
            Payment::upsert([
                ['transactionid' => $payment['transactionid'], 'amount' => $payment['amount'], 'date' => $payment['date'], 'client_id' => $client->id]
            ],
            ['transactionid'],
            ['amount', 'date']);
        }

        return response()->json([
            'res' => true,
            'client' => $client,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json([
            'res' => true,
            'client' => $client,
        ], 200);
    }
}
