
    @extends('layout.index')
    @section('content')
        <div class="body-sanpham mt-5" id="content">
            <div class="container">
                <div class="row">
                    <div class="d-flex ">
                        <ul class="nav nav-tabs nav-sp">
                            <li class="nav-item nav-it-sp">
                                <a class="nav-link nav-link-sp" href="{{url('home')}}">TRANG CHỦ</a>
                            </li>
                            <li class="nav-item nav-it-sp">
                                <a class="nav-link nav-link-sp" href="{{url('product-all')}}">DANH SÁCH SẢN
                                    PHẨM</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-3" style="color:black; font-size: 20px;">Danh mục {{$productcate['name']->category_name}}</div> 
                <div class="row pt-5">
                    @foreach($productcate['product'] as $values)
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3 fs-menu">  
                        @if(($values->product_discount)!= NULL)
                        <div class="img-fs-menu">
                            <a href="{{url('product')}}/{{$values -> product_id}}">
                                <img id="img-fs" src="{{url('')}}/img/product/{{$values -> product_image}}" alt="">
                            </a></div>
                        <div class="label-fs">
                            <span class="lbsale">{{(ceil(100-($values -> product_discount)/($values -> product_price)*100))}}%</span>
                            <div class="label-fs-1"></div>
                        </div>
                        <a href="{{url('product')}}/{{$values -> product_id}}">{{$values -> product_name}}</a>
                        <div class="value-fs"> <small>{{number_format($values->product_price)}}₫</small>
                            <strong class="value-sale">{{number_format($values->product_discount)}}₫</strong>
                        </div>
                        @else
                        <div class="img-fs-menu">
                        <a href="{{url('product')}}/{{$values -> product_id}}">
                                <img id="img-fs" src="{{url('')}}/img/product/{{$values -> product_image}}" alt="">
                        </a>
                            </div>
                        <a href="{{url('product')}}/{{$values -> product_id}}">{{$values -> product_name}}</a>
                        <div class="value-fs"><strong class="value-sale">{{number_format($values->product_price)}}₫</strong></div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>  
  @endsection
    @section('script')