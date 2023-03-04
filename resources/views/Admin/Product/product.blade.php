@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="col-md">
                <div class="row justify-content-center pb-2 pt-4">
                    <div class="col-md-5 text-left">
                        <h4 class="text-dark">Product</h4>
                    </div>
                    <div class="col-md-5 text-right">
                        <button type="button" class="btn btn-outline-info create" data-target="#modalCreate"
                            data-backdrop="static" data-keyboard="false"> <i class="fa fa-plus" aria-hidden="true"></i>&nbsp Add Product</button>
                    </div>
                </div>
            </div>
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
                    @if(session()->get('success'))
                        <div class="alert alert-success alert-dismissible fade show" style="">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card card-info card-outline">
                        <div class="card-body p-0">
                            <table class="table projects">
                                <thead>
                                    <tr>
                                        <th>Name Product</th>
                                        <th>Category</th>
                                        <th>Merek</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($product as $item)
                                    <tr>
                                        <td>{{ $item->name_product }}</td>
                                        <td>{{ $item->name_category }}</td>
                                        <td>{{ $item->merek }}</td>
                                        <td class="text-center">Rp.{{ number_format($item->price,0,",",".") }}</td>
                                        <td class="text-center">{{ $item->stock }}</td>
                                        <td class=" project-actions text-right">
                                            <button type="button" class="btn btn-success btn-sm view"
                                                data-id="{{ $item->idproduct }}" data-target="#modalView">
                                                <i class="fas fa-book-open"></i> View
                                            </button>
                                            <a type="button" class="btn btn-info btn-sm"
                                                href="{{ url("/admin/product/edit/$item->idproduct") }}">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <button class="btn btn-danger btn-sm delete" data-name="{{ $item->name_product }}" data-id="{{ $item->idproduct }}" data-target="#modalDelete">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if(count($product) == 0)
                            <div class="row justify-content-center">
                                <div class="col-md-4 alert alert-light text-center mt-1" role="alert">
                                    Nothing data to show
                                </div>
                            </div>
                        @endif
                    </div>
                    {{ $product->links() }}
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCreate">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="{{ url('/admin/product/create') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col form-group">
                                    <label for="name">Name Product</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        @foreach($category as $item)
                                            <option value="{{ $item->idcategory }}">
                                                {{ $item->name_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="merek">Merek</label>
                                    <input type="text" class="form-control" name="merek" required>
                                </div>
                                <div class="col form-group">
                                    <label for="bentukProduct">Bentuk Produk</label>
                                    <input type="text" class="form-control" name="bentukProduct" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="kegunaan">Kegunaan</label>
                                    <input type="text" class="form-control" name="kegunaan" required>
                                </div>
                                <div class="col form-group">
                                    <label for="jenisKulit">Jenis Kulit</label>
                                    <input type="text" class="form-control" name="jenisKulit" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="kadaluarsa">Kadaluarsa</label>
                                    <input type="text" class="form-control" name="kadaluarsa" required>
                                </div>
                                <div class="col form-group">
                                    <label for="umurSimpan">Umur Simpan</label>
                                    <input type="text" class="form-control" name="umurSimpan" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" name="harga" required>
                                </div>
                                <div class="col form-group">
                                    <label for="stol">Stok</label>
                                    <input type="number" class="form-control" name="stok" required>
                                </div>
                            </div>
                            <div class="col form-group">
                                <label for="dikirim">Dikirim dari</label>
                                <input type="text" class="form-control" name="dikirim"
                                    value="KOTA MALANG - LOWOKWARU, JAWA TIMUR, ID">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile1">Image product</label>
                                <div class="input-group">
                                    <div class="custom-file ">
                                        <input type="file" class="custom-file-input" id="inputBannerImg1"
                                            name="fileName" required>
                                        <label class="custom-file-label" for="inputBannerImg1">Choose
                                            file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contentDescription">Description</label>
                                <textarea class="textarea form-control" name="contentDescription"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="mx-5">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalView">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="col-12">
                                    <img src="" class="product-image imageProduct" alt="Product Image">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="text-center" id="titleView"></h3>
                                <hr>
                                <h5>Spesifikasi Produk</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-3 btn-group btn-group-toggle">
                                        <label>Category</label>
                                    </div>
                                    <div class="col btn-group btn-group-toggle">
                                        <p class="category"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 btn-group btn-group-toggle">
                                        <label>Merek</label>
                                    </div>
                                    <div class="col btn-group btn-group-toggle">
                                        <p class="merek"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 btn-group btn-group-toggle">
                                        <label>Bentuk Produk</label>
                                    </div>
                                    <div class="col btn-group btn-group-toggle">
                                        <p class="bentukProduk"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 btn-group btn-group-toggle">
                                        <label>Jenis Kulit</label>
                                    </div>
                                    <div class="col btn-group btn-group-toggle">
                                        <p class="jenisKulit"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 btn-group btn-group-toggle">
                                        <label>Kadaluarsa</label>
                                    </div>
                                    <div class="col btn-group btn-group-toggle">
                                        <p class="kadaluarsa"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 btn-group btn-group-toggle">
                                        <label>Umur Simpan</label>
                                    </div>
                                    <div class="col btn-group btn-group-toggle">
                                        <p class="umurSimpan"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 btn-group btn-group-toggle">
                                        <label>Stok</label>
                                    </div>
                                    <div class="col btn-group btn-group-toggle">
                                        <p class="stock"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 btn-group btn-group-toggle">
                                        <label>Dikirim Dari</label>
                                    </div>
                                    <div class="col btn-group btn-group-toggle">
                                        <p class="dikirimDari"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="bg-gray py-2 px-3 mt-1" style="border-radius: 10px">
                                    <label for="" class="mb-0">Harga</label>
                                    <h2 class="mb-0 harga"></h2>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="px-3 pt-3 pb-1 mt-2" style="background-color: #f0f0f0; border-radius: 10px">
                            <p id="description"></p>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDelete">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Apa kamu ingin menghapus product</p>
                        <p class="text-center" style="font-size: 20px">
                            <b class="productDelete"></b>
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <a type="button" class="btn btn-danger btn-block deleteYes" href=""> Delete</a>
                            </div>
                            <div class="col">
                                <button class="btn btn-secondary btn-block" data-dismiss="modal" aria-label="Close">Batal</button>
                            </div>
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

        $('.delete').click(function () {
            $('#modalDelete').modal();
            $('.productDelete').text($(this).attr('data-name'));
            var idDelete = $(this).attr('data-id')
            $('.deleteYes').attr('href', "/admin/product/delete/"+ idDelete)
        })

        $(function () {
            // Summernote
            $('.textarea').summernote({
                height: 200,
                toolbar: [
                    // [groupName, [list of button]]
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

        function nl2br(str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }

        $('.view').click(function () {
            var id = $(this).attr('data-id');
            $.ajax({
                    url: '/admin/product/view/' + id,
                    type: 'get',
                    // success: function (response) {
                    //    console.log(response)
                    // }  
                }).done(function (data) {
                    $('#modalView').modal()
                    data.forEach(element => {
                        $('#titleView').text(element.name_product)
                        var harga = element.price
                        var number_string = harga.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                        $(".category").text(": " + element.name_category);
                        $(".merek").text(": " + element.merek);
                        $(".bentukProduk").text(": " + element.bentuk_product);
                        $(".bentukProduk").text(": " + element.bentuk_product);
                        $(".jenisKulit").text(": " + element.jenis_kulit);
                        $(".kadaluarsa").text(": " + element.kadaluarsa);
                        $(".umurSimpan").text(": " + element.umur_simpan);
                        $(".stock").text(": " + element.stock);
                        $(".dikirimDari").text(": " + element.dikirim_dari);
                        $(".imageProduct").attr("src", element.img_product);
                        $(".harga").text("Rp.  " + rupiah);
                        $('#description').html(nl2br(element.description));
                    });

                })
                .fail(function () {
                    console.log('Gagal memanggil data')
                });
        })
    </script>
    @endsection