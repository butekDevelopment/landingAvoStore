<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item has-treeview {{ $posSidebar == "Landing Config" ? "menu-open" : "menu-open" }} mb-3">
                <a href="#"
                    class="nav-link {{ $posSidebar == "Landing Config" ? "active" : "" }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Landing Content
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin') }}"
                            class="nav-link {{ $posSubSidebar == "Home Content" ? "active" : '' }}">
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/productContent') }}"
                            class="nav-link {{ $posSubSidebar == "Product Content" ? "active" : '' }}">
                            <p>Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/promotionContent') }}"
                            class="nav-link {{ $posSubSidebar == "Promotion Content" ? "active" : '' }}">
                            <p>Promotion</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ $posSidebar == "Product" ? "menu-open" : "menu-open" }}">
                <a href="#"
                    class="nav-link {{ $posSidebar == "Product" ? "active" : "" }}">
                    <i class="nav-icon fa fa-shopping-bag"></i>
                    <p>Product
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin/category') }}"
                            class="nav-link {{ $posSubSidebar == "Category Product" ? "active" : '' }}">
                            <p>Category Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/product') }}" class="nav-link {{ $posSubSidebar == "List Product" ? "active" : '' }}">
                            <p>Product</p>
                        </a>
                    </li>
                   
                </ul>
            </li>
            <li class="nav-item has-treeview {{ $posSidebar == "Event" ? "menu-open" : "menu-open" }}">
                <a href="#"
                    class="nav-link {{ $posSidebar == "Event" ? "active" : "" }}">
                    <i class="nav-icon fa fa-tags"></i>
                    <p>Event Sale
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin/sale') }}" class="nav-link {{ $posSubSidebar == "Sale" ? "active" : '' }}">
                            <p>Sale</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/productSale') }}" class="nav-link {{ $posSubSidebar == "List Product Sale" ? "active" : '' }}">
                            <p>Product Sale</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <hr>
                <a href="{{ url('/') }}" target="_blank" class="nav-link text-center bg-blue">
                    <p>Go to Landing Page</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>