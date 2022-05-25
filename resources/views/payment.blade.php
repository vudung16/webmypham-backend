<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Đơn hàng</title>
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style-admin.css') }}" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <h3 class="db border-bottom">Thông tin đơn hàng</h3>
                        <div style="color: #ffffff; text-align: left">Tên khách hàng: {{ json_decode($payment['vnp_OrderInfo'])->name }}</div>
                        <div style="color: #ffffff; text-align: left">Số điện thoại: {{ json_decode($payment['vnp_OrderInfo'])->phone }}</div>
                        <div style="color: #ffffff; text-align: left">Email: {{ json_decode($payment['vnp_OrderInfo'])->email }}</div>
                        <div style="color: #ffffff; text-align: left">Phí vận chuyển: {{ json_decode($payment['vnp_OrderInfo'])->pay_ship }}</div>
                        <div style="color: #ffffff; text-align: left">Thanh toán: {{ json_decode($payment['vnp_OrderInfo'])->total }}</div>
                        <div style="color: #ffffff; text-align: left">Đã thanh toán qua cổng: {{ json_decode($payment['vnp_OrderInfo'])->type }}</div>
                    </div>
                    <div class="text-center">
                        <button><a href="https://doan-frontend-2022.herokuapp.com/#/">Về trang chủ</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>

</body>

</html>