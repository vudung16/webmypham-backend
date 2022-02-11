<?php
  use Illuminate\Support\Facades\Auth;
  use App\Models\User;
?>
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
                                <a class="nav-link nav-link-sp" href="#">DANH SÁCH SẢN
                                    PHẨM</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-5">
                    @foreach($productall['products'] as $values)
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3 fs-menu">  
                        @if(($values->product_discount)!= NULL)
                        <div class="img-fs-menu">
                            <a href="{{url('product')}}/{{$values -> product_id}}">
                                <img id="img-fs" src="{{url('')}}/img/product/{{$values -> product_image}}" alt="">
                            </a>
                            <div class="btn-in-img">
                                <button type="button" class="add-gds"><i class="fas fa-shopping-basket"></i></button>
                            </div>
                        </div>
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
                            <div class="btn-in-img">
                                <button type="button" class="add-gds"><i class="fas fa-shopping-basket"></i></button>
                            </div>
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