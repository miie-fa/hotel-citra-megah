@extends('admin.layout.app')

@section('title', 'Posts')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4 col-12 col-xl-8 mb-xl-2">
                <h3 class="font-weight-bold">Posts</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 toolbar">
                        <a href="{{ route('post.create') }}">
                            <button class="btn btn-info btn-md">+ Add New</button>
                        </a>
                    </div>
                    <div class="">
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
                        <table id="datatables" class="display expandable-table" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Title</th>
                                    <th class="text-right disabled-sorting">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img width="290" class="img-thumbnail" src="{{ asset('uploads/'.$item->thumbnail) }}" alt="">
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td class="text-right">
                                            <button class="btn btn-sm btn-fw btn-warning" data-bs-toggle="modal" data-bs-target="#roomModal{{ $item->id }}">Detail</button>
                                            <a href="{{ route('post.edit', $item->id) }}" class="btn btn-sm text-light btn-info">Edit</a>
                                            <form action="{{ route('post.destroy', $item->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="confirmDelete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
                                                <script>
                                                    function confirmDelete(id) {
                                                        Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: "You won't be able to revert this!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#d33',
                                                            cancelButtonColor: '#3085d6',
                                                            confirmButtonText: 'Yes, delete it!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location.href = "{{ route('post.destroy', $item->id) }}".replace(':id', id);
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="roomModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Post Detail</h3>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group border-bottom row bdb1 pt_10 mb_0">
                                                        <div class="col-md-4"><label class="form-label">Photo</label></div>
                                                        <div class="col-md-8">
                                                            <img src="{{ asset('uploads/'.$item->thumbnail) }}" alt="" class="w_200 img-thumbnail">
                                                        </div>
                                                    </div>
                                                    <div class="form-group border-bottom row bdb1 pt_10 mb_0">
                                                        <div class="col-md-4"><label class="form-label">Title</label></div>
                                                        <div class="col-md-8">{{ $item->title }}</div>
                                                    </div>
                                                    <div class="form-group border-bottom row bdb1 pt_10 mb_0">
                                                        <div class="col-md-12 img-thumbnail">{!! $item->content !!}</div>
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
@endsection

@push('js-custom')

@endpush
