<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$product->name}} | Flame & Fragrance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/show.css') }}"> 
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

    @if(session('success'))
        <div class="popup-message">
            {{ session('success') }}
        </div>
    @endif

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
                <a href="/dashboard/clients" ><span class="material-symbols-outlined">group</span> Clients</a>
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

        <div class="product-head">
            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            <a href="{{ route('product.edit', $product->id) }}">Edit</a>
        </div>

        <div class="product-body">

        <div class="left">
            @if($product->image)
                <img src="{{asset($product->image)}}"/>
            @else
                <span>No Image</span>
            @endif
        </div>
        <div class="right">
            <div class="name">
                {{$product->name}}
            </div>
            <div class="prices">
                {{$product->price}} MAD
                @if($product->oldPrice)
                        <span>{{$product->oldPrice}} MAD</span>
                    @else
                        
                    @endif
            </div>

            <div class="description">
                {{$product->description }}
            </div>

            <div class="status">
                @if($product->isPublished)
                    <span class="material-symbols-outlined public">public</span> This Product is Public 
                    @else
                    <span class="material-symbols-outlined private">lock</span> This Product is Private 
                    @endif
            </div>
           
            <div class="actions">
                @if($product->isPublished)
                    <form action="{{ route('product.publish', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit">Make it Private!</button>
                    </form>
                @else
                    <form action="{{ route('product.publish', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit">Make it Public!</button>
                    </form>
                @endif
            </div>

        
            <div class="badge">
                <div class="tag">
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
        

                <div class="pack">
                    @if($product->pack_id)
                        {{$product->pack->name}}
                    @else
                        No Pack
                    @endif
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