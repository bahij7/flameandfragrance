<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flame & Fragrance | Dashboard</title>
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

        .hidden-form {
            display: none;
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
                <a href="/dashboard/"><span class="material-symbols-outlined">list_alt</span> Orders</a>
                <a href="/dashboard/"><span class="material-symbols-outlined">group</span> Clients</a>
                <span>Others</span>
                <a href="/dashboard/ad" class="selected"><span class="material-symbols-outlined">ad</span> Advertise</a>
                <a href="/dashboard/"><span class="material-symbols-outlined">heart_plus</span> Advantages</a>
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

        <div class="ad-head">

            <h1>Advertise</h1>
            @if(!$ad)
                <button type="button" id="showFormButton" >Create New Ad</button>
            @endif

        </div>

        <div class="ad-body">

            @if($ad)
                <p>The ad we'll be in the top of the website on the home page, <a href="/">click here to see it</a></p>
                <form method="POST" action="{{ route('ad.update') }}" id="adForm">
                    @csrf
                    <input type="text" name="ad_content" value="{{ $ad->ad_content }}" required>
                    <input type="submit" value="Save Changes">
                </form>

                <form method="POST" action="{{ route('ad.delete', $ad->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete Ad</button>
                </form>
            @else

            <form method="POST" action="{{ route('ad.store') }}" id="adForm" class="hidden-form">
                @csrf
                <input type="text" name="ad_content" placeholder="Your ad goes here.." required>
                <input type="submit" value="Save">
                <button type="button" id="cancelButton">Cancel</button>
            </form>

            @endif
        </div>

    

    </div>

   
    <script>
            document.addEventListener('DOMContentLoaded', function () {
            // Button to show the form
            const showFormButton = document.getElementById('showFormButton');

            // Form element
            const adForm = document.getElementById('adForm');

            // Cancel button
            const cancelButton = document.getElementById('cancelButton');

            // Toggle form visibility when the "Create New Ad" button is clicked
            showFormButton.addEventListener('click', function () {
                adForm.classList.toggle('hidden-form');
                showFormButton.style.display = 'none'; // Hide the button after showing the form
            });

            // Hide the form and show the "Create New Ad" button when the "Cancel" button is clicked
            cancelButton.addEventListener('click', function () {
                adForm.classList.add('hidden-form');
                showFormButton.style.display = 'block'; // Show the button after hiding the form
            });
        });


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