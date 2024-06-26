@extends('user.layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="container">

  <div class="card">

    <div class="card-header bg-primary text-white">
      <h3>Invoice Pemesanan Hotel</h3>    
    </div>

    <div class="card-body">

      <div class="row mb-3">
        <div class="col-6">
         <h5>Informasi Pemesan :</h5>
         <p>Nama : Farras</p>
         <p>findtheadvanture@gmail.com</p>
        </div>
        
        <div class="col-6">
         <h5>Informasi Hotel:</h5>  
         <p>Hotel Hebat</p>
         <p>Jalan Pemesanan No. 10</p>
         <p>08123456789</p>
        </div>
      </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Tipe Kamar</th>
            <th>Tanggal Check-in</th>
            <th>Tanggal Check-out</th>
            <th>Jumlah Malam</th>
            <th>Harga/Malam</th>
            <th>Total</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Deluxe Room</td>
            <td>14 Maret 2023</td>
            <td>17 Maret 2023</td>
            <td>3</td>
            <td>Rp 500.000</td>
            <td>Rp 1.500.000</td>
          </tr>
        </tbody>

        <tfoot>
          <tr>
            <th colspan="5" class="text-right">Total Bayar:</th>
            <td>Rp 1.500.000</td>
          </tr>
        </tfoot>
      </table>

      <div class="text-right">
        <button class="btn btn-primary">Cetak Invoice</button>
      </div>

    </div>

  </div>
  
</div>

@endsection