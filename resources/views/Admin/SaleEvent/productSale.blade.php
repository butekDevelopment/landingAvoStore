@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="col-md">
                <div class="row justify-content-center pb-2 pt-4">
                    <div class="col-md-5 text-left">
                        <h4 class="text-dark">Product Sale</h4>
                    </div>
                    <div class="col-md-5 text-right">
                        <button type="button" class="btn btn-outline-info create" data-target="#modalCreate"
                            data-backdrop="static" data-keyboard="false"> <i class="fa fa-plus"
                                aria-hidden="true"></i>&nbsp Add Product Sale</button>
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
                                        <th>Event Sale</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Price Normal</th>
                                        <th class="text-center">Price Discount</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($productEvent as $item)
                                    <tr>
                                        <td>{{ $item->name_product }}</td>
                                        <td>{{ $item->name_event }}</td>
                                        <td class="text-center">{{ $item->discount }} %</td>
                                        <td class="text-center">
                                            Rp.
                                            {{ number_format($item->price,0,",",".") }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $priceDiscount = $item->price - ($item->price * $item->discount/100);
                                            @endphp
                                            Rp.
                                            {{ number_format($priceDiscount,0,",",".") }}
                                        </td>
                                        <td class=" project-actions text-right">
                                            <button type="button" class="btn btn-success btn-sm view"
                                                data-id="{{ $item->idproduct_discount }}" data-target="#modalView">
                                                <i class="fas fa-book-open"></i> View
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm edit"
                                                data-id="{{ $item->idproduct_discount }}" data-target="#modelEdit">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm delete"
                                                data-name="{{ $item->name_product }}"
                                                data-id="{{ $item->idproduct_discount }}" data-target="#modalDelete">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if(count($productEvent) == 0)
                            <div class="row justify-content-center">
                                <div class="col-md-4 alert alert-light text-center mt-1" role="alert">
                                    Nothing data to show
                                </div>
                            </div>
                        @endif
                    </div>
                    {{ $productEvent->links() }}
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCreate">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product For <b>Sale</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="{{ url('/admin/productSale/addNew') }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col form-group">
                                    <label for="product">Product</label>
                                    <select class="form-control product" id="product" name="product" required>
                                        <option value="" selected disabled hidden>Choose Product</option>
                                        @foreach($product as $item)
                                            <option value="{{ $item->idproduct }}">
                                                {{ $item->name_product }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="eventDiscount">Event</label>
                                    <select class="form-control eventDiscount" id="eventDiscount" name="eventDiscount"
                                        required>
                                        <option value="" selected disabled hidden>Choose Event</option>
                                        @foreach($event as $item)
                                            <option value="{{ $item->idevent }}">
                                                {{ $item->name_event }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control harga" readonly
                                        style="background-color: white !important" required>
                                </div>
                                <div class="col form-group">
                                    <label for="merek">Merek</label>
                                    <input type="text" class="form-control merek" required readonly
                                        style="background-color: white !important">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="kegunaan">Kegunaan</label>
                                    <input type="text" class="form-control kegunaan" required readonly
                                        style="background-color: white !important">
                                </div>
                                <div class="col form-group">
                                    <label for="stok">Stok</label>
                                    <input type="text" class="form-control stok" required readonly
                                        style="background-color: white !important">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="kadaluarsa">Kadaluarsa</label>
                                    <input type="text" class="form-control kadaluarsa" required readonly
                                        style="background-color: white !important">
                                </div>
                                <div class="col form-group">
                                    <label for="bentuk_product">Bentuk product</label>
                                    <input type="text" class="form-control bentuk_product" required readonly
                                        style="background-color: white !important">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="discount">Diskon</label>
                                    <select class="form-control discount" id="discount" name="discount" required>
                                        <option value="" selected disabled hidden>Choose Event</option>

                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="bentuk_product">Harga Diskon Product</label>
                                    <input type="text" class="form-control price_discount" required readonly
                                        style="background-color: white !important">
                                </div>
                            </div>
                            <div class="col form-group">
                                <input type="text" class="form-control id_categoryProduct" name="id_categoryProduct"
                                    required readonly style="background-color: white !important; display: none">
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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Product For <b>Sale</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col form-group">
                                <label for="product">Product</label>
                                <input type="text" class="form-control product"
                                    style="background-color: white !important" readonly>
                            </div>
                            <div class="col form-group">
                                <label for="eventDiscount">Event</label>
                                <input type="text" class="form-control eventDiscount"
                                    style="background-color: white !important" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="harga">Harga</label>
                                <input type="text" class="form-control harga" style="background-color: white !important"
                                    readonly>
                            </div>
                            <div class="col form-group">
                                <label for="merek">Merek</label>
                                <input type="text" class="form-control merek" style="background-color: white !important"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="kegunaan">Kegunaan</label>
                                <input type="text" class="form-control kegunaan"
                                    style="background-color: white !important" readonly>
                            </div>
                            <div class="col form-group">
                                <label for="stok">Stok</label>
                                <input type="text" class="form-control stok" style="background-color: white !important"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="kadaluarsa">Kadaluarsa</label>
                                <input type="text" class="form-control kadaluarsa"
                                    style="background-color: white !important" readonly>
                            </div>
                            <div class="col form-group">
                                <label for="bentuk_product">Bentuk product</label>
                                <input type="text" class="form-control bentuk_product"
                                    style="background-color: white !important" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="discount">Diskon</label>
                                <input type="text" class="form-control discount"
                                    style="background-color: white !important" readonly>
                            </div>
                            <div class="col form-group">
                                <label for="price_discount">Harga Diskon Product</label>
                                <input type="text" class="form-control price_discount"
                                    style="background-color: white !important" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDelete">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Product For <b>Sale</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Apa kamu ingin menghapus product</b></p>
                        <p class="text-center" style="font-size: 20px">
                            <b class="productDelete"></b>
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <a type="button" class="btn btn-danger btn-block deleteYes" href=""> Delete</a>
                            </div>
                            <div class="col">
                                <button class="btn btn-secondary btn-block" data-dismiss="modal"
                                    aria-label="Close">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEdit">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="padding-bottom: 0px !important">
                        <h5 class="modal-title">Edit Product For <b>Sale</b><br><p style="font-size: 13px; color: #a7a7a7">Only have change discount</p></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="{{ url('/admin/productSale/saveEdit') }}" method="POST">
                            @csrf
                            <div class="col form-group">
                                <input type="text" class="form-control idproduct_discount" name="idproduct_discount"
                                    required readonly style="background-color: white !important; display: none">
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="productEdit">Product</label>
                                    <input type="text" class="form-control productEdit" readonly
                                        style="background-color: white !important" required>
                                </div>
                                <div class="col form-group">
                                    <label for="eventDiscountEdit">Event</label>
                                    <select class="form-control eventDiscountEdit" id="eventDiscountEdit"
                                        name="eventDiscountEdit" required>
                                        <option value="" selected disabled hidden>Choose Event</option>
                                        @foreach($event as $item)
                                            <option value="{{ $item->idevent }}">
                                                {{ $item->name_event }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control harga" readonly
                                        style="background-color: white !important" required>
                                </div>
                                <div class="col form-group">
                                    <label for="merek">Merek</label>
                                    <input type="text" class="form-control merek" required readonly
                                        style="background-color: white !important">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="kegunaan">Kegunaan</label>
                                    <input type="text" class="form-control kegunaan" required readonly
                                        style="background-color: white !important">
                                </div>
                                <div class="col form-group">
                                    <label for="stok">Stok</label>
                                    <input type="text" class="form-control stok" required readonly
                                        style="background-color: white !important">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="kadaluarsa">Kadaluarsa</label>
                                    <input type="text" class="form-control kadaluarsa" required readonly
                                        style="background-color: white !important">
                                </div>
                                <div class="col form-group">
                                    <label for="bentuk_product">Bentuk product</label>
                                    <input type="text" class="form-control bentuk_product" required readonly
                                        style="background-color: white !important">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="discountEdit">Diskon</label>
                                    <select class="form-control discountEdit" id="discountEdit" name="discountEdit"
                                        required>
                                        <option value="" selected disabled hidden>Choose Event</option>

                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="price_discountEdit">Harga Diskon Product</label>
                                    <input type="text" class="form-control price_discountEdit" required readonly
                                        style="background-color: white !important">
                                </div>
                            </div>
                            
                            <div class="mx-5">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
    @endsection

    @section('Js')
    <script type="text/javascript">
        function nl2br(str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }

        function formatIDR(value) {
            var harga = value
            var number_string = harga.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah;
        }

        /*  Modal Create */ 
        $('.create').click(function () {
            $('#modalCreate').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

      
        $('.product').click(function () {
            $('.price_discount').val('')
            $('.id_categoryProduct').val('')
            var id = $('select[name=product] option').filter(':selected').val()
            if (id != 0) {
                $.ajax({
                        url: '/admin/productSale/getProduct/' + id,
                        type: 'get',
                    }).done(function (data) {
                        data.forEach(element => {
                            var price = "Rp. " + formatIDR(element.price);
                            $('.harga').val(price)
                            $('.merek').val(element.merek)
                            $('.kegunaan').val(element.kegunaan)
                            $('.stok').val(element.stock + " pcs")
                            $('.kadaluarsa').val(element.kadaluarsa)
                            $('.bentuk_product').val(element.bentuk_product)
                            $('.id_categoryProduct').val(element.product_category)
                        });

                    })
                    .fail(function () {
                        console.log("gagal mengambil data")
                    });

            }
        })

        $('.eventDiscount').click(function () {
            $('.discount').val('')
            $('option[name="discount"]').remove();
            $('.price_discount').val('')
            var id = $('select[name=eventDiscount] option').filter(':selected').val()
            if (id != 0) {
                $.ajax({
                        url: '/admin/productSale/getDiscount/' + id,
                        type: 'get',
                    }).done(function (data) {
                        data.forEach(element => {
                            $('#discount').append($('<option>', {
                                name: "discount",
                                text: element.discount,
                                value: element.iddiscount
                            }))
                        });
                    })
                    .fail(function () {
                        console.log("gagal mengambil data")
                    });
            }
        })


        $('.discount').click(function () {
            $('.price_discount').val('')
            var id = $('select[name=discount] option').filter(':selected').val()
            var discount = parseInt($('select[name=discount] option').filter(':selected').text())
            var price_normal = parseFloat(($('.harga').val().replace('Rp. ', '')).replace('.', ''))
            if (id != 0) {
                var price_for_discount = price_normal - (price_normal * discount / 100)
                $('.price_discount').val("Rp. " + formatIDR(Math.round(price_for_discount)))

            }
        })

        $('#modalCreate').on('hidden.bs.modal', function (e) {
            $('option[name="disocunt"]').remove();
            $("#product").val('');
            $("#eventDiscount").val('');
            $('.harga').val('')
            $('.merek').val('')
            $('.kegunaan').val('')
            $('.stok').val('')
            $('.kadaluarsa').val()
            $('.bentuk_product').val('')
            $('.price_discount').val('')
            $('.id_categoryProduct').val('')
        })

        /*  Modal Delete */
        $('.delete').click(function () {
            $('#modalDelete').modal();
            $('.productDelete').text($(this).attr('data-name'));
            var idDelete = $(this).attr('data-id')
            $('.deleteYes').attr('href', "/admin/productSale/delete/" + idDelete)
        })


        /*  Modal View */
        $('.view').click(function () {
            $('#modalView').modal();
            var idView = $(this).attr('data-id')
            console.log(idView)
            $.ajax({
                    url: '/admin/productSale/view/' + idView,
                    type: 'get',
                }).done(function (data) {
                    console.log(data)
                    data.forEach(element => {
                        $('.product').val(element.name_product)
                        $('.eventDiscount').val(element.name_event)
                        $('.harga').val(element.name_event)
                        $('.merek').val(element.merek)
                        $('.harga').val("Rp. " + formatIDR(element.price))
                        $('.merek').val(element.merek)
                        $('.kegunaan').val(element.kegunaan)
                        $('.stok').val(element.stock + " pcs")
                        $('.kadaluarsa').val(element.kadaluarsa)
                        $('.bentuk_product').val(element.bentuk_product)
                        $('.discount').val(element.discount + " %")
                        var price_for_discount = element.price - (element.price * element.discount /
                            100)
                        $('.price_discount').val("Rp. " + formatIDR(Math.round(price_for_discount)))
                    });
                })
                .fail(function () {
                    console.log("gagal mengambil data")
                });
        })

       /*  Modal Edit */
        $('.edit').click(function () {
            var idEdit = $(this).attr('data-id')
            $('.idproduct_discount').val(idEdit)
            $.ajax({
                url: '/admin/productSale/edit/' + idEdit,
                type: 'get',
            }).done(function (data) {
                $('#modalEdit').modal();
                console.log(data)
                data.forEach(element => {
                    $('.productEdit').val(element.name_product)
                    var price = "Rp. " + formatIDR(element.price);
                    $('.harga').val(price)
                    $('.merek').val(element.merek)
                    $('.kegunaan').val(element.kegunaan)
                    $('.stok').val(element.stock + " pcs")
                    $('.kadaluarsa').val(element.kadaluarsa)
                    $('.bentuk_product').val(element.bentuk_product)
                    $('.id_categoryProduct').val(element.product_category)
                });
            }).fail(function () {
                console.log("Gagal memuat data edit")
            })
        })

        $('.eventDiscountEdit').click(function () {
            $('option[name="discountEdit"]').remove();
            var id = $('select[name=eventDiscountEdit] option').filter(':selected').val()
            if (id != 0) {
                $.ajax({
                        url: '/admin/productSale/getDiscount/' + id,
                        type: 'get',
                    }).done(function (data) {
                        data.forEach(element => {
                            $('#discountEdit').append($('<option>', {
                                name: "discountEdit",
                                text: element.discount,
                                value: element.iddiscount
                            }))
                        });
                    })
                    .fail(function () {
                        console.log("gagal mengambil data")
                    });
            }
        })

        $('.discountEdit').click(function () {
            $('.price_discountEdit').val('')
            var id = $('select[name=discountEdit] option').filter(':selected').val()
            var discount = parseInt($('select[name=discountEdit] option').filter(':selected').text())
            var price_normal = parseFloat(($('.harga').val().replace('Rp. ', '')).replace('.', ''))
            if (id != 0) {
                var price_for_discount = price_normal - (price_normal * discount / 100)
                $('.price_discountEdit').val("Rp. " + formatIDR(Math.round(price_for_discount)))

            }
        })

        $('#modalEdit').on('hidden.bs.modal', function (e) {
            $('option[name="discountEdit"]').remove();
            $('.price_discountEdit').val('')
            $('.eventDiscountEdit').val('')
            $('.discountEdit').val('')
        })
    </script>
    @endsection