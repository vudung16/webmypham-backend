<div class="abc">
    <nav class="nav-hamburger">
      <ul class="nav-ul-hbg">
        <li class="nav-li-hbg nav-item dropdown">
          <a class="nav-li-a-hbg" href="#" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">Danh mục sản
            phẩm</a>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            @foreach ($home['category'] as $value)
              <a class="nav-item item-mb-p2" href="#">{{$value->category_name}}</a>
            @endforeach
            </div>
          </div>
        </li>
        <li class="nav-li-hbg"><a class="nav-li-a-hbg" href="#">Chính sách</a></li>
        <li class="nav-li-hbg"><a class="nav-li-a-hbg" href="#">Liên hệ</a></li>
        <li class="nav-li-hbg nav-item dropdown">
          <a class="nav-li-a-hbg" href="#" data-toggle="collapse" data-target="#navbarNavAltMarkup1"
            aria-controls="navbarNavAltMarkup1" aria-expanded="false" aria-label="Toggle navigation">Tài khoản</a>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup1">
            <div class="navbar-nav">
              <a class="nav-item item-mb-p2" href="{{ url('login') }}">Đăng nhập</a>
              <a class="nav-item item-mb-p2" href="{{ url('register') }}">Đăng ký</a>
            </div>
          </div>
        </li>
      </ul>
    </nav>
  </div>
  <div id="contentLayer">
  </div>
  </div>
  <div id="container">
  <!-- header -->
    <header class="home-header" id="home-header">
      <div class="navbar navbar-expand-lg cl-header">
        <div class="container d-flex justify-content-between py-1">
          <div class="mobie-menu d-flex">
            <div id="hamburger">
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
          <div class="d-flex">
            <form action="search" method="get" class="form-inline d-flex justify-content-center md-form form-sm active-pink active-pink-2">
              @csrf
              <button type="submit"><i class="fas fa-search cl-icon-w" aria-hidden="true"></i></button>
              <input class="form-control form-control-sm ml-3 w-3 hd-fix-input" type="text"
                placeholder="Tìm kiếm sản phẩm" aria-label="Search" name="search">
            </form>
          </div>
          <div class="d-flex">
        
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown1">
            <ul class="navbar-nav">
            @if(Auth::check())
              <li class="nav-item dropdown shopping-cart">
                <a href="#" class="nav-link cl-l-header hd-icon-c3 " id="navbarDarkDropdownMenuLink1"
                  role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-shopping-cart cl-icon-w"></i>
                  <span class="shopping-cart-i">{{ showCartNumber() }}</span>
                </a>
                <ul class="dropdown-menu dropdown-wishlist" aria-labelledby="navbarDarkDropdownMenuLink1">
                    
                    <div class="wishlist">{{showWishlist()}}</div>
                    <a href="{{ url('listcart') }}" class="dropdown-item fix-item-gh">Thanh toán >></a> 
                </ul>   
              </li>
              @else
              <li class="nav-item dropdown shopping-cart">
                <a href="#" class="nav-link cl-l-header hd-icon-c3 " id="navbarDarkDropdownMenuLink1"
                  role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-shopping-cart cl-icon-w"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink1">
                  <a class="dropdown-item fix-item-user" href="{{ url('login') }}">Bạn phải đăng nhập để sử dụng</a>
                </ul>
              </li>
             @endif 
            </ul>  
           
          </div>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown1">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle cl-l-header" href="#" id="navbarDarkDropdownMenuLink1"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user cl-icon-w"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink1"> 
                    @if(Auth::check())
                      <p class="dropdown-item fix-item-user">Xin chào @foreach($home['name'] as $values) {{$values->proname }} @endforeach</p>
                      <a class="dropdown-item fix-item-user" href="{{asset('listorder')}}">Đơn mua</i></a>
                      <a class="dropdown-item fix-item-user" href="{{asset('profile')}}">Tài khoản</i></a>
                      <a class="dropdown-item fix-item-user" href="{{asset('logout')}}">Đăng xuất</i></a>
                    @else
                      <a class="dropdown-item fix-item-user" href="{{ url('login') }}">Đăng nhập</a>  
                      <a class="dropdown-item fix-item-user" href="{{ url('register') }}">Đăng ký</a>
                    @endif
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="container hide-mb">
        <div class="row cl-ct2-tt">
          <div class="col-12 col-md-4 col-lg-3">
            <div class="dropdownmenu-body hide-mb">
              <nav class="navbar navbar-light light-blue lighten-4 fix-navbar-menu-hbg up-menu-hbg">
                <a class="navbar-brand fix-navbar-brand" href="#">
                  <div class="dropdown-title fix-title-dropdown">
                    <h5>Danh mục sản phẩm</h5>
                  </div>
                </a>
                <button class="navbar-toggler toggler-example fix-toggler-example collapsed" type="button"
                  data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
                  aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i
                      class="fas fa-bars fa-1x"></i></span>
                </button>
                <div class="collapse navbar-collapse fix-mb-navbar-collapse down-menu-hbg" id="navbarSupportedContent1">
                @foreach ($home['category'] as $value)
                  <div class="btn-group dropright fix-dropright"> 
                    <a class="btn btn-link dropdown dropdownmenubtn" id="dropdownMenuButton" href="{{url('category')}}/{{$value->category_id}}">
                      {{$value->category_name}}
                    </a>
                  </div>
                @endforeach
                </div>
              </nav>
            </div>
          </div>
          <div class="col-12 col-md-8 col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fix-navbar">
              <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ">
                  <div class="d-flex fix-menu--">
                    <li class="nav-item active fix-title-menu">
                      <a class="nav-link " href="#">TRANG CHỦ</a>
                    </li>
                    <li class="nav-item fix-title-menu">
                      <a class="nav-link " href="#">SẢN PHẨM MỚI</a>
                    </li>
                    <li class="nav-item fix-title-menu">
                      <a class="nav-link" href="#">KHUYẾN MÃI</a>
                    </li>
                    <li class="nav-item fix-title-menu">
                      <a class="nav-link " href="#">GÓC TƯ VẤN</a>
                    </li>
                  </div>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
