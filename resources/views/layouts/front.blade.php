@include('layouts.front-end.header')
  @yield('header')
  @yield('carousel')
    <div class="container">
    	@include('layouts.front-end.messages')
      <div class="content pt-5 pb-5" id="content">
          @yield('content')
      </div>
    </div>
@include('layouts.front-end.footer')
