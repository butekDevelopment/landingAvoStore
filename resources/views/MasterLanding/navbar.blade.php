<nav class="navbar navbar-expand-lg ">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h2>AvoStore <em>Malang</em></h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @if ($posNavbar == "home") active @endif">
                    <a class=" nav-link" href="{{ url('/') }}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item @if ($posNavbar ==  "product") active @endif">
                    <a class="nav-link" href="{{ url('/product') }}">Products</a>
                </li>
                @if($haveEvent)
                    <li class="nav-item @if ($posNavbar ==  "event") active @endif">
                        <a class="nav-link" href="{{ url('/event') }}">Promotion</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>