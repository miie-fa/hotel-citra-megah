@extends('admin.layout.app')

@section('title', 'Add Post')

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
                            <h3 class="font-weight-bold">Add New Post</h3>
                            <a href="{{ route('post.index') }}">
                                <button class="btn btn-info btn-sm">View All</button>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="material-datatables">
                                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-sm-12">
                                            <div class="mb-5 form-group">
                                                <label>Photo *</label>
                                                <input class="form-control @error('thumbnail') is-invalid @enderror" type="file"  name="thumbnail"/>
                                                @error('thumbnail')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-5 form-group">
                                                <label class="mb-3">Title *</label>
                                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}"/>
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-5 form-group">
                                                <label class="mb-3">Content *</label>
                                                <textarea class="@error('content') is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                                                <script>
                                                        CKEDITOR.replace( 'content' );
                                                </script>
                                                @error('content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mt-4">
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
