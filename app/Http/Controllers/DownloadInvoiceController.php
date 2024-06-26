<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
// use Barryvdh\DomPDF\PDF;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Http\Request;

class DownloadInvoiceController extends Controller
{
    public function download(Order $record)
    {
        $user = User::find($record->user_id);
        $orderDetails = OrderDetail::where('order_id', $record->id)->get();

        $client = new Party([
            'name'          => 'Roosevelt Lloyd',
            'phone'         => '(520) 318-9486',
            'custom_fields' => [
                'note'        => 'IDDQD',
                'business id' => '365#GG',
            ],
        ]);

        $customer = new Buyer([
            'name'          => $record->order_no,
            'custom_fields' => [
                'email' => $user->email,
            ],
        ]);

        $items = [];

        foreach ($orderDetails as $key => $value) {
            $item = (new InvoiceItem())
                ->title($value->room_name)
                ->description('Your product or service description')
                ->pricePerUnit($value->subtotal)
                ->quantity(1);

            $items[] = $item;
        }

         $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('receipt')
            ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('Rp')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('image/blog-1.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }

    public function getPDF(Order $record)
    {
        $hotel = Setting::first();
        $user = User::find($record->user_id);
        $details = OrderDetail::where('order_id', $record->id)->get();

        $pdf = PDF::loadView('invoice', compact('record', 'hotel', 'user', 'details'));

        return $pdf->stream('invoice.pdf');
    }
}
