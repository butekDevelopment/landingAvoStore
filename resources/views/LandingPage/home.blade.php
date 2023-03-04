<!DOCTYPE html>
<html lang="en">

@include('MasterLanding.header')

<body>
    <!-- Header -->
    <header class="">
        @include('MasterLanding.navbar')
    </header>

    <!-- Banner Starts Here -->
    <div class="banner header-text wow fadeInDownBig">
        <div class="owl-banner owl-carousel">
            <div class="banner-item-01" style="background-image: url({{ ($img_content1) }})">
                @if($status1 == 1)
                    <div class="text-content">
                        <h4>{{ $title1 }}</h4>
                        <h2>{{ $subtitle1 }}</h2>
                    </div>
                @endif
            </div>
            <div class="banner-item-02" style="background-image: url({{ asset($img_content2) }})">
                @if($status2 == 1)
                    <div class="text-content">
                        <h4>{{ $title2 }}</h4>
                        <h2>{{ $subtitle2 }}</h2>
                    </div>
                @endif
            </div>
            <div class="banner-item-03" style="background-image: url({{ asset($img_content3) }})">
                @if($status3 == 1)
                    <div class="text-content">
                        <h4>{{ $title3 }}</h4>
                        <h2>{{ $subtitle3 }}</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->

    <!-- Page Content -->
    @if($haveEvent)
        <div class="latest-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading wow bounceIn">
                            <h2>Promotion</h2>
                        </div>
                    </div>
                    @if(count($productEvent) == 0)
                        <div class="col text-center" style="padding: 35px 0;">
                            <h5>Wait, we are preparing a promo product</h5>
                        </div>
                    @else
                        @foreach($productEvent as $item)
                            <div class="col-md-4 wow backInLeft">
                                <div class="product-item">
                                    <a href="#"><img class="img-radius" src="{{ $item->img_product }}"
                                            alt="Image product"></a>
                                    <div class="down-content text-center">
                                        <a href="#">
                                            <h4 class="mb-1">{{ $item->name_product }}</h4>
                                        </a>
                                    </div>
                                    <hr class="my-2 mx-3">
                                    <div class="row mx-2">
                                        <div class="col">
                                            <p>Harga</p>
                                        </div>
                                        <div class="col text-right">
                                            <h6>Rp.{{ number_format($item->price,0,",",".") }}
                                            </h6>
                                        </div>
                                    </div>
                                    <hr class="my-2 mx-4">
                                    <div class="col">
                                        <p class="mx-2">Kegunaan</p>
                                    </div>
                                    <div class="col text-right">
                                        <h6>{{ $item->kegunaan }}</h6>
                                    </div>
                                    <hr class="my-2 mx-4">
                                    <div class="row mx-2 my-1">
                                        <div class="col">
                                            <p>Bentuk Product</p>
                                        </div>
                                        <div class="col text-right">
                                            <h6>{{ $item->bentuk_product }}</h6>
                                        </div>
                                    </div>
                                    <hr class="my-2 mx-4">
                                    <div class="row mx-2 mt-1 mb-2">
                                        <div class="col align-self-center">
                                            <a href="https://api.whatsapp.com/send?phone=6281334888859&text=_Halo%20AvoStore%20Malang_%0ATanya%20product%20*{{ $item->name_product }}*%0A%20%0A%20%0A"
                                                target="_blank">
                                                <i class="fab fa-whatsapp fa-lg" style="margin-right: 5px"></i>
                                            </a>
                                            <a href="https://www.instagram.com/avostore.malang/" target="_blank">
                                                <i class="fab fa-instagram fa-lg" style="margin-right: 5px"></i>
                                            </a>
                                            <a href="https://shopee.co.id/avostore.malang" target="_blank">
                                                <i class="fas fa-shopping-bag fa-lg" style="margin-right: 5px"></i>
                                            </a>
                                        </div>
                                        <div class="col text-right">
                                            <a type="button" class="btn btn-light view" style="font-size: 15px"
                                                href="{{ url("/product/detail/$item->idproduct") }}">Show
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <hr class="my-1">
                @if(count($productEvent) != 0)
                    <div class="text-center">
                        <a href="{{ url('/event') }}" class="btn btn-success wow fadeInUp"
                            style="font-size: 15px; border-radius: 5px">View all products promotion</a>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading wow bounceIn">
                        <h2>New Products</h2>
                    </div>
                </div>
                @if(count($newItem) == 0)
                    <div class="col text-center" style="padding: 35px 0;">
                        <h4>Nothing product</h4>
                    </div>
                @else
                    @foreach($newItem as $item)
                        <div class="col-md-4 wow backInLeft">
                            <div class="product-item">
                                <a href="#"><img class="img-radius" src="{{ $item->img_product }}"
                                        alt="Image product"></a>
                                <div class="down-content text-center">
                                    <a href="#">
                                        <h4 class="mb-1">{{ $item->name_product }}</h4>
                                    </a>
                                </div>
                                <hr class="my-2 mx-3">
                                <div class="row mx-2">
                                    <div class="col">
                                        <p>Harga</p>
                                    </div>
                                    <div class="col text-right">
                                        <h6>Rp.
                                            {{ number_format($item->price,0,",",".") }}
                                        </h6>
                                    </div>
                                </div>
                                <hr class="my-2 mx-4">
                                <div class="col">
                                    <p class="mx-2">Kegunaan</p>
                                </div>
                                <div class="col text-right">
                                    <h6>{{ $item->kegunaan }}</h6>
                                </div>
                                <hr class="my-2 mx-4">
                                <div class="row mx-2 my-1">
                                    <div class="col">
                                        <p>Bentuk Product</p>
                                    </div>
                                    <div class="col text-right">
                                        <h6>{{ $item->bentuk_product }}</h6>
                                    </div>
                                </div>
                                <hr class="my-2 mx-4">
                                <div class="row mx-2 mt-1 mb-2">
                                    <div class="col align-self-center">
                                        <a href="https://api.whatsapp.com/send?phone=6281334888859&text=_Halo%20AvoStore%20Malang_%0ATanya%20product%20*{{ $item->name_product }}*%0A%20%0A%20%0A"
                                            target="_blank">
                                            <i class="fab fa-whatsapp fa-lg" style="margin-right: 5px"></i>
                                        </a>
                                        <a href="https://www.instagram.com/avostore.malang/" target="_blank">
                                            <i class="fab fa-instagram fa-lg" style="margin-right: 5px"></i>
                                        </a>
                                        <a href="https://shopee.co.id/avostore.malang" target="_blank">
                                            <i class="fas fa-shopping-bag fa-lg" style="margin-right: 5px"></i>
                                        </a>
                                    </div>
                                    <div class="col text-right">
                                        <a type="button" class="btn btn-light view" style="font-size: 15px"
                                            href="{{ url("/product/detail/$item->idproduct") }}">Show
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <hr class="my-1">
            @if(count($newItem) != 0)
                <div class="text-center">
                    <a href="{{ url('/product') }}" class="btn btn-info wow fadeInUp"
                        style="font-size: 15px; border-radius: 5px">View all products</a>
                </div>
            @endif
        </div>
    </div>
    <div class="best-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading wow backInRight">
                        <h2>AvoStore Malang</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center wow zoomIn">
                        <img class="img-fluid" src={{ $img_logo }} alt="">
                    </div>
                </div>
                <div class="col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="left-content">
                        <h4 class="mt-2">About Us</h4>
                        <p>{!!nl2br(str_replace(" ", " &nbsp;", $content_about ))!!}</p>
                        <ul class="social-icons text-center">
                            <li><a href="https://api.whatsapp.com/send?phone=6281334888859&text=_Halo%20AvoStore%20Malang_%0A%20%0A%20%0A"
                                    target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                            <li><a href="https://www.instagram.com/avostore.malang/" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li><a href="https://shopee.co.id/avostore.malang" target="_blank"><i
                                        class="fas fa-shopping-bag"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalView">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="" class="product-image imageProduct" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="text-center" id="titleView"></h3>
                            <hr class="my-2">
                            <h5>Spesifikasi Produk</h5>
                            <hr>
                            <div class="row">
                                <div class="col-4 btn-group btn-group-toggle">
                                    <p style="font-weight: bold !important">Category</p>
                                </div>
                                <div class="col btn-group btn-group-toggle">
                                    <p class="category"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 btn-group btn-group-toggle">
                                    <p style="font-weight: bold !important">Merek</p>
                                </div>
                                <div class="col btn-group btn-group-toggle">
                                    <p class="merek"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 btn-group btn-group-toggle">
                                    <p style="font-weight: bold !important">Bentuk Produk</p>
                                </div>
                                <div class="col btn-group btn-group-toggle">
                                    <p class="bentukProduk"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 btn-group btn-group-toggle">
                                    <p style="font-weight: bold !important">Jenis Kulit</p>
                                </div>
                                <div class="col btn-group btn-group-toggle">
                                    <p class="jenisKulit"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 btn-group btn-group-toggle">
                                    <p style="font-weight: bold !important">Kadaluarsa</p>
                                </div>
                                <div class="col btn-group btn-group-toggle">
                                    <p class="kadaluarsa"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 btn-group btn-group-toggle">
                                    <p style="font-weight: bold !important">Umur Simpan</p>
                                </div>
                                <div class="col btn-group btn-group-toggle">
                                    <p class="umurSimpan"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 btn-group btn-group-toggle">
                                    <p style="font-weight: bold !important">Stok</p>
                                </div>
                                <div class="col btn-group btn-group-toggle">
                                    <p class="stock"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 btn-group btn-group-toggle">
                                    <p style="font-weight: bold !important">Dikirim Dari</p>
                                </div>
                                <div class="col btn-group btn-group-toggle">
                                    <p class="dikirimDari"></p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="py-2 px-3" style="border-radius: 10px; background-color: grey">
                                <p class="mb-0" style="color: white; font-size: 16px">Harga</p>
                                <h2 class="mb-0 harga" style="color: white"></h2>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="px-3 pt-3 pb-1 mt-2" style="background-color: #f0f0f0; border-radius: 10px">
                        <p id="description"></p>
                    </div>
                    <hr class="my-2">
                </div>
            </div>
        </div>
    </div>

    @include('MasterLanding.footer')
    <script>
        owl = $(".owl-carousel");
        owl.owlCarousel({
            loop: true,
            autoplaySpeed: 2000,
            items: 1,
            autoplay: true
        });
    </script>
    <script>
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


</body>

</html>