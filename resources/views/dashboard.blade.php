<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Flame & Fragrance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
                    <a href="/dashboard/" class="selected"><span class="material-symbols-outlined">dashboard</span> Dashboard</a>
                </div>
                <div class="middle">
                    <span>Management</span>
                    <a href="/dashboard/products"><span class="material-symbols-outlined">shopping_bag</span> Products</a>
                    <a href="/dashboard/orders"><span class="material-symbols-outlined">list_alt</span> Orders</a>
                    <a href="/dashboard/clients"><span class="material-symbols-outlined">group</span> Clients</a>
                    <span>Others</span>
                    <a href="/dashboard/users"><span class="material-symbols-outlined">group</span> Users</a>
                    <a href="/dashboard/ad"><span class="material-symbols-outlined">ad</span> Advertise</a>
                
                
                </div>
                
            </div>
        </div>


        <div class="main">
            
            <div class="navbar">
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

            <div class="stats">
                <div class="card">
                    <span>🔥 TOP SELLING PRODUCT</span>
                    <span>
                        @if($orders>1)
                        <a href="{{route('product.show', $topSellingProduct->id)}}">{{ $topSellingProduct->name }}</a>
                        @else
                        Not Calculated yet
                        @endif
                    </span>
                </div>

                <div class="card">
                    <span>🔢 TOTAL CLIENTS</span>
                    <span>{{$clients}} Clients</span>
                </div>

                <div class="card">
                    <span>💵 TOTAL REVENUE</span>
                    <span>{{ $revenue }} MAD</span>
                </div>
            </div>

            <div class="stats statstwo" style="margin-top: 2%">
                <div class="card">
                    <span>🔢 TOTAL PRODUCTS</span>
                    <span>{{$products}} Products</span>
                </div>

                

                <div class="card">
                    <span>🔢 TOTAL ORDERS</span>
                    <span>{{$orders}} Orders</span>
                </div>
            </div>

            <div class="table">

                <div class="left">
                    <div class="head">
                        <span>📦 LATEST ORDERS</span>
                    </div>

                    <div class="body">
                        <div class="head">
                            <div class="name">Name</div>
                            <div class="price">Price</div>
                            <div class="status">Status</div>
                            <div class="date">Date</div>
                        </div>
                        
    
                        <div class="data">
                            @if($latestOrders)
                    @foreach ($latestOrders as $order)
                            <a href="{{route('order.show', $order->id)}}">
                            <div class="name">{{ $order->user->name }}</div>
                            <div class="price">{{ $order->totalPrice }} MAD</div>
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
                            <div class="date">{{ $order->created_at->format('d M Y H:i') }}</div>
                            </a>
                            @endforeach
                            @else
                            No Sales right now
                            @endif
                        </div>
                    

                    </div>
                </div>

                <div class="right">
                    @if($sales)
                            
                    <div class="head">
                        <span>💵 LATEST SALES</span>
                    </div>

                    <div class="body">
                        
                        <div class="head">
                            <div class="name">Name</div>
                            <div class="price">Price</div>
                        </div>

                        
                        <div class="data">
                            @foreach ($sales as $sale)
                            <a href="{{route('order.show', $sale->id)}}">
                            <div class="name">{{ $sale->user->name }}</div>
                            <div class="price">{{ $sale->totalPrice }} MAD</div>
                            </a>
                            @endforeach
                            
                        </div>

                    </div>
                    @else
                            No Sales right now
                            @endif
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