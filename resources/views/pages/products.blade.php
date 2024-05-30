<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Flame & Fragrance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/productss.css') }}">  
    <style>
        .actions {
            display: flex;
            align-items: center;
        }
        
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

    <div class="navbar-container">
        <div class="navbar">
            <div class="links">
                <a href="/">HOME</a>
                <a href="/products">PRODUCTS</a>
                <a href="/#contact">CONTACT</a>
            </div>

            <div class="actions">
                <a href="/cart">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    @if(Auth::check() && Auth::user()->cart)
                        ({{ Auth::user()->cart->items->count() }})
                    @endif
                </a>
                                
                @auth
                    <div class="dropdown">
                        <a id="userDropdown" class="dropdown-toggle"><span class="material-symbols-outlined">account_circle</span> {{ Auth::user()->name }}</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/profile">Profile</a>
                            <a class="dropdown-item" href="/track">Track Orders</a>
                            @if (Auth::user()->role === 'admin')
                            <a class="dropdown-item" href="/dashboard">Dashboard</a>
                            @endif
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
                @else
                    <a href="/login">LOGIN <span class="material-symbols-outlined">login</span></a>
                @endauth
            </div>


        </div>
    </div>

    <div class="products">
        <div class="product-head">
            <a href="">SEE OUR PACKS 🎁</a>
            <form action="{{ route('product') }}" method="GET">
                <select name="sort" onchange="this.form.submit()">
                    <option value="" selected>SORT BY</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>LOW TO HIGH PRICE</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>HIGH TO LOW PRICE</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>NEWEST PRODUCTS</option>
                </select>
            </form>
        </div>

        <div class="product-body">

            @foreach ($products as $product)
                
            <a href="{{ route('product.view', ['slug' => $product->slug]) }}">
            <div class="card">
                <div class="img">
                    <div class="tags">
                        @if($product->tags)
                            @if($product->tags === 'New')
                                <div class="new">{{$product->tags}}</div>
                            @else
                                <div class="hot">{{$product->tags}}</div>
                            @endif
                        @else
                            
                        @endif
                    </div>
                    <img src="{{asset($product->image)}}">
                </div>
                <div class="details">
                    <div class="left">
                        <p>{{$product->name}}</p>
                        <p>{{$product->price}} MAD
                            @if ($product->oldPrice)
                                <i>{{$product->oldPrice}} MAD</i>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </a>
            @endforeach

          

            
           

            
        </div>
    </div>




    <div class="footer">
        <div class="top">
            <div class="left">
                Flame & Fragrance © 2024
            </div>
            <div class="right">
                Switch to
                <a href="">Arabic</a>
                <a href="">French</a>
            </div>
        </div>
        <div class="bottom">
            <div class="left">
            <a href=""> Privacy Policy</a>
            </div>
            <div class="right">
                <a href="">Instagram</a>
                <a href="">Tik Tok</a>
            </div>
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