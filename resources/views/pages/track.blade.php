<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Flame & Fragrance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/track.css') }}">  
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


    <div class="track">
        <div class="track-head">
            <span>Track an order.</span>
        </div>

        <div class="track-body">
            <form action="{{ route('track.order.submit') }}" method="POST">
                @csrf
                <input type="text" placeholder="Order Number" name="order_number" required>
                <button type="submit">Track</button>
            </form>
        </div>

        <div class="track-foot">

            <div class="error">
                @if(session()->has('error'))
                    {{ session()->get('error') }}
                @endif
            </div>

            @if (isset($order))
            <div class="order-details">
                <div class="cntr">
                    <div class="head">
                        <div class="status">STATUS</div>
                        <div class="client">CLIENT NAME</div>
                        <div class="address">ADDRESS</div>
                        <div class="totalPrice">TOTAL PRICE</div>
                    </div>
                </div>

                <div class="cntr">
                    <div class="body">
                        <div class="status">
                                @if($order->status == 'pending')
                                    <div class="pending"><span class="material-symbols-outlined">schedule</span> Pending</div>
                                @elseif($order->status == 'processing')
                                    <div class="processing"><span class="material-symbols-outlined">candle</span> Processing</div>
                                @elseif($order->status == 'on_delivering')
                                    <div class="on_delivering"><span class="material-symbols-outlined">local_shipping</span> On Delivering</div>
                                @elseif($order->status == 'delivered')
                                    <div class="delivered"><span class="material-symbols-outlined">check_circle</span> Delivered</div>
                                @elseif($order->status == 'cancelled')
                                    <div class="cancelled"><span class="material-symbols-outlined">cancel</span> Cancelled</div>
                                @else
                                    {{ $order->status }}
                                @endif
                        </div>
                        
                        <div class="client">{{ $order->user->name }}</div>
                        <div class="address">{{ $order->address }}</div>
                        <div class="totalPrice">{{ $order->totalPrice }} MAD</div>
                    </div>
                </div>

                    <div class="products-ordered">
                        Products :
                @foreach ($order->orderLines as $orderLine)
                        <div class="card">
                            <img src="{{asset($orderLine->product->image)}}"> x{{ $orderLine->quantity }} {{ $orderLine->product->name }} - {{ $orderLine->color }} 
                        </div>

                        
                     @endforeach
                    </div>
                   
                
            </div>
            @endif


            
                
          
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