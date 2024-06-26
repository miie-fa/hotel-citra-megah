@extends('admin.layout.app')

@section('title', 'Edit Room')

@push('css-custom')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
@endpush

@section('content')
    <div class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4 mb-xl-2 d-flex justify-content-between align-items-center">
                            <h3 class="font-weight-bold">Edit Room</h3>
                            <a href="{{ route('room.index') }}">
                                <button class="btn btn-info btn-sm">View All</button>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('room.update', $room_data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-sm-12">
                                        <div class="mb-3 fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <img width="500" class="img-thumbnail" src="{{ asset('uploads/'. $room_data->featured_photo) }}" alt="...">
                                            </div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label>Change Photo</label>
                                            <input class="form-control" type="file"  name="featured_photo"/>
                                            @error('featured_photo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Name</label>
                                            <input class="form-control" type="text" name="name" value="{{ $room_data->name }}" required="true" />
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Description</label>
                                            <textarea name="description">{{ $room_data->description }}</textarea>
                                            <script>
                                                    CKEDITOR.replace( 'description' );
                                            </script>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Price</label>
                                            <input class="form-control" type="number" min="0" name="price" value="{{ $room_data->price }}" required="true" />
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Total Rooms</label>
                                            <input class="form-control" type="number" min="0" name="total_rooms" value="{{ $room_data->total_rooms }}" required="true" />
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label">Amenities</label>
                                            @php $i=0; @endphp
                                            @foreach($all_amenities as $item)

                                            @if(in_array($item->id,$existing_amenities))
                                            @php $checked_type = 'checked'; @endphp
                                            @else
                                            @php $checked_type = ''; @endphp
                                            @endif

                                            @php $i++; @endphp
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="{{ $item->id }}" id="defaultCheck{{ $i }}" name="arr_amenities[]" {{ $checked_type }}>
                                                <label class="custom-control-label text-secondary" for="defaultCheck{{ $i }}">{{ $item->name }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Size</label>
                                            <input class="form-control form-control-sm @error('size') is-invalid @enderror" type="number" min="0" name="size" value="{{ $room_data->size }}" />
                                            @error('size')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Bed Type</label>
                                            <input class="form-control" type="text" min="0" name="bed_type" value="{{ $room_data->bed_type }}" required="true" />
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Bathrooms</label>
                                            <input class="form-control" type="number" min="0" name="total_bathrooms" value="{{ $room_data->total_bathrooms }}" required="true" />
                                        </div>
                                        <div class="mb-2 form-group">
                                            <label class="mb-3">Guests</label>
                                            <input class="form-control" type="number" min="0" name="total_guests" value="{{ $room_data->total_guests }}" required="true" />
                                        </div>
                                        <div>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
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
@endpush
