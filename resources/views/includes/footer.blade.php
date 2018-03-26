<footer>
        <div class="footer-link">
            <div class="container">
                <div class="row">
<!--
                    <div class="col-md-3">
                        <div class="links">
                            <h4>كومتشو</h4>
                            <ul>
                                <li><a href="#">نبذة عن كومتشو شركات</a></li>
                                <li><a href="#">الأسئلة الشائعة</a></li>
                                <li><a href="#">شروط الاستخدام</a></li>
                                <li><a href="#">بيان الخصوصية</a></li>
                            </ul>
                        </div>
                    </div>
-->
                    <div class="col-md-3">
                        <div class="links">
                            <h4>روابط</h4>
                            <ul>
                                <li><a href="/job">الوظائف</a></li>
                                <li><a href="/faq">الأسئلة الشائعة</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="links">
                            <h4>التواصل</h4>
                            <ul>
                                <li><a href="https://www.facebook.com/DwayrDotCom/"><i class="fa fa-facebook-square" aria-hidden="true"></i> facebook</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <img src="{{ url('/') }}/assets/resources/img/logo.png" alt="">
            <b>جميع الحقوق محفوظة - 2017</b>
        </div>
    </footer>
    <script>
        const URLPASE = "{{ url('/') }}";
        function loading()
        {
            $('#loading').show();
            $('#loadinged').prop("disabled", true);
        }
        function loadinged()
        {
            $('#loading').hide();
            $('#loadinged').prop("disabled", false);
        }
        
        var makeAlert = function(data)
        {
            if ( data.status == true ) {
                swal({
                    text: data.message,
                    confirmButtonColor: '#2ecc71',
                    type: 'success',
                });
            } else if ( data.status == false ) {
                swal({
                    text: data.message,
                    confirmButtonColor: '#2ecc71',
                    type: 'warning',
                });
            } else {
                swal({
                    text: data.message,
                    confirmButtonColor: '#2ecc71',
                    type: 'question',
                });
            }
            // action
            if ( data.action ) {
                data.action.forEach(function(i) {
                    var func = i;
                    eval(func);
                });
            }
        }
        
        var goTo = function(url)
        {
            location.href = url;
        }
        
    </script>
    @if( MIN )
    <script src="{{ url('/') }}/assets/dist/js/all.js"></script>
    @endif
    
    @if( !MIN )
    <script src="{{ url('/') }}/assets/components/moment/moment.min.js"></script>
    <script src="https://limonte.github.io/sweetalert2/dist/sweetalert2.all.min.js"></script>
   
    <script src="{{ url('/') }}/assets/components/jquery/jquery-1.11.3.min.js"></script>
    <script src="{{ url('/') }}/assets/components/bootstrap/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/components/tagsinput/bootstrap-tagsinput.min.js"></script>
    
    <script src="{{ url('/') }}/assets/components/angular/angular.min.js"></script>
    <script src="{{ url('/') }}/assets/components/angular/angular-animate.min.js"></script>
    <script src="{{ url('/') }}/assets/components/angular/ngAlertify.js"></script>
    <script src="{{ url('/') }}/assets/components/angular/datepicker/datepicker.js"></script>
    <script src="{{ url('/') }}/assets/components/angular/input_tag/ng-tags-input.min.js"></script>
    <script src="{{ url('/') }}/assets/components/angular/v_accordion/v-accordion.js"></script>
     @endif
    
    <!-- tinymce -->
    <script src="{{ url('/') }}/assets/components/tinymce/tinymce.min.js"></script>
    <script src="{{ url('/') }}/assets/components/tinymce/angular-ui-tinymce.min.js"></script>
    
    @if( !MIN )
    <script src="{{ url('/') }}/assets/resources/js/modules.js"></script>
    <script src="{{ url('/') }}/assets/resources/js/controllers/controller-companie.js"></script>
    <script src="{{ url('/') }}/assets/resources/js/controllers/controller-user.js"></script>
    <script src="{{ url('/') }}/assets/resources/js/controllers/controller-job.js"></script>
    <script src="{{ url('/') }}/assets/resources/js/controllers/controller-project.js"></script>
    <script src="{{ url('/') }}/assets/resources/js/controllers/controller-settings.js"></script>
    <script src="{{ url('/') }}/assets/resources/js/controllers/controller-notification.js"></script>
    <script src="{{ url('/') }}/assets/resources/js/controllers/controller-faq.js"></script>
    <script src="{{ url('/') }}/assets/resources/js/controllers/controller-generateCv.js"></script>
    @endif

    <script>
        $( document ).ready(function() {
            var box_home = $('div.vh > .layer').height();
            var box_home_content = $('div.vh > .layer .content').height();
            var total = (box_home - box_home_content)/2;
            $('div.vh > .layer').css({
                'padding-top' : total
            });
        });
    </script>
</html>