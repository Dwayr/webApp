@include('includes.header')
<body ng-controller="settings">
    <section class="settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/info" class="list-group-item"><i class="fa fa-info" aria-hidden="true"></i> المعلومات الاساسية</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/projects" class="list-group-item active"><i class="fa fa-cubes" aria-hidden="true"></i> المشاريع</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/team" class="list-group-item"><i class="fa fa-users" aria-hidden="true"></i> الفريق</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/jobs" class="list-group-item"><i class="fa fa-briefcase" aria-hidden="true"></i> الوظائف</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="projects">
                            <div class="title"> المشاريع
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="/project/add">
                                            <i class="fa fa-plus" aria-hidden="true"></i> اضافة المشروع
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            </div>
                            
                            <div class="row">
                               @foreach ($data['projects'] as $i)
                                <div class="col-md-4">
                                    <div class="project">
                                        <div class="btn-group pull-left">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-chevron-down"></i>
                                            </button>
                                            <ul class="dropdown-menu slidedown">
                                                <li>
                                                    <a href="/project/edit/{{ $i->id }}">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> تعديل المشروع
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/project/show/{{ $i->id }}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> عرض المشروع
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                        <img src="http://dwayr.dev/project/logo/{{ $i->id }}" />
                                        <h2>{{ $i->title }}</h2>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
@include('includes.footer')