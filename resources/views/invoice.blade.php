<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>INVOICE</title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <span style="font-size: 30px; text-transform: uppercase">{{ $hotel->name }} </span><br>
                                <span style="font-size: 10px; margin-top: -10px">{{ $hotel->address }}</span>
                            </td>

                            <td>
                                Invoice #: {{ $record->order_no }}<br>
                                Created: {{ \Carbon\Carbon::parse($record->created_at)->format('F j, Y') }}<br>
                                {{-- Due: {{ \Carbon\Carbon::parse($record->created_at)->format('F j, Y') }} --}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{ $user->phone }}<br>
                                {{ $user->address }}<br>
                                {{ $user->country }}
                            </td>

                            <td>
                                {{ $user->name }}<br>
                                {{ $user->phone }}<br>
                                {{ $user->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Payment Method
                </td>

                <td>
                    Status
                </td>
            </tr>

            <tr class="details">
                <td>
                    {{ $record->payment_method }}
                </td>

                <td>
                    {{ $record->status }}
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Item
                </td>

                <td>
                    Price
                </td>
            </tr>

            @foreach ($details as $item)
            <tr class="item">
                <td>
                    {{$item->room_name}}
                </td>

                <td>
                    Rp {{ number_format($item->subtotal, 0, '.', '.') }}
                </td>
            </tr>
            @endforeach

            <tr class="total">
                <td></td>

                <td>
                   Total: Rp {{ number_format($record->paid_amount, 0, '.', '.') }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
