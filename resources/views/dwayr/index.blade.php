@include('includes.header')
    <body>
        <section class="index">
            <div class="hi">
                <div class="layer">
                    <div class="content">
                        <img class="logo" src="{{ url('/') }}/assets/resources/img/logo.png" />
                        <h1><span>دواير</span> مجتمع بين الشركات يعرض في انجازات الشركات وطلبات الشركات للمطورين</h1>
                        <h2>عرض اعمالك وانجزاتك</h2>
                    </div>
                </div>
            </div>
            <div class="top-companies">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="grid">
                                <h2>من افضل الشركات</h2>
<!--                                <p>مجموعة من الشركات الافضل لدينا في المظام بمكنك معرفة المزيد <a href="#">عرض جميع الشركات</a></p>-->
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                       
                        @foreach ($data['companies'] as $i)
                        <div class="col-md-4">
                            <div class="companie">
                                <img src="/companie/logo/{{ $i->url }}" alt="" class="logo">
                                <h3><a href="/{{ $i->url }}">{{ $i->name }}</a></h3>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            
            <div class="slices">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="slice">
                                <img src="/assets/resources/img/slices/index/addCompany.png" alt="">
                                <div class="text">
                                    <b>اضافة شركة جديد</b>
                                    <p>يمكنك اضافة شركة جديدة بكل سهولة .. بمجرد ادخال معلومات الشركة تصبح الشركة مسجلة لدينا</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="slice">
                                <img src="/assets/resources/img/slices/index/jobApply.png" alt="">
                                <div class="text">
                                    <b>تقدم للوظيفة</b>
                                    <p>التقدم الي وظيفة اصبح اسهل بكثير من ذي قبل بمجرد النقر علي هذا الزر .. وسوف يقوم احد مسؤلين الشركة بالتواصل معاك</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="slice">
                                <img src="/assets/resources/img/slices/index/userVerify.png" alt="">
                                <div class="text">
                                    <b>التحقق من المستخددم</b>
                                    <p>التحقق من حسابك يكون من خلال مقابلة شخصية في احد نقاط دواير المتواجده في محطات العمل</p>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>   
            </div>
            
            <div class="offer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="steps">
                                <div class="row">
                                   
                                    <div class="col-md-3">
                                        <div class="step">
                                            <div class="icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
                                            <div class="text">تكوين ملفك الشخصي</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="step">
                                            <div class="icon"><i class="fa fa-building" aria-hidden="true"></i></div>
                                            <div class="text">انشاء ملف لشركتك</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="step">
                                            <div class="icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                                            <div class="text">انشر الوظائف</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="step">
                                            <div class="icon"><i class="fa fa-cubes" aria-hidden="true"></i></div>
                                            <div class="text">عرض مشاريعك</div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            
            <div class="jobs">
                <h2>الوظائف</h2>
                <div class="container">
                    <div class="row">
                        @foreach ($data['jobs'] as $i)
                        <div class="col-md-4"><a href="/job/show/{{ $i->id }}">{{ $i->title }}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </body>
@include('includes.footer')