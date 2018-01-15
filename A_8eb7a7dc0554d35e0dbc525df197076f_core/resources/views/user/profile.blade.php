@include('includes.header')
<body ng-controller="user">
    <section class="user-show">
        <div class="info">
            <img src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $data['profile']->email ) ) ) }}?s=500">
            <h3>{{ $data['profile']->first_name }} {{ $data['profile']->last_name }} @if ( $data['profile']->user_verify == 1 )<i class="fa fa-check-circle" aria-hidden="true"></i>@endif </h3>
            <span>{{ $data['profile']->username.'@' }}</span>
        </div>
        <div class="data">
            @if ( $data['profile']->is_activated == 2 )
            <center><h1>الحساب معطل</h1></center>
            @else
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="#showInfo" ng-click="showInfo()" class="list-group-item" ng-class="{'active': _showInfo == true}">الملف الشخصي</a>
                            <a href="#showProjects" ng-click="showProjects()" class="list-group-item" ng-class="{'active': _showProjects == true}">معرض المشاريع</a>
                            <a href="#showCompanies" ng-click="showCompanies()" class="list-group-item" ng-class="{'active': _showCompanies == true}">الشركات</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="box" ng-show="_showInfo" id="showInfo">
                            <div class="title"><i class="fa fa-user-circle" aria-hidden="true"></i> نبذة عني</div>
                            <div class="content">{{ $data['profile']->about }}</div>
                        </div>

                        <div class="box" ng-show="_showProjects" id="showProjects">
                            <div class="title"><i class="fa fa-cubes" aria-hidden="true"></i> المشاريع</div>
                            <div class="content">
                                <div class="projects">
                                    <div class="row">
                                        @foreach ($data['profile']['projects'] as $i)
                                        <div class="col-md-4">
                                            <div class="project">
                                                <img src="{{ url('/') }}/project/logo/{{ $i->id }}">
                                                <b><a href="/project/show/{{ $i->id }}">{{ $i->title }}</a></b>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box" ng-show="_showCompanies" id="showCompanies">
                            <div class="title"><i class="fa fa-briefcase" aria-hidden="true"></i> الشركات</div>
                            <div class="content">
                                <div class="companies">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @foreach ($data['profile']['companie'] as $i)
                                           <div class="companie">
                                                
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <img class="media-object" src="{{ url('/') }}/companie/logo/{{ $i->url }}" alt="...">
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="/{{ $i->url }}">{{ $i->name }}</a></h4>
                                                            <p>NOV 2017 - MAR - 2019</p>
                                                        </div>
                                                    </div>
                                               
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!--
                    <div class="col-md-4">
                        <div class="box">
                            <div class="title"><i class="fa fa-info-circle" aria-hidden="true"></i> المعلومات الساسية</div>
                            <div class="content">محتوي</div>
                        </div>
                    </div>
-->
                </div>
            </div>
            @endif
        </div>
    </section>
</body>
@include('includes.footer')