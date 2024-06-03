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
    @if(session('success'))
    <div class="popup-message">
        {{ session('success') }}
    </div>
@endif

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
                            <a class="dropdown-item" href="/orders">My Orders</a>
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
            <a href="/track">Track Order</a>
        </div>

        <div class="product-body">


        <div class="orders">
            @if($orders->isEmpty())
                <p>No orders found.</p>
            @else

            @foreach ($orders->reverse() as $order)
                
            <div class="order">
                <div class="top">
                    <div class="left">Order Number : #{{$order->order_number}}</div>
                    <div class="right">Total Price : {{$order->totalPrice}} MAD</div>
                </div>
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
                <div class="bottom">
                    <div class="left"><a href="{{ route('order.display', ['orderNumber' => $order->order_number]) }}">See More Details</a></div>
                    <div class="right"> {{$order->created_at->format('H:i A d M y')}}</div>
                    
                   </div>
            </div>

            @endforeach

            @endif

        </div>

          

            
           

            
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