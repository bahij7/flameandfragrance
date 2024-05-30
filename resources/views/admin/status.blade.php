<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Flame & Fragrance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
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
                    <a href="/dashboard/products"><span class="material-symbols-outlined">shopping_bag</span> Products</a>
                    <a href="/dashboard/orders" class="selected"><span class="material-symbols-outlined">list_alt</span> Orders</a>
                    <a href="/dashboard/clients"><span class="material-symbols-outlined">group</span> Clients</a>
                    <span>Others</span>
                    <a href="/dashboard/users"><span class="material-symbols-outlined">group</span> Users</a>
                    <a href="/dashboard/ad"><span class="material-symbols-outlined">ad</span> Advertise</a>
                
                
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


            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
            <div class="order-head">
                <span>{{$order->user->name}}'s Order</span>
                <button type="submit" class="btn btn-primary">Save</button>

            </div>
            
            <div class="order-body">
            
                    <div class="head">
                        <div class="on">Order Number</div>
                        <div class="client">Client</div>
                        <div class="phone">Phone</div>
                        <div class="address">Address</div>
                        <div class="status" for="status">Status</div>
                        <div class="totalPrice">Total Price</div>
                    </div>

                    <div class="body">
                        <div class="on">{{ $order->order_number }}</div>
                        <div class="client">{{ $order->user->name }}</div>
                        <div class="phone">{{ $order->phone }}</div>
                        <div class="address">{{ $order->address }}</div>
                        <div class="status">
                            
                                @method('PUT')
                                <div class="form-group">
                                    <select name="status" id="status">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="on_delivering" {{ $order->status == 'on_delivering' ? 'selected' : '' }}>On Delivering</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </form>
                            
                        </div>
                        <div class="totalPrice">{{ $order->totalPrice }}</div>
                    </div>

                    
            </div>

            <div class="order-foot">
                <div class="top">
                    <span>{{$order->user->name}}'s Products</span>
                </div>

                <div class="middle">
                    @foreach ($order->orderLines as $orderLine)
                    <div class="card">
                        <div class="lside">
                            <img src="{{ asset($orderLine->product->image) }}">
                        </div>
                        <div class="rside">
                            <div class="name">
                                x{{ $orderLine->quantity }} {{ $orderLine->product->name }}
                                <span>Color: {{ $orderLine->color }}</span>
                            </div>
                            <div class="price">
                                {{ $orderLine->price }} MAD
                                <div class="tPrice">TOTAL PRICE: {{ $orderLine->total_price }} MAD</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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