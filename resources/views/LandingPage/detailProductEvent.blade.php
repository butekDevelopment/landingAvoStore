<!DOCTYPE html>
<html lang="en">

@include('MasterLanding.header')

<body>
    <header class="">
        @include('MasterLanding.navbar')
    </header>

    <div class="page-heading pb-0" style="padding-top: 100px !important;">
        @foreach($product as $item)
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading wow fadeInLeft">
                            <h2>Detail Product For Event - <i>{{ $item->name_event }}</i></h2>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 wow bounceInLeft">
                        <div class="col-12">
                            <img src="{{ $item->img_product }}" class="img-fluid product-image" alt="Product Image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 wow fadeInRight">
                        <h3 class="text-center" style="font-weight: bold">{{ ucfirst($item->name_product) }}</h3>
                        <hr class="my-2">
                        <h4 class="text-left">Spesifikasi Produk</h4>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important">Category</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ ucfirst($item->name_category) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important">Merek</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ ucfirst($item->merek) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important;">Bentuk Produk</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ ucfirst($item->bentuk_product) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important">Jenis Kulit</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ ucfirst($item->jenis_kulit) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important">Kegunaan</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ ucfirst($item->kegunaan) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important">Kadaluarsa</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ ucfirst($item->kadaluarsa ) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important">Umur Simpan</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ $item->umur_simpan }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important">Stok</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ $item->stock }} pcs - <p style="font-size: 14px">&nbsp Contact
                                        AvoStore for detail stok</p>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 btn-group btn-group-toggle">
                                <p style="font-weight: bold !important">Dikirim Dari</p>
                            </div>
                            <div class="col btn-group btn-group-toggle">
                                <p class="text-left">{{ $item->dikirim_dari }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="py-2 px-3" style="border-radius: 10px; background-color: #24ad4d">
                            <div class="text-left">
                                <p class="mb-0 text-left" style="color: white; font-size: 16px; display: inline-block">
                                    Diskon&nbsp<p class="persenDiscount">{{ $item->discount }}%</p>
                                </p>
                            </div>
                            <hr class="my-1" style="background-color: white">
                            <p class="mb-0 text-left" style="color: white; font-size: 16px">Harga</p>
                            <div class="text-right">
                                <h2 class="mb-0 text-right priceNormar">
                                    Rp.{{ number_format($item->price,0,",",".") }}
                                </h2>
                                <h2 class="mb-0 text-right"
                                    style="color: white; font-weight: bold; display: inline-block">
                                    Rp.{{ number_format(($item->price - ($item->price * $item->discount/100)),0,",",".") }}
                                </h2>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col align-self-center text-center">
                                <h3>Contact AvoStore</h3>
                                <h6 style="color: grey">For order item</h6>
                            </div>
                            <div class="col text-right align-self-center">
                                <ul class="social-icons">
                                    <li><a href="https://api.whatsapp.com/send?phone=6281334888859&text=_Halo%20AvoStore%20Malang_%0ATanya%20product%20*{{ $item->name_product }}*%0A%20%0A%20%0A"
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
                <hr class="my-2 wow fadeInLeft">
                <div class="px-3 pt-3 pb-1 mt-2 wow fadeInUp" style="background-color: #fafafa; border-radius: 10px">
                    <p class="text-left">{!!nl2br(str_replace(" ", " &nbsp;", $item->description ))!!}</p>
                </div>
                <hr class="my-2">
            </div>
        @endforeach
    </div>

    @include('MasterLanding.footer')

</body>

</html>