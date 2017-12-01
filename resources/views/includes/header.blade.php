<html ng-app="app" dir="rtl">
    <head>
        <title>{{ $header_title }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="pwa/manifest.json">
        @if( MIN )
        <link rel="stylesheet" href="{{ url('/') }}/assets/dist/css/all.css">
        @else
        <link rel="stylesheet" href="{{ url('/') }}/assets/resources/imports.css">
        <link rel="stylesheet" href="{{ url('/') }}/assets/resources/styles.css">
        <link rel="stylesheet" href="{{ url('/') }}/assets/components/angular/input_tag/ng-tags-input.css">
        <link rel="stylesheet" href="{{ url('/') }}/assets/components/angular/datepicker/datepicker.css">
        <link rel="stylesheet" href="{{ url('/') }}/assets/components/tagsinput/bootstrap-tagsinput.css">
        <link rel="stylesheet" href="{{ url('/') }}/assets/components/angular/v_accordion/v-accordion.css">
        @endif
        <link rel="shortcut icon" type="image/png" href="{{ url('/') }}/favicon.png"/>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108819187-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-108819187-1');
        </script>

    </head>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
<!--          <a class="navbar-brand" href="#"><i class="fa fa-building" aria-hidden="true"></i></a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i> الرئيسية</a></li>
                @if ( $session == true )
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cubes" aria-hidden="true"></i> المشاريع <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="/project/add"><i class="fa fa-plus" aria-hidden="true"></i> اضافة مشروع جديد</a></li>
                    </ul>
                </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i> الوظائف <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="/job"><i class="fa fa-bars" aria-hidden="true"></i> عرض كل الوظائف</a></li>
                    @if ( $session == true )
                    <li role="separator" class="divider"></li>
                    <li><a href="/job/add"><i class="fa fa-plus" aria-hidden="true"></i> اضافة وظيفة</a></li>
                    @endif
                    </ul>
                </li>
            </ul>
            @if ( $session == true )
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        @if ( $data['header']['notification']['exist'] ) <i style="position: absolute;color: #e74c3c;" class="fa fa-circle" aria-hidden="true"></i> @endif
                        <i class="fa fa-bell fa-fw"></i>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        @if ( !$data['header']['notification']['exist'] )
                        <p></p>
                        <p class="text-center">لا يوجد اي اشعارات جديدة</p>
                        <p></p>
                        <li class="divider"></li>
                        @endif
                        @foreach ($data['header']['notification']['list'] as $i)
                        <li>
                            <a href="/notification/{{ $i['id'] }}">
                                <div>
                                    {{ $i['username'] }} {{ $i['type'] }} {{ $i['content'] }}
                                    <span class="pull-left text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        @endforeach
                        <li>
                            <a class="text-center" href="#">
                                <strong>اطلع على جميع التنبيهات</strong>
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
            </ul>
            @endif
            <ul class="nav navbar-nav navbar-left">
                @if ( $session == true )
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> الحساب <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="right: auto;left: 0;">
                    <li><a href="/settings"><i class="fa fa-cogs" aria-hidden="true"></i> اعدادت الحساب</a></li>
                    <li role="separator" class="divider"></li>
                    @foreach ($data['user']['mycompanie'] as $i)
                    <li><a href="/settings/companies/dashboard/{{ $i->url }}/info"><img style="width: 31px; height: 31px;" src="/companie/logo/{{ $i->url }}"> {{ $i->name }}</a></li>
                    @endforeach
                    <li><a href="/companie/add"><img style="width: 31px; height: 31px;" src="/assets/resources/img/plus.svg"> اضافة شركة جديدة</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/signout"><i class="fa fa-sign-out" aria-hidden="true"></i> تسجيل الخروج</a></li>
                    </ul>
                </li>
                @else
                <li><a href="/sign-up"><i class="fa fa-user-plus" aria-hidden="true"></i> تسجيل حساب</a></li>
                <li><a href="/sign-in"><i class="fa fa-sign-in" aria-hidden="true"></i> تسجيل دخول</a></li>
            @endif
            </ul>
        </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>