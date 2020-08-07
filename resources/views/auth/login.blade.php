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
                        <img class="mb-3" src="dist/svg/logo-mobile.svg" alt="logo" />
                        <h2 class="title mb-4">@lang('front.welcome_login')</h2>

                    <form method="post" action="{{ url('/login') }}"  class="login-form from-group" id="loginform">
                        {!! csrf_field() !!}
                            <div class="mb-4">
                                <label>@lang('front.email')</label>
                                <div class="lemail form-group m-t-40 has-feedback {{ $errors->has('email') ? ' has-error' : '' }}"  >
                                    <i class="fas fa-envelope"></i>
                                    <input type="text" required name="email" value="{{ old('email') }}"  class="form-control" placeholder="{{ trans('front.loginby_email_or_phone') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="mb-4">
                                <label>@lang('front.password')</label>
                                <div class="lpassword has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <i id="show_password" class="far fa-eye"></i>

                                    <input class="password-input form-control" type="password" required="" placeholder="{{ trans('front.password') }}" name="password">
                                    @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                           <div class="d-flex justify-content-between flex-remove">
                                <button class="btn btn-primary"> @lang('front.login')</button>
                                <a href="{{ route('password.request') }}" class="forget-password">@lang('front.forget_password')</a>
                            </div>
                        </form>

                        <div class="mt-4">
                            <a href="{{ url('register') }}" class="no-account">@lang('front.no_account')</a>
                        </div>

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