<x-master-layout>

    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="{{ asset('assets/img/core-img/search.png') }}" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/img/core-img/l1.png') }}" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/img/core-img/logo.png') }}" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a href="shop.html">Shop</a></li>
                    <li><a href="product-details.html">Product</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            {{-- <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div> --}}
            <!-- Cart Menu -->
            {{-- <div class="cart-fav-search mb-100">
                <a href="cart.html" class="cart-nav"><img src="{{ asset('assets/img/core-img/cart.png') }}" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="{{ asset('assets/img/core-img/favorites.png') }}" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="{{ asset('assets/img/core-img/search.png') }}" alt=""> Search</a>
            </div> --}}
            <!-- Social Button -->
            {{-- <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div> --}}
        </header>
        <!-- Header Area End -->

        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">

                <!-- Single Catagory -->
              

                @foreach ($products as $product)

                <!-- Single Catagory -->
                {{-- <div class="single-products-catagory clearfix">
                    <a href="shop.html">
                        <img src="{{ asset('assets/img/bg-img/2.jpg') }}" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $180</p>
                            <h4>Minimalistic Plant Pot</h4>
                        </div>
                    </a>
                </div> --}}

                <div class="single-products-catagory clearfix">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From ${{ $product->price }}</p>
                            <h4>{{ $product->name }}</h4>
                        </div>
                    </a>
                </div>

                @endforeach
                
            </div>

            
            <div class="pagination-wrapper">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
            
        </div>
        <!-- Product Catagories Area End -->

        

    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    

</x-master-layout>
