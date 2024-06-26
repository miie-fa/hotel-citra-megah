@extends('admin.layout.app')

@section('title', 'Rooms')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4 col-12 col-xl-8 mb-xl-2">
                    <h3 class="font-weight-bold">Room Gallery of {{ $room_data->name }}</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 toolbar">
                            <form action="{{ route('room.gallery.store', $room_data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="mb-5 form-group">
                                    <label>Photo *</label>
                                    <input class="form-control @error('photo') is-invalid @enderror" type="file"  name="photo"/>
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-4 card">
                    <div class="card-body">
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
                                        <th class="text-right disabled-sorting">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($room_photos as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img width="200" class="img-fluid image-photo" src="{{ asset('uploads/'.$item->photo) }}" alt="">
                                            </td>
                                            <td class="text-right">
                                                <form action="{{ route('room.gallery.delete', $item->id) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="demo.showSwal('warning-message-and-confirmation')" class="btn btn-md btn-danger">Hapus</button>
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
@endsection

@push('js-custom')

@endpush
