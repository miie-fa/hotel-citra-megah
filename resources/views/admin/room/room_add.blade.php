@extends('admin.layout.app')

@section('title', 'Add Room')

@push('css-custom')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link
    rel="stylesheet"
    href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
    type="text/css"
    />
    <style>
    .upload__box {
    padding: 40px;
}

.upload__inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.upload__btn {
    display: inline-block;
    font-weight: 600;
    color: #fff;
    text-align: center;
    min-width: 116px;
    padding: 5px;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid;
    background-color: #4045ba;
    border-color: #4045ba;
    border-radius: 10px;
    line-height: 26px;
    font-size: 14px;
}

.upload__btn:hover {
    background-color: unset;
    color: #4045ba;
    transition: all 0.3s ease;
}

.upload__btn-box {
    margin-bottom: 10px;
}

.upload__img-wrap {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px;
}

.upload__img-box {
    width: 200px;
    padding: 0 10px;
    margin-bottom: 12px;
}

.upload__img-close {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 10px;
    right: 10px;
    text-align: center;
    line-height: 24px;
    z-index: 1;
    cursor: pointer;
}

.upload__img-close::after {
    content: '\2716';
    font-size: 14px;
    color: white;
}


    .img-bg {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    position: relative;
    padding-bottom: 100%;
    }
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-4 mb-xl-2 d-flex justify-content-between align-items-center">
                        <h3 class="font-weight-bold">Add New Room</h3>
                        <a href="{{ route('room.index') }}">
                            <button class="btn btn-info btn-sm">View All</button>
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="material-datatables">
                                <input type="text" name="room_id" value="{{ $room_id }}" readonly>

                                <form action="{{ route('room.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-12">
                                        <div class="mb-3 form-group">
                                            <label>Photo *</label>
                                            <input class="form-control form-control-sm @error('featured_photo') is-invalid @enderror" type="file"  name="featured_photo" />
                                            @error('featured_photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Name *</label>
                                            <input class="form-control form-control-sm @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Description *</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                            <script>
                                                    CKEDITOR.replace( 'description' );
                                            </script>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Price *</label>
                                            <input class="form-control form-control-sm @error('price') is-invalid @enderror" type="number" min="0" name="price" value="{{ old('price') }}" />
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Total Rooms *</label>
                                            <input class="form-control form-control-sm @error('total_rooms') is-invalid @enderror" type="number" min="0" name="total_rooms" value="{{ old('total_rooms') }}" />
                                            @error('total_rooms')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Amenities</label>
                                            @php $i=0; @endphp
                                            @foreach($all_amenities as $item)
                                            @php $i++; @endphp
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="{{ $item->id }}" id="defaultCheck{{ $i }}" name="arr_amenities[]">
                                                <label class="custom-control-label text-secondary" for="defaultCheck{{ $i }}">{{ $item->name }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Size</label>
                                            <input class="form-control form-control-sm @error('size') is-invalid @enderror" type="number" min="0" name="size" value="{{ old('size') }}" />
                                            @error('size')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Bed type</label>
                                            <input class="form-control form-control-sm @error('bed_type') is-invalid @enderror" type="text" min="0" name="bed_type" value="{{ old('bed_type') }}" />
                                            @error('bed_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="mb-3">Bathrooms</label>
                                            <input class="form-control form-control-sm @error('total_bathrooms') is-invalid @enderror" type="number" min="0" name="total_bathrooms" value="{{ old('total_bathrooms') }}" />
                                            @error('total_bathrooms')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-4 form-group">
                                            <label class="mb-3">Guests</label>
                                            <input class="form-control form-control-sm @error('total_guests') is-invalid @enderror" type="number" min="0" name="total_guests" value="{{ old('total_guests') }}" />
                                            @error('total_guests')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 card">
                        <div class="card-header">Image</div>
                        <div class="card-body">
                            <div class="upload__box">
                                <div class="upload__btn-box">
                                    <label class="upload__btn">
                                    <p>Upload images</p>
                                    <input type="file" multiple="" data-max_length="20" class="upload__inputfile">
                                    </label>
                                </div>
                                <div class="upload__img-wrap"></div>
                            </div>
                            <form method="post" action="{{ route('room.gallery.store', $room_id) }}" enctype="multipart/form-data" class="dropzone" id="gallery">
                            @csrf
                            @method('POST')
                            </form>
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
        jQuery(document).ready(function () {
        ImgUpload();
        });

        function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function () {
            $(this).on('change', function (e) {
            imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
            var maxLength = $(this).attr('data-max_length');

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            var iterator = 0;
            filesArr.forEach(function (f, index) {

                if (!f.type.match('image.*')) {
                return;
                }

                if (imgArray.length > maxLength) {
                return false
                } else {
                var len = 0;
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i] !== undefined) {
                    len++;
                    }
                }
                if (len > maxLength) {
                    return false;
                } else {
                    imgArray.push(f);

                    var reader = new FileReader();
                    reader.onload = function (e) {
                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                    imgWrap.append(html);
                    iterator++;
                    }
                    reader.readAsDataURL(f);
                }
                }
            });
            });
        });

        $('body').on('click', ".upload__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i].name === file) {
                imgArray.splice(i, 1);
                break;
            }
            }
            $(this).parent().parent().remove();
        });
        }

        new Dropzone("#gallery", {
            thumbnailWidth: 200,
            maxFilesize:1,
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            autoProcessQueue: false,
            init: function() {
                this.on("addedfile", function(file) {
                    const reader = new FileReader();

                    reader.onload = function() {
                        const img = document.createElement("img");
                        img.src = reader.result;
                        img.style.maxWidth = "300px";
                        img.style.maxHeight = "300px";
                        document.getElementById("preview").innerHTML = ""; // Bersihkan pratinjau sebelumnya
                        document.getElementById("preview").appendChild(img);
                    };

                    reader.readAsDataURL(file);
                });
            }
        })

        // Dropzone.options.dropzone =
        //     {
        //         maxFilesize: 1,
        //         renameFile: function(file) {
        //             var dt = new Date();
        //             var time = dt.getTime();
        //         return time+file.name;
        //         },
        //         acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //         addRemoveLinks: true,
        //         timeout: 5000,
        //         success: function(file, response)
        //         {
        //             console.log(response);
        //         },
        //         error: function(file, response)
        //         {
        //         return false;
        //         }
        // };
    </script>
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
