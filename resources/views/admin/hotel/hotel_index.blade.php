@extends('admin.layout.app')

@section('title', 'Hotels')

@section('content')
    <div class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">View Hotels</h3>
                                </div>
                                </div>
                                <div class="card-body">
                                <div class="toolbar">
                                    <a href="{{ route('hotel.create') }}">
                                        <button class="btn btn-info btn-sm">+ Add New</button>
                                    </a>
                                </div>
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
                                    <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th class="text-right disabled-sorting">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hotels as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <img width="200" class="img-fluid image-thumbnail" src="{{ asset('uploads/'.$item->thumbnail) }}" alt="">
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="text-right">
                                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#hotelModal{{ $item->id }}">Detail</button>
                                                        <a href="{{ route('hotel.edit', $item->id) }}" class="btn btn-sm text-light btn-info">Edit</a>
                                                        <form action="{{ route('hotel.destroy', $item->id) }}" method="POST" style="display:inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="demo.showSwal('warning-message-and-confirmation')" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="hotelModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Hotel Detail</h3>
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group border-bottom row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4"><label class="form-label">Photo</label></div>
                                                                    <div class="col-md-8">
                                                                        <img src="{{ asset('uploads/'.$item->thumbnail) }}" alt="" class="w_200">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group border-bottom row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4"><label class="form-label">Name</label></div>
                                                                    <div class="col-md-8">{{ $item->name }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
@endsection

@push('js-custom')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
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
@endpush
