<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('customer')->orderBy('id', 'DESC')->get();
        // dd($invoices);
        return response([
            'invoices' => $invoices,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_invoice()
    {
        $invoice = Invoice::orderBy('id', 'DESC')->first();
        if ($invoice) {
            $invoice = $invoice->id + 1;
        }
        $formData = [
            'customer_id' => null,
            'date' => date('y-m-d'),
            'items' => [
                [
                    'category_id' => null,
                    'unit_price' => 0,
                    'quantity' => 1,
                ],
            ],
        ];
        return response()->json($formData);
    }
    public function store(Request $request)
    {
        $invoiceitem = $request->input('invoice_item');
        $invoicedata['customer_id'] = $request->input("customer_id");
        $invoicedata['date'] = $request->input("date");
        $invoicedata['total'] = $request->input("total");

        $invoice = Invoice::create($invoicedata);
        foreach (json_decode($invoiceitem) as $item) {
            $itemdata['category_id'] = $item->id;
            $itemdata['invoice_id'] = $invoice->id;
            $itemdata['quantity'] = $item->quantity;
            $itemdata['unit_price'] = $item->unit_price;
            InvoiceItem::create($itemdata);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}