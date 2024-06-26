@extends('admin.layout.app')

@section('title', 'Edit About Page')

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
                                    <h3 class="card-title">Edit About Page</h3>
                                </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-5 toolbar">
                                        <hr>
                                    </div>
                                <div class="material-datatables">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-sm-12">
                                            <div class="mb-3 form-group">
                                                <label class="mb-3">Heading *</label>
                                                <input class="form-control" type="text" name="title" value="{{ $page_data->about_heading }}" required="true" />
                                            </div>
                                            <div class="mb-5">
                                                <label class="mb-3">Content *</label>
                                                <textarea name="content">{{ $page_data->about_content }}</textarea>
                                                <script>
                                                        CKEDITOR.replace( 'content' );
                                                </script>
                                            </div>
                                            <div class="mb-5">
                                                <label class="mb-3">Visi *</label>
                                                <textarea class="form-control" name="about_visi">{{ $page_data->about_visi }}</textarea>
                                            </div>
                                            <div class="mb-4">
                                                <label class="mb-3">Misi *</label>
                                                <textarea class="form-control" name="about_misi">{{ $page_data->about_misi }}</textarea>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Status *</label>
                                                <select name="about_status" class="form-control">
                                                    <option value="1" @if($page_data->about_status == 1) selected @endif>Show</option>
                                                    <option value="0" @if($page_data->about_status == 0) selected @endif>Hide</option>
                                                </select>
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
