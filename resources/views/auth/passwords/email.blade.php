<!DOCTYPE html>
<html lang="ar" dir="rtl" class="no-js">
<!-- Begin Head -->
<head>
    <meta charset="utf-8">
    <title>أعلاف - تسجيل الدخول</title>
    <meta name="description" content="منصة الكترونية تخدم المزارعين والمستثمرين بقطاع الأعلاف الخضراء والأعلاف المركبة وأصحاب المواشي لـ ( عرض- طلب ) الأعلاف المحلية و المستوردة">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ================= Favicon ================== -->
    <link rel="shortcut icon" href="{{ url('dist/img/favicon.png') }}">

    <!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** Resources CSS ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

    <!-- ============== Bootstrap v4.2.1 ============== -->
    <link rel="stylesheet" href="{{ url('dist/css/bootstrap-rtl.min.css') }}" />

    <!-- ============== Resource style ============== -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <!-- ============== Lightslider ============== -->
    <link rel="stylesheet" href="{{ asset('dist/css/lightslider.min.css') }}" />

</head>

<body id="to_top">

    <div class="login">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-5">
                    <div class="login-inner">
                        <img class="mb-3" src="{{ url('dist/svg/logo-mobile.svg') }}" alt="logo" />
                        <h2 class="title mb-4">@lang('front.welcome_login')</h2>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{ url('/password/email') }}">
                            {!! csrf_field() !!}
                            <div class="mb-4">
                                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                             </div>
                            <div class="d-flex justify-content-between flex-remove">
                                <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-envelope"></i>@lang('front.Reset_Password_text')
                                </button>
                            </div>
                            <div class="d-flex justify-content-between flex-remove mt-3">
                                    <a href="{{ url('login') }}" class="btn btn-primary">@lang('front.login')</a>
                                    <a href="{{ url('register') }}" class="no-account">@lang('front.no_account')</a>
                             </div>
                        </form>
                    </div>
                </div>

                <div class="col"></div>
            </div>
        </div>
    </div>


    <!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** Resources jQuery ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

    <!-- * Libraries jQuery 3.3.1 * -->
    <script src="dist/js/jquery-3.3.1.slim.min.js"></script>

    <!-- * Libraries jQuery and Bootstrap - Popper * -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <!-- * Libraries jQuery and Bootstrap - Be careful to not remove them * -->
    <script src="dist/js/bootstrap.min.js"></script>

    <!-- * Fontawesome * -->
    <script src="https://kit.fontawesome.com/b03bc3a15c.js" crossorigin="anonymous"></script>

    <!-- Main JS -->
    <script src="dist/js/init.js"></script>

</body>

</html>