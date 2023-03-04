@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="col-md">
                <div class="row justify-content-center pb-2 pt-4">
                    <div class="col-md-10 text-left">
                        <h4 class="text-dark">Edit Product</h4>
                    </div>
                </div>
            </div>
            <!-- Main row -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @if(session()->get('failed'))
                        <div class="alert alert-warning alert-dismissible fade show">
                            {{ session()->get('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif
                    <div class="card card-info card-outline">
                        <!-- /.card-header -->
                        <div class="card-body p-10">
                            <form role="form" action="{{ url("/admin/product/submit/edit/$idView") }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @foreach($product as $item)
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="name">Name Product</label>
                                            <input type="text" class="form-control" name="name" value="{{ $item->name_product }}" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="category">Category</label>
                                            <select class="form-control" id="category" name="category">
                                                @foreach($category as $item2)
                                                    <option value="{{ $item2->idcategory }}" {{ $item->product_category == $item2->idcategory ? "selected" : "" }}>
                                                        {{ $item2->name_category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="merek">Merek</label>
                                            <input type="text" class="form-control" name="merek" value="{{ $item->merek }}" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="bentukProduct">Bentuk Produk</label>
                                            <input type="text" class="form-control" name="bentukProduct" value="{{ $item->bentuk_product }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="kegunaan">Kegunaan</label>
                                            <input type="text" class="form-control" name="kegunaan" value="{{ $item->kegunaan }}" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="jenisKulit">Jenis Kulit</label>
                                            <input type="text" class="form-control" name="jenisKulit" value="{{ $item->jenis_kulit }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="kadaluarsa">Kadaluarsa</label>
                                            <input type="text" class="form-control" name="kadaluarsa" value="{{ $item->kadaluarsa }}" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="umurSimpan">Umur Simpan</label>
                                            <input type="text" class="form-control" name="umurSimpan" value="{{ $item->umur_simpan }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="harga">Harga</label>
                                            <input type="number" class="form-control" name="harga" value="{{ $item->price }}"  required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="stol">Stok</label>
                                            <input type="number" class="form-control" name="stok" value="{{ $item->stock }}" required>
                                        </div>
                                    </div>
                                    <div class="col form-group">
                                        <label for="dikirim">Dikirim dari</label>
                                        <input type="text" class="form-control" name="dikirim" value="{{ $item->dikirim_dari }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputFile1">Image product</label>
                                        <div class="text-center mt-1">
                                            <img class="img-fluid" src="{{ $item->img_product }}" alt="imageProduct">
                                            <p style="color: grey">Gambar sekarang</p>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input" id="inputBannerImg1" name="fileName">
                                                <label class="custom-file-label" for="inputBannerImg1">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="contentDescription">Description</label>
                                        <textarea class="textarea form-control" name="contentDescription"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!nl2br(str_replace(" ", " &nbsp;", $item->description ))!!}</textarea>
                                    </div>
                                    <div class="mx-5">
                                        <button type="submit" class="btn btn-info btn-block">Save</button>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
    @endsection

    @section('Js')
    <script type="text/javascript">
        $('.create').click(function () {
            $('#modalCreate').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        $(function () {
            // Summernote
            $('.textarea').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            })
        })

        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        })
    </script>
    @endsection