<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Flame & Fragrance | Home</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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

        @if($ad && $ad->ad_content)
            <div class="ad">
                {{ $ad->ad_content }}
            </div>
        @endif
    
        <div class="navbar-container">
            <div class="navbar">
                <div class="links">
                    <a href="/">HOME</a>
                    <a href="/products">PRODUCTS</a>
                    <a href="#contact">CONTACT</a>
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

        <div class="container">
            <div class="intro">
                <div class="slogan">
                    <span>COZY VIBES<br>PEACEFUL MIND.</span>
                </div>
            </div>
        </div>

    <div class="stripe-container">
        <div class="stripe">
            <p>FLAME & FRAGRANCE</p>
            <p><span class="material-symbols-outlined">location_on</span> GUELMIM, MOROCCO</p>
        </div>
    </div>

    <div class="picks">
        <div class="picks-head">
            <span>TOP PICKS 🔥</span>
        </div>
        <div class="picks-body">

            @foreach ($hotProducts as $product)
                
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


    <div class="products">
        <div class="products-head">
            <span>PRODUCTS</span>
        </div>

        <div class="products-body">

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

        <div class="products-foot">
            <a href="/products">SEE ALL PRODUCTS</a>
        </div>
    </div>

    <div class="advantages">

        <div class="top">
            <div class="advantage"><div class="text"><div class="name">GOOD QUALITY</div>Excellence in every detail, ensuring products that exceed expectations.</div></div>
            <div class="advantage emoji">👌🏻</div>
            <div class="advantage emoji">💵</div>
            <div class="advantage"><div class="text"><div class="name">REASONABLE PRICE</div>High-quality products at prices that make smart decisions easy.</div></div>
        </div>

        <div class="bottom">
           <div class="advantage emoji">📦</div>
           <div class="advantage"><div class="text"><div class="name">DELIVERY ALL IN MOROCCO</div>High-quality products at prices that make smart decisions easy.</div></div>
           <div class="advantage emoji">🤝🏻</div>
           <div class="advantage"><div class="text"><div class="name">GOOD SERVICE</div>Clear communication, professionalism, and timely delivery for your satisfaction.</div></div>
        </div>

    </div>


    <div class="faq">
        <div class="faq-head">
            <span>FAQ</span>
            <span>Your Quick Answers to Common Questions. 💌</span>

        </div>


        <div class="faq-body">


            <div class="question">
                <div class="q">When do I pay for my order?</div>
                <div class="a">
                    You pay for your order when it gets delivered to you. We use a payment method called cash on delivery, which means you give the money to the delivery person when they bring your order to your door.                </div>
            </div>

            <div class="question">
                <div class="q">What are your products made of?</div>
                <div class="a">
                    We make customized candles in various colors. You can choose your favorite color, and we will create a candle just for you. Our candles also have a pleasant scent.
                </div>
            </div>

            <div class="question">
                <div class="q">Are there any special discounts for events</div>
                <div class="a">
                    Yes, we offer special discounts during certain events. You can get discounts for Eid al-Adha, Eid al-Fitr, and New Year. These discounts are our way of celebrating these special occasions with you.
                </div>
            </div>
            <div class="question">
                <div class="q">Can I return or exchange a product?</div>
                <div class="a">
                    If your order is totally destroyed, you can get your money back or we can send you a new order. Just contact our customer service, and they will help you with the process.</div>
            </div>


        </div>

    </div>

    <div class="contact">
        <div class="contact-left">
            <div><span class="material-symbols-outlined">alternate_email</span></div>
            <div>Get in touch with us.</div>
        </div>
        <div class="contact-right">
            <form action="" method="POST">
                @csrf
                <input type="text" placeholder="Full Name">
                <input type="email" placeholder="Email">
                <input type="tel" placeholder="Phone Number">
                <textarea placeholder="Please type your message here..."></textarea>
                <button type="submit">Send Message</button>

            </form>

        </div>
    </div>

    <div class="footer">
            <div class="top">
                <div class="left">
                    Flame & Fragrance © 2024
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