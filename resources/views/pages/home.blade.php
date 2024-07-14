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
       @include('partials._header')
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
                    <a href="{{ route('productDetails', $product->id) }}">
                        <img src="{{ asset('/assets/img/bg-img/' . $product->image) }}" alt="{{ $product->name }}">
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
