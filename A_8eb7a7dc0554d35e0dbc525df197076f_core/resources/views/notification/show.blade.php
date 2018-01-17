@include('includes.header')
<body ng-controller="notification">
    <section class="notification" ng-init="isRead('{{ $data['notification']['id'] }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    @if ( $data['notification']['typeView'] == 'JOBAPPLY' )
                    <div class="show">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        <p>{{ $data['notification']['username'] }} {{ $data['notification']['type'] }} {{ $data['notification']['content'] }}</p>
                        <button onclick="goTo('/{{ $data['notification']['username'] }}')" type="button" class="btn btn-info">عرض الملف الشخصي</button>
                    </div>
                    @endif
                    
                    @if ( $data['notification']['typeView'] == 'ADDTOTEAM' )
                    <div class="show">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <p>{{ $data['notification']['type'] }} {{ $data['notification']['content'] }}</p>
                        <button onclick="goTo('/notification/toteamdone/{{ $data['notification']['id'] }}')" type="button" class="btn btn-info">موافقة علي الاضافة</button>
                        <button onclick="goTo('/notification/toteamclose/{{ $data['notification']['id'] }}')" type="button" class="btn btn-info">الفاء الاضافة</button>
                    </div>
                    @endif
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')