@extends('admin.layout.app')

@section('title', 'Add Amenity')

@push('css-custom')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('dist-back/fontawesome/css/fontawesome-iconpicker.min.css') }}">
@endpush

@section('content')
    <div class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4 mb-xl-2 d-flex justify-content-between align-items-center">
                            <h3 class="font-weight-bold">Add New Amenities</h3>
                            <a href="{{ route('amenity.index') }}">
                                <button class="btn btn-info btn-sm">View All</button>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="material-datatables">
                                    <form action="{{ route('amenity.store') }}" method="post">
                                        @csrf
                                        <div class="col-sm-12">
                                            <div class="mb-5 form-group">
                                                <label data-title="Inline picker"
                                                    data-placement="inline"
                                                    class="icp demo"
                                                    data-selected="fa-align-justify"
                                                    >
                                                    Inline mode
                                                </label>
                                                <label class="mb-3">Icon *</label>
                                                <input class="form-control icp icp-auto demo @error('icon') is-invalid @enderror" type="text" name="icon" value="{{ old('icon') }}"/>
                                                <div class="btn-group">
                                                    <button data-selected="graduation-cap" type="button" class="icp demo btn btn-default dropdown-toggle iconpicker-component" data-toggle="dropdown">
                                                        Dropdown  <i class="fa fa-fw"></i>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <div class="dropdown-menu"></div>
                                                </div>
                                                @error('icon')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-5 form-group">
                                                <label class="mb-3">Title *</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}"/>
                                                @error('name')
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
    <script src="{{ asset('dist-back/fontawesome/js/fontawesome-iconpicker.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            $('#cuModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });

            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $('.iconPicker').val(`<i class="${e.iconpickerValue}"></i>`);
            });

        })(jQuery);
    </script>
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
