@extends('admin.layout.app')

@section('title', 'Edit post')

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
                            <h3 class="font-weight-bold">Edit Post</h3>
                            <a href="{{ route('post.index') }}">
                                <button class="btn btn-info btn-sm">View All</button>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="material-datatables">
                                    <form action="{{ route('post.update', $post_data->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-sm-12">
                                            <div class="mt-2 mb-3 fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img width="500" class="img-thumbnail" src="{{ asset('uploads/'. $post_data->thumbnail) }}" alt="...">
                                                </div>
                                            </div>
                                            <div class="mb-3 form-group">
                                                <label>Change Photo</label>
                                                <input class="form-control" type="file"  name="thumbnail"/>
                                                @error('thumbnail')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 form-group">
                                                <label class="mb-3">Title</label>
                                                <input class="form-control" type="text" name="title" value="{{ $post_data->title }}" required="true" />
                                            </div>
                                            <div class="mb-3 form-group">
                                                <label class="mb-3">Content *</label>
                                                <textarea name="content">{{ $post_data->content }}</textarea>
                                                <script>
                                                        CKEDITOR.replace( 'content' );
                                                </script>
                                            </div>
                                            <div class="mt-2">
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
