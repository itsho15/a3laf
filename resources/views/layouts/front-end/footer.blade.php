</div><!-- #content -->
    <footer>
        <div class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-5">
                        <div class="footer-widget">
                            <img class="mb-3" src="{{ url('dist/svg/logo-mobile.svg') }}" alt="" />
                            <p class="desc">{{ setting('aboutus_'.lang()) }}</p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="footer-widget">
                            <ul>
                                 <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('/') }}">@lang('front.homepage') <span class="sr-only">(current)</span></a>
                                </li>
                                @foreach(\App\Models\Page::get() as $page)
                                    <li><a href="{{ url('pages/'.$page->id.'/'.str_slug($page->slug,'-')) }}">{{ $page->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="footer-widget">
                            <ul>
                                 @foreach(\App\Models\Category::get() as $category)
                                    <li><a href="{{ url('categories/'.$category->id) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="footer-widget download-widget mb0 text-center">
                            <a href="{{ setting('andriod') }}" target="_blank">
                               <img class="img-fluid google-play mb-1" src="{{ url('dist/img/google-play.jpg') }}" alt="تحميل من جوجل بلاي" />
                            </a>
                            <a href="{{ setting('ios') }}" target="_blank">
                               <img class="img-fluid app-store mb-3" src="{{ url('dist/img/app-store.jpg') }}" alt="تحميل من متجر أبل" />
                            </a>
                            <p class="download-notice">حمّل مجاناً التطبيق الخاص بموبايلك</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-md-6"><span class="copyrights-text">جميع الحقوق محفوظة © لموقع أعلاف 2020</span></div>

                </div>
            </div>
        </div>
    </footer>
    <!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** Resources jQuery ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

    <!-- * Libraries jQuery and Bootstrap - Popper * -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- * Fontawesome * -->

    <script src="https://kit.fontawesome.com/b03bc3a15c.js" crossorigin="anonymous"></script>


    <script src="{{ asset('js/all.js') }}"></script>
    @include('front.firebasejs_file')
    <script>
        $(document).ready(function(){
            const config = {
               apiKey: "AIzaSyBvUmOtnTGD7EYTgCUkVufMdHm1fkOIy6I",
                authDomain: "a3laf-app.firebaseapp.com",
                databaseURL: "https://a3laf-app.firebaseio.com",
                projectId: "a3laf-app",
                storageBucket: "a3laf-app.appspot.com",
                messagingSenderId: "791431869550",
                appId: "1:791431869550:web:7060997d3fcacf1509e27f",
                measurementId: "G-C02RG5JT28"
            };
            firebase.initializeApp(config);
            const messaging = firebase.messaging();

            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function(token) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({
                        url: '{{ URL::to('/save-device-token') }}',
                        type: 'POST',
                        data: {
                            user_id: {!! json_encode(auth()->id() ?? '') !!},
                            fcm_token: token
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            //console.log(response)
                        },
                        error: function (err) {
                            console.log(" Can't do because: " + err);
                        },
                    });
                })
                .catch(function (err) {
                    console.log("Unable to get permission to notify.", err);
                });

            messaging.onMessage(function(payload) {

                if(payload.notification.click_action == "newMessage"){
                    var newmessage = `<li> <a href="conversation/${payload.data.model.conversation_id}"> ${payload.notification.title} </a></li>`;
                    $('.notifications').append(newmessage);
                }

                const noteTitle = payload.notification.title;
                const noteOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                    link: payload.notification.icon,
                };
                new Notification(noteTitle, noteOptions);
            });
        });
    </script>

    <script type="text/javascript">
        $('#notify_mark_as_read').on('click',function(e){
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            id = $(this).data('id');
            conversation_id = $(this).data('conversation_id');
            $.ajax({
                url: '{{ URL::to('/mark_notification_as_read') }}',
                type: 'POST',
                data: {
                    id: id,
                    conversation_id: conversation_id,
                },
                dataType: 'JSON',
                success: function (response) {
                    window.location.href = response.url;
                },
                error: function (err) {
                    console.log(" Can't do because: " + err);
                },
            });
        });
    </script>

     @stack('js')
    </body>

</html>
