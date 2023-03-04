<!DOCTYPE html>
<html lang="en">

@include('MasterLanding.header')

<body>
    <!-- Header -->
    <header class="">
        @include('MasterLanding.navbar')
    </header>

    <!-- Page Content -->
    <div class="page-heading header-text wow fadeInDownBig" style="background-image: url({{ asset($img_banner) }})" data-wow-duration="0.5ss">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if($status == 1)
                        <div class="text-content">
                            <h4>{{ $title }}</h4>
                            <h2>{{ $subtitle }}</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <div class="col mt-3">
                                <div class="row">
                                    @if(count($product) == 0)
                                        <div class="col text-center wow zoomIn"" style=" padding: 35px 0;">
                                            <h4>Tidak ada prodruct for event</h4>
                                        </div>
                                    @else
                                        @foreach($product as $item)
                                            <div class="col-lg-4 col-md-4 all des wow zoomIn">
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
                                                            <p class="colorFont">Harga</p>
                                                        </div>
                                                        <div class="col text-center pr-0">
                                                            <h6 class="discountCard">Rp.{{ number_format($item->price,0,",",".") }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col text-right my-2 px-4">
                                                        <h6>Rp.{{ number_format(($item->price - ($item->price * $item->discount/100)),0,",",".") }}</h6>
                                                    </div>
                                                    <hr class="my-2 mx-4">
                                                    <div class="col">
                                                        <p class="mx-2 colorFont">Kegunaan</p>
                                                    </div>
                                                    <div class="col text-right">
                                                        <h6>{{ ucfirst($item->kegunaan) }}</h6>
                                                    </div>
                                                    <hr class="my-2 mx-4">
                                                    <div class="row mx-2 my-1">
                                                        <div class="col">
                                                            <p class="colorFont">Bentuk Product</p>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h6>{{ ucfirst($item->bentuk_product) }}</h6>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2 mx-4">
                                                    <div class="row mx-2 mt-1 mb-2">
                                                        <div class="col align-self-center">
                                                            <a href="https://api.whatsapp.com/send?phone=6281334888859&text=_Halo%20AvoStore%20Malang_%0ATanya%20product%20*{{ $item->name_product }}*%0A%20%0A%20%0A"
                                                                target="_blank">
                                                                <i class="fab fa-whatsapp fa-lg"
                                                                    style="margin-right: 5px"></i>
                                                            </a>
                                                            <a href="https://www.instagram.com/avostore.malang/"
                                                                target="_blank">
                                                                <i class="fab fa-instagram fa-lg"
                                                                    style="margin-right: 5px"></i>
                                                            </a>
                                                            <a href="https://shopee.co.id/avostore.malang"
                                                                target="_blank">
                                                                <i class="fas fa-shopping-bag fa-lg"
                                                                    style="margin-right: 5px"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col text-right pr-0">
                                                            <a type="button" class="btn btn-light view"
                                                                style="font-size: 15px"
                                                                href="{{ url("/event/detail/$item->idproduct_discount") }}">Show Detail</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                </div>
            </div>
        </div>
    </div>

    @include('MasterLanding.footer')

</body>

</html>