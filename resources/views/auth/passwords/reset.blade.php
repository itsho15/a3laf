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
                          <p class="login-box-msg">Reset your password</p>

                            <form method="post" action="{{ url('/password/reset') }}">
                                {!! csrf_field() !!}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-btn fa-refresh"></i>Reset Password
                                        </button>
                                    </div>
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
