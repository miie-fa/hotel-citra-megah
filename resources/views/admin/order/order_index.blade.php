@extends('admin.layout.app')

@section('title', 'Orders')

@section('content')
    <div class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4 col-12 col-xl-8 mb-xl-2">
                            <h3 class="font-weight-bold">Customer Orders</h3>
                        </div>
                        <div class="card">
                                <div class="card-body">
                                    <div class="material-datatables">
                                        <div>
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="fa-solid fa-xmark fa-xl fs-xl"></i>
                                                    </button>
                                                    <span>{{ session('success') }}</span>
                                                </div>
                                            @endif
                                            @if (session('danger'))
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="fa-solid fa-xmark fa-xl fs-xl"></i>
                                                    </button>
                                                    <span>{{ session('danger') }}</span>
                                                </div>
                                            @endif
                                            @if (session('warning'))
                                                <div class="alert alert-warning">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="fa-solid fa-xmark fa-xl fs-xl"></i>
                                                    </button>
                                                    <span>{{ session('warning') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <table id="datatables" class="display expandable-table" cellspacing="0" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Order No</th>
                                                    <th>Payment Method</th>
                                                    <th>Booking Date</th>
                                                    <th>Paid Amount</th>
                                                    <th class="text-right disabled-sorting">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->order_no }}</td>
                                                        <td>{{ $item->payment_method }}</td>
                                                        <td>{{ $item->booking_date }}</td>
                                                        <td>Rp {{ number_format($item->paid_amount, 0, ',', '.') }}</td>
                                                        <td class="text-right">
                                                            <a href="{{ route('order.detail', $item->id) }}" class="btn btn-sm btn-warning">Detail</a>
                                                            <form action="{{ route('order.destroy', $item->id) }}" method="POST" style="display:inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="demo.showSwal('warning-message-and-confirmation')" class="btn btn-sm btn-danger">Hapus</button>
                                                            </form>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-custom')

@endpush
