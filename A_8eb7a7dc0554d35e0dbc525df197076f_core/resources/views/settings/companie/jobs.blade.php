@include('includes.header')
<body ng-controller="settings">
    <section class="settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/info" class="list-group-item"><i class="fa fa-info" aria-hidden="true"></i> المعلومات الاساسية</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/projects" class="list-group-item"><i class="fa fa-cubes" aria-hidden="true"></i> المشاريع</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/team" class="list-group-item"><i class="fa fa-users" aria-hidden="true"></i> الفريق</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/jobs" class="list-group-item active"><i class="fa fa-briefcase" aria-hidden="true"></i> الوظائف</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="projects">
                            <div class="title"> الوظائف
                            <div class="btn-group pull-left">
                                <button onclick="goTo('/job/add')" type="button" class="btn btn-default btn-xs dropdown-toggle">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">قائمة الوظائف</div>

    <!-- Table -->
    <table class="table">
       @foreach ($data['jobs'] as $i)
        <tr>
            <td><a href="/job/show/{{ $i->id }}">{{ $i->title }}</a></td>
            <td width="27%">
                <button type="button" class="btn btn-primary btn-xs" ng-click="applyFunction('{{ $i->id }}')"><i class="fa fa-check" aria-hidden="true"></i> تم التوظيف</button>
                <button type="button" class="btn btn-danger btn-xs" ng-click="cancelFunction('{{ $i->id }}')"><i class="fa fa-ban" aria-hidden="true"></i> الغاء الوظيفة</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
@include('includes.footer')