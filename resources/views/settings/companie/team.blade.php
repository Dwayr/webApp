@include('includes.header')
<body ng-controller="settings">
    <section class="settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/info" class="list-group-item"><i class="fa fa-info" aria-hidden="true"></i> المعلومات الاساسية</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/projects" class="list-group-item"><i class="fa fa-cubes" aria-hidden="true"></i> المشاريع</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/team" class="list-group-item active"><i class="fa fa-users" aria-hidden="true"></i> الفريق</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/jobs" class="list-group-item"><i class="fa fa-briefcase" aria-hidden="true"></i> الوظائف</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="projects">
                            <div class="title"> فريق العمل
                            <div class="btn-group pull-left">
                                <button ng-click="addToTeam()" type="button" class="btn btn-default btn-xs dropdown-toggle">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            </div>
                            
                            <div class="row" ng-show="_addToTeam">
                                <input type="hidden" ng-model="coAddTeam.companie_id" ng-init="coAddTeam.companie_id='{{ $data['companie']->id }}'">
                                <div class="col-md-4">
                                    <div class="komicho-input-group">
                                        <label>معرف المستخدم</label>
                                        <input ng-model="coAddTeam.user_public_code">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="komicho-input-group">
                                        <label>المسمى الوظيفي</label>
                                        <input ng-model="coAddTeam.user_position">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="komicho-input-group">
                                        <label>تاريخ بداء العمل</label>
                                        <input data-datepicker="{theme: 'flat', dateformat: 'YYYY-MM-DD'}" ng-model="coAddTeam.work_start_history">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="komicho-input-group">
                                        <button id="loadinged" ng-click="AddTeam()">اضافة العضو</button>
                                        <img id="loading" class="ajaxloading" src="/assets/resources/img/loading.svg">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">فريق العمل</div>

    <!-- Table -->
    <table class="table">
        <thead>
        <tr>
            <td>اسم المستخدم</td>
            <td>المسمى الوظيفي</td>
            <td>فتره العمل</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
           @foreach ($data['team'] as $i)
            <tr>
                <td>{{ $i->username }}</td>
                <td>{{ $i->job_title }}</td>
                <td>من {{ $i->start_history }} @if( $i->end_history == $i->start_history ) حتي الان @else الي {{ $i->end_history }} @endif</td>
                <td>
                    <button type="button" class="btn btn-danger btn-xs">Danger</button>
                </td>
            </tr>
            @endforeach
        </tbody>
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