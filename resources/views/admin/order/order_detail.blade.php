@extends('admin.layout.app')

@section('title', 'Edit Hotel')

@push('css-custom')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
@endpush

@section('content')
    <div class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Order Invoice</h3>
                                    <a href="{{ route('hotel.index') }}">
                                        <button class="btn btn-info btn-sm">View All</button>
                                    </a>
                                </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-5 toolbar">
                                        <hr>
                                    </div>
                                    <div class="mt-7">
                                        <div class="d-flex justify-content-between">
                                            <h2>Invoice</h2>
                                            <h4>Order #{{ $order->order_no }}</h4>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-between">
                                            <div class="d-flex flex-column">
                                                <p style="font-weight: 600; color:rgb(38, 37, 49)">Invoice To</p>
                                                <span>{{ $user_data->name }}</span>
                                                <span>{{ $user_data->phone }}</span>
                                                <span>{{ $user_data->address }}, {{ $user_data->country }}</span>
                                            </div>
                                            <div class="text-right d-flex flex-column">
                                                <p style="font-weight: 600; color:rgb(38, 37, 49)">Invoice Date</p>
                                                <span>{{ $order->booking_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 table-responsive">
                                        <table class="table table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Hotel Name</th>
                                                    <th>Room Name</th>
                                                    <th>Checkin Date</th>
                                                    <th>Checkout Date</th>
                                                    <th>Adult</th>
                                                    <th>Children</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order_detail as $key => $item)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $item->hotel_name }}</td>
                                                        <td>{{ $item->room_name }}</td>
                                                        <td>{{ $item->checkin_date }}</td>
                                                        <td>{{ $item->checkout_date }}</td>
                                                        <td>{{ $item->adult }}</td>
                                                        <td>{{ $item->children }}</td>
                                                        <td>{{ $item->subtotal }}0</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-5 toolbar">
                                        <hr>
                                    </div>
                                    <button type="button" class="btn btn-info btn-icon-text">
                                        Print
                                        <i class="ti-printer btn-icon-append"></i>
                                    </button>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
                }
            });

            var table = $('#datatable').DataTable();

            // Edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function() {
                alert('You clicked on Like button');
            });
        });
    </script>
    <script>
            function setFormValidation(id) {
                $(id).validate({
                    highlight: function (element) {
                        $(element)
                            .closest(".form-group")
                            .removeClass("has-success")
                            .addClass("has-danger");
                        $(element)
                            .closest(".form-check")
                            .removeClass("has-success")
                            .addClass("has-danger");
                    },
                    success: function (element) {
                        $(element)
                            .closest(".form-group")
                            .removeClass("has-danger")
                            .addClass("has-success");
                        $(element)
                            .closest(".form-check")
                            .removeClass("has-danger")
                            .addClass("has-success");
                    },
                    errorPlacement: function (error, element) {
                        $(element).closest(".form-group").append(error);
                    },
                });
            }

            $(document).ready(function () {
                setFormValidation("#RegisterValidation");
                setFormValidation("#TypeValidation");
                setFormValidation("#LoginValidation");
                setFormValidation("#RangeValidation");
            });
        </script>
@endpush
