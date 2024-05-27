<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit {{$product->name}} | Flame & Fragrance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}"> 
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
            <span>Editing <span>{{$product->name}}</span></span>
            <a href="">Delete</a>
            
        </div>

        <div class="product-body">
            <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

               

                    <div class="top">
                        <input type="text" name="name" placeholder="Product's Name*" value="{{$product->name}}" required/>
                        <textarea name="description" placeholder="Product's Description" value="{{$product->description}}"></textarea>
                    </div>

                    <div class="middle">
                        <input type="number" name="oldPrice" placeholder="Product's Old Price" value="{{$product->oldPrice}}"/>
                        <input type="number" name="price" placeholder="Product's Price*" value="{{$product->price}}" required/>
                        <select name="tags">
                            <option value="" selected>Product's Tag</option>
                            <option value="New">New</option>
                            <option value="Hot">Hot</option>
                        </select>

                        <select id="pack_id" name="pack_id">
                            <option value="" selected>Product's Pack</option>
                            @foreach($packs as $pack)
                                <option value="{{ $pack->id }}">{{ $pack->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="file-container">
                        @if($product->image)
                            <span>Previous Product's Image</span>
                            <img src="{{asset($product->image)}}" />
                            <label for="file" class="file-label">Choose file to change it</label>
                            <input type="file" id="file" class="file-input" name="image" onchange="displayFileName()">
                            <span class="file-name" id="file-name"></span>
                        @else
                            <span>Product's Image</span>
                            <label for="file" class="file-label">Choose file</label>
                            <input type="file" id="file" class="file-input" name="image" onchange="displayFileName()">
                            <span class="file-name" id="file-name"></span>
                        @endif
                    </div>

                    <div class="bottom">
                        <div class="status">
                            @if($product->isPublished)
                                <span class="material-symbols-outlined public">public</span> This Product is Public 
                                @else
                                <span class="material-symbols-outlined private">lock</span> This Product is Private 
                                @endif
                        </div>
                    </div>

                    <button type="submit">Save</button>
            </form>
        </div>


    <script>

        function displayFileName() {
            const fileInput = document.getElementById('file');
            const fileName = document.getElementById('file-name');
            fileName.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : '';
        }

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