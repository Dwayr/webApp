@include('includes.header')
<body>
    <section class="account">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="account-box">
                        <div class="content notifications">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <b>{{ $data['notification']['number'] }}</b>
                            <p>الاشعارات</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    
                    @if ( $data['steps']['USJ'] == false )
                    <div class="alert alert-warning">
                        <strong>اعدادات التوظيف</strong> برجاء الذهاب اللي اعدادات التوظيف للحصول علي الوظائف المقترحة <a href="/settings/job">الذهاب الي اعدادات التوظيف</a>
                    </div>
                    @elseif ( $data['steps']['USC'] == false )
                    <div class="alert alert-warning">
                        <strong>اعدادات التواصل</strong> برجاء الذهاب الي اعادات التواصل حتي يتمكن اصحاب الاعمال والوظائف بالتواصل معاك <a href="/settings/communication">الذهاب الي اعدادات التواصل</a>
                    </div>
                    @endif
                   
                    <div class="account-box">
                       <div class="btn-group pull-left">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu slidedown">
<!--
                                <li>
                                    <a href="#">
                                        <i class="fa fa-stop fa-fw"></i> ايقاف اعلانات الوظائف
                                    </a>
                                </li>
-->
                                <li>
                                    <a href="/settings/job">
                                        <i class="fa fa-cogs fa-fw"></i> الاعدادات
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="title">الوظائف المقترحة</div>
                        <div class="content jobs">
                            @if ( $data['jobs'] != false )
                            <div class="job-list">
                                @foreach ($data['jobs'] as $i)
                                <div class="job-box">
                                    <h2><a href="/job/show/{{ $i->job_id }}">{{ $i->title }}</a></h2>
                                    <p>
                                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> تاريخ النشر: {{ $i->created_at }}</span>
                                        <span><i class="fa fa-building" aria-hidden="true"></i> الشركة: <a hraf="{{ url('/') }}/{{ $i->companie_url }}">{{ $i->companie }}</a></span>
                                    </p>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')