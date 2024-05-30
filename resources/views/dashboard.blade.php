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

            <div class="stats">
                <div class="card">
                    <span>🔥 TOP SELLING PRODUCT</span>
                    <span><a href="">MINI BUBBLE</a></span>
                </div>

                <div class="card">
                    <span>🔢 TOTAL CLIENTS</span>
                    <span>{{$clients}} Clients</span>
                </div>

                <div class="card">
                    <span>💵 TOTAL REVENUE</span>
                    <span>12.7K MAD</span>
                </div>
            </div>

            <div class="stats" style="margin-top: 2%">
                <div class="card">
                    <span>🔢 TOTAL PRODUCTS</span>
                    <span>{{$products}} Products</span>
                </div>

                <div class="card">
                    <span>🔢 TOTAL PACKS</span>
                    <span>2 Packs</span>
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
                            <a href="">
                            <div class="name">Ahmed Bahij</div>
                            <div class="price">200 MAD</div>
                            <div class="status">Pending</div>
                            <div class="date">20 May 24 10:00AM</div>
                            </a>
                            
                        </div>
                        <div class="data">
                            <a href="">
                            <div class="name">Niama Rez</div>
                            <div class="price">420 MAD</div>
                            <div class="status">Pending</div>
                            <div class="date">18 May 24 06:20AM</div>
                            </a>
                        </div>
                        <div class="data">
                            <a href="">
                            <div class="name">Iness</div>
                            <div class="price">105 MAD</div>
                            <div class="status">Pending</div>
                            <div class="date">15 May 24 16:00PM</div>
                            </a>
                        </div>
                        <div class="data">
                            <a href="">
                            <div class="name">Ahmed Bahij</div>
                            <div class="price">200 MAD</div>
                            <div class="status">Pending</div>
                            <div class="date">20 May 24 10:00AM</div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="right">
                    <div class="head">
                        <span>💵 LATEST SALES</span>
                    </div>

                    <div class="body">
                        <div class="head">
                            <div class="name">Name</div>
                            <div class="price">Price</div>
                        </div>

                        <div class="data">
                            <a href="">
                            <div class="name">Ahmed Bahij</div>
                            <div class="price">200 MAD</div>
                            </a>
                            
                        </div>
                        <div class="data">
                            <a href="">
                            <div class="name">Niama Rez</div>
                            <div class="price">420 MAD</div>
                            </a>
                        </div>
                        <div class="data">
                            <a href="">
                            <div class="name">Iness</div>
                            <div class="price">105 MAD</div>
                            </a>
                        </div>
                        <div class="data">
                            <a href="">
                            <div class="name">Ahmed Bahij</div>
                            <div class="price">200 MAD</div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="reviews">
                <div class="head">
                    <span>⭐ LATEST REVIEWS</span>
                    <span> <a href=""> SEE ALL REVIEWS</a></span>
                </div>

                <div class="body">
                    <div class="head">
                        <div class="name">Name</div>
                        <div class="price">Score</div>
                        <div class="status">Product</div>
                        <div class="date">Date</div>
                    </div>

                    <div class="data">
                        <div class="name">Ahmed Bahij</div>
                        <div class="price">5</div>
                        <div class="status">UNICO AMOR</div>
                        <div class="date">20 May 24 10:00AM</div>
                    </div>
                    
                    <div class="data">
                        <div class="name">Niama Rez</div>
                        <div class="price">4</div>
                        <div class="status">UNICO AMOR</div>
                        <div class="date">10 May 24 21:00PM</div>
                    </div>
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