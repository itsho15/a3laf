<!DOCTYPE html>
<html @if(direction() == 'rtl') lang="ar" @else lang="en" @endif @if(direction() == 'rtl') dir="rtl" @endif class="no-js">

<!-- Begin Head -->
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- ================= Favicon ================== -->
    <link rel="shortcut icon" href="{{ url('dist/img/favicon.png') }}">
    <link rel="manifest" href="{{request()->root()}}/manifest.json">
    <!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** Resources CSS ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

    <!-- ============== Bootstrap v4.2.1 ============== -->
    <link rel="stylesheet" href="{{ url('dist/css/bootstrap-rtl.min.css') }}" />

    <!-- ============== Resource style ============== -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <!-- ============== Lightslider ============== -->
    <link rel="stylesheet" href="{{ asset('dist/css/lightslider.min.css') }}" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    @stack('css')
</head>

<body id="to_top">

<div class="login">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-5">
                <div class="login-inner">
                    <img class="mb-3" src="dist/svg/logo-mobile.svg" alt="logo" />
                    <h2 class="title mb-4">تسجيل عضوية جديدة</h2>
                    <form class="login-form from-group" method="post" action="{{ url('/register') }}">

                        {!! csrf_field() !!}

                        <div class="mb-4">
                            <label>الاسم</label>
                            <div class="lemail has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="الاسم الأول , الاخير">
                            </div>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label>رقم هاتفك</label>
                            <div class="lemail">
                                <i class="fas fa-phone"></i>
                                <input type="tel" name="phone" class="form-control" placeholder="+1 xxx-xxx-xxxx">
                            </div>

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label>بريدك الالكترونى</label>
                            <div class="lemail has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                <i class="fas fa-envelope"></i>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="john@example.com">
                            </div>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label>كلمة المرور</label>
                            <div class="lpassword has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                <i id="show_password" class="far fa-eye"></i>
                                <input type="password" name="password" id="password" class="password-input form-control" placeholder="كلمة المرور">
                            </div>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label>تأكيد كلمة المرور</label>
                            <div class="lpassword has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <i id="show_password" class="far fa-eye"></i>
                                <input type="password" name="password_confirmation" id="password" class="password-input form-control" placeholder="كلمة المرور">
                            </div>

                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between flex-remove">
                            <button class="btn btn-primary">أنضم لمنصة أعلاف</button>
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

