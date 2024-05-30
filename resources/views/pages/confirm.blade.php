<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Flame & Fragrance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/confirmed.css') }}">  
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

    <div class="confirm">
         
        <div class="confirm-head">
            <span>Thank you {{Auth::user()->name}}.</span>
        </div>
        <div class="confirm-body">

            <div class="cntr">
                <div class="head">
                    <div class="on">ORDER NUMBER</div>
                    <div class="phone">PHONE</div>
                    <div class="address">ADDRESS</div>
                    <div class="status">STATUS</div>
                    <div class="totalPrice">TOTAL PRICE</div>
                </div>
            </div>

            <div class="cntr">
                <div class="head">
                    <div class="on">{{ $order->order_number }}</div>
                    <div class="phone">{{ $order->phone }}</div>
                    <div class="address">{{ $order->address }}</div>
                    <div class="status">{{ $order->status }}</div>
                    <div class="totalPrice">{{ $order->totalPrice }}</div>
                </div>
            </div>


       
    </div>


    <div class="confirm-foot">
        <div class="top">
            <span>Products you orderd :</span>
        </div>

        <div class="middle">
            @foreach ($orderLines as $orderLine)
            <div class="card">
                <div class="lside">
                    <img src="{{ asset($orderLine->product->image) }}">
                </div>
                <div class="rside">
                    <div class="name">
                        x{{ $orderLine->quantity }} {{$orderLine->product->name}}
                        <span>Color : {{ $orderLine->color }}</span>
                    </div>
                    <div class="price">
                        {{ $orderLine->price }} MAD
                        <div class="tPrice">TOTAL PRICE : {{ $orderLine->total_price }} MAD</div>
                    </div>
                    
                </div>
            </div>
        </div>


        <div class="bottom">
            <a href="/track">TRACK ORDER</a>
        </div>


    </div>





    {{-- <div class="footer">
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
    </div>   --}}

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