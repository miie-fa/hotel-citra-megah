@extends('admin.layout.app')

@section('title', 'Rooms')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4 col-12 col-xl-8 mb-xl-2">
                    <h3 class="font-weight-bold">Product</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 toolbar">
                            <a href="{{ route('room.create') }}">
                                <button class="btn btn-info btn-md">+ Add New</button>
                            </a>
                        </div>
                        <div class="material-datatables">
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
                            <table id="datatables" class="display expandable-table" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Harga (per malam)</th>
                                        <th class="text-right disabled-sorting">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img class="img-fluid image-thumbnail" src="{{ asset('uploads/'.$item->featured_photo) }}" alt="">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td class="font-weight-bold">{{ 'Rp ' . number_format($item->price, 2, ',', '.') }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-md text-light btn-warning" data-bs-toggle="modal" data-bs-target="#roomModal{{ $item->id }}">Detail</button>
                                                <a href="{{ route('room.gallery', $item->id) }}" class="btn btn-md text-light btn-success">Gallery</a>
                                                <a href="{{ route('room.edit', $item->id) }}" class="btn btn-md text-light btn-info">Edit</a>
                                                <form action="{{ route('room.destroy', $item->id) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="demo.showSwal('warning-message-and-confirmation')" class="btn btn-md btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="roomModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Room Detail</h3>
                                                        <div class="modal-header">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group border-bottom row pt-10 mb-1">
                                                            <div class="col-md-4"><label class="form-label">Photo</label></div>
                                                            <div class="col-md-8 align-center">
                                                                <img src="{{ asset('uploads/'.$item->featured_photo) }}" alt="" class="img-thumbnail">
                                                            </div>
                                                        </div>
                                                        <div class="form-group border-bottom row pt-10 mb-1">
                                                        <div class="pt-10 mb-1 form-group border-bottom row">
                                                            <div class="col-md-4"><label class="form-label">Photo</label></div>
                                                            <div class="col-md-8">
                                                                <img class="img-thumbnail" src="{{ asset('uploads/'.$item->featured_photo) }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="pt-10 mb-1 form-group border-bottom row">
                                                            <div class="col-md-4"><label class="form-label">Name</label></div>
                                                            <div class="col-md-8"><label class="form-label">{{ $item->name }}</label></div>
                                                        </div>
                                                        <div class="form-group border-bottom row pt-10 mb-1">
                                                        <div class="pt-10 mb-1 form-group border-bottom row">
                                                            <div class="col-md-4"><label class="form-label">Description</label></div>
                                                            <div class="col-md-8"><label class="form-label">{!! $item->description !!}</label></div>
                                                        </div>
                                                        <div class="form-group border-bottom row pt-10 mb-1">
                                                        <div class="pt-10 mb-1 form-group border-bottom row">
                                                            <div class="col-md-4"><label class="form-label">Price (per night)</label></div>
                                                            <div class="col-md-8"><label class="form-label">{{ 'Rp ' . number_format($item->price, 2, ',', '.') }}</label></div>
                                                        </div>
                                                        <div class="form-group border-bottom row pt-10 mb-1">
                                                            <div class="col-md-8"><label class="form-label">{{ $item->total_rooms }}</label></div>
                                                        <div class="form-group border-bottom row pt-10 mb-1">
                                                            <div class="col-md-8"><label class="form-label">{{ $item->total_beds }}</label></div>
                                                        <div class="form-group border-bottom row pt-10 mb-1">
                                                        <div class="pt-10 mb-1 form-group border-bottom row">
                                                            <div class="col-md-4"><label class="form-label">Total Bathrooms</label></div>
                                                            <div class="col-md-8"><label class="form-label">{{ $item->total_bathrooms }}</label></div>
                                                        </div>
                                                        <div class="form-group border-bottom row pt-10 mb-1">
                                                        <div class="pt-10 mb-1 form-group border-bottom row">
                                                            <div class="col-md-4"><label class="form-label">Total Guests</label></div>
                                                            <div class="col-md-8"><label class="form-label">{{ $item->total_guests }}</label></div>
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
@endsection

@push('js-custom')

@endpush
