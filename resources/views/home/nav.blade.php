<body>
    <div class="hero_area">
      <!-- header section strats -->
      <header class="header_section">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ route('dashboard')}}">
            <span>
              Giftos
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.html">
                  Shop
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="why.html">
                  Why Us
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="testimonial.html">
                  Testimonial
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>

            </ul>
            <div class="user_option">
                @if (Route::has('login') )

                @auth
             <!-- Display "My Orders" Link for Logged-In Users -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.index') ?? '#' }}">My Orders</a>
            </li> --}}
                <a href="{{ route('cart.view') }}" class="relative text-dark hover:text-yellow-500">
                    <i class="fa fa-shopping-bag text-xl"></i>
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-yellow-500 text-black text-xs font-bold rounded-full px-2">
                        {{ Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->count() : count(session('cart', [])) }}
                    </span>
                </a>
                
                  <!-- Log out               -->
            <div class="list-inline-item logout">                  
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                 <input type="submit" value="Logout">
                </form>
                </div>
          </div>
          @else
              <a href="{{url('/login')}}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>
                  Login
                </span>
              </a>
              <a href="{{url('/register')}}">
                <i class="fa fa-vcard" aria-hidden="true"></i>
                <span>
                  Register
                </span>
              </a>

              @endauth
              @endif
            
             
            </div>
          </div>
        </nav>
      </header>