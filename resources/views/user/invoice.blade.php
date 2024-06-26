@extends('user.layout.app')

@section('title', 'Invoices')

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Invoice Lists</h4>
        <p class="card-description">
          All your Invoices lists will be show here
        </p>
        <div class="row">
          <div class="col-12">
              <!-- Tambahkan dropdown untuk memilih mata uang -->
              <div style="text-align: right; margin-bottom: 10px;">
                  <select id="currency" style="padding: 5px; border: none; border-radius: 5px; background-color: #f8f9fa;">
                      <option value="IDR">IDR</option>
                      <option value="USD">USD</option>
                  </select>
              </div>
              <div class="table-responsive">
                  <table id="datatables" class="display table-hover table expandable-table w-100">
                      <thead>
                          <tr>
                              <th>Order ID</th>
                              <th>Room Name</th>
                              <th>Total</th>
                              <th>Payment Method</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($order_details as $item)
                              @php
                                  $order = $orders->firstWhere('id', $item->order_id);
                              @endphp
                              <tr>
                                  <td>{{ $item->order_id }}</td>
                                  <td>{{ $item->room_name }}</td>
                                  <td class="subtotal" data-idr="{{ $item->subtotal }}">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                  <td>{{ $order->payment_method }}</td>
                                  <td id="order-2">
                                      <a href=" {{route('order.invoice.download',$item->order_id)}} " target="_blank"><button type="button" class="btn btn-primary btn-rounded btn-fw btn-sm text-white">See Invoice</button></a>
                                      <a href=""><button type="button" class="btn btn-warning btn-rounded btn-fw btn-sm text-white">Print</button></a>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
  </div>
@endsection
    
@push('js-custom')
<script>
     // Ganti nilai tukar ini dengan nilai tukar terkini
     var exchangeRate = 0.000064;

document.getElementById('currency').addEventListener('change', function() {
    var currency = this.value;
    var subtotals = document.getElementsByClassName('subtotal');

    for (var i = 0; i < subtotals.length; i++) {
        var subtotalInIDR = subtotals[i].getAttribute('data-idr');

        if (currency === 'USD') {
            var subtotalInUSD = subtotalInIDR * exchangeRate;
            subtotals[i].textContent = '$' + subtotalInUSD.toFixed(2);
        } else {
            subtotals[i].textContent = 'Rp' + new Intl.NumberFormat('id-ID').format(subtotalInIDR);
        }
    }
});

</script>
@endpush

