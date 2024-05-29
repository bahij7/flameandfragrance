<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Flame & Fragrance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/products.css') }}"> 
    <style>
    .dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-toggle {
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 30px;
    background: #010100ba;
    color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-menu .dropdown-item {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-menu .dropdown-item:hover {
    background: #121212;
}

.dropdown:hover .dropdown-menu {
    display: block;
}
</style>
     
</head>
<body>

    <div class="sidebar">
        <div class="logo">
            <a href="/"> FLAME & <br>FRAGRANCE</a>
        </div>

        <div class="links">
            <div class="top">
                <a href="/dashboard/"><span class="material-symbols-outlined">dashboard</span> Dashboard</a>
            </div>
            <div class="middle">
                <span>Management</span>
                <a href="/dashboard/products" class="selected"><span class="material-symbols-outlined">shopping_bag</span> Products</a>
                <a href="/dashboard/"><span class="material-symbols-outlined">list_alt</span> Orders</a>
                <a href="/dashboard/"><span class="material-symbols-outlined">group</span> Clients</a>
                <span>Others</span>
                <a href="/dashboard/ad"><span class="material-symbols-outlined">ad</span> Advertise</a>
                <a href="/dashboard/advantages"><span class="material-symbols-outlined">heart_plus</span> Advantages</a>
                <a href="/dashboard/"><span class="material-symbols-outlined">quiz</span> FAQ's</a>
                <a href="/dashboard/"><span class="material-symbols-outlined">reviews</span> Reviews</a>
            
            
            </div>
            
        </div>
    </div>


    <div class="main">
        <div class="navbar">
            <a href=""><span class="material-symbols-outlined">notifications</span>(0)</a>
            <div class="dropdown">
                <a id="userDropdown" class="dropdown-toggle"><span class="material-symbols-outlined">account_circle</span> {{ Auth::user()->name }}</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/">Home</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                       Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div class="product-head">
            <h1>Products ({{$products->count()}})</h1>
            <a href="/dashboard/products/create">Create New Product</a>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Search..">
            <button type="submit"><span class="material-symbols-outlined">search</span></button>
        </div>

        <div class="product-body">
            <div class="head">
                <div class="name">Name</div>
                <div class="description">Description</div>
                <div class="tags">Tags</div>
                <div class="colors">Colors</div>
                <div class="ispublished">isPublished</div>
                <div class="oldprice">Old Price</div>
                <div class="price">Price</div>
            </div>
            @foreach($products as $product)

            <div class="body">
                <div class="name">
                    <a href="{{ route('product.show', $product->id) }}">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}">
                        @else
                            <div class="img"></div>
                        @endif
                        <span>{{ $product->name }}</span>
                    </a>
                </div>

                <div class="description">
                    @if($product->description)
                        {{$product->description}}
                    @else
                        -
                    @endif
                </div>
                <div class="tags">
                    @if($product->tags)
                        @if($product->tags === 'New')
                            <div class="new">{{$product->tags}}</div>
                        @else
                            <div class="hot">{{$product->tags}}</div>
                        @endif
                    @else
                        -
                    @endif
                </div>
                <div class="colors">All</div>
                <div class="ispublished">
                    @if($product->isPublished)
                        <span class="material-symbols-outlined public">public</span>
                    @else
                    <span class="material-symbols-outlined private">lock</span>
                    @endif
                    </div>
                <div class="oldprice">
                    @if($product->oldPrice)
                        {{$product->oldPrice}} MAD
                    @else
                        -
                    @endif
                </div>
                <div class="price">{{$product->price}} MAD</div>
            </div>
            @endforeach
        </div>


    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdown = document.querySelector('.dropdown');
            var dropdownMenu = document.querySelector('.dropdown-menu');
            var timeout;
        
            dropdown.addEventListener('mouseenter', function() {
                clearTimeout(timeout);
                dropdownMenu.style.display = 'block';
            });
        
            dropdown.addEventListener('mouseleave', function() {
                timeout = setTimeout(function() {
                    dropdownMenu.style.display = 'none';
                }, 200);
            });
        
            dropdownMenu.addEventListener('mouseenter', function() {
                clearTimeout(timeout);
            });
        
            dropdownMenu.addEventListener('mouseleave', function() {
                timeout = setTimeout(function() {
                    dropdownMenu.style.display = 'none';
                }, 200); 
            });
        });
        </script>
</body>
</html>