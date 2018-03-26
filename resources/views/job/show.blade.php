@include('includes.header')
<body ng-controller="job">
    <section class="job show">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title"><i class="fa fa-briefcase" aria-hidden="true"></i> {{ $data['job']->title }}</div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>{{ $data['job']->city }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        <span>{{ $data['job']->type_work }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        @if ( $data['job']->average_salary == 1 )
                        <span>لم يحدد بعد</span>
                        @else
                        <span>{{ $data['job']->average_salary }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="description">{!! $data['job']->description !!}</div>
                    @if ( $data['is_owner'] == false )
                    <button class="apply" ng-click="apply('{{ $data['job']->id }}')"> تقدم للوظيفة </button>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="info">
                        <p><i class="fa fa-venus-mars" aria-hidden="true"></i> الجنس :
                         @if ($data['job']->gender == 1)
                        <span>ذكر</span>
                        @elseif ($data['job']->gender == 2)
                        <span>اونثي</span>
                        @elseif ($data['job']->gender == 3)
                        <span>ذكر او انثي</span>
                        @endif
                        </p>
                        <p><i class="fa fa-cogs" aria-hidden="true"></i> عدد سنين الخبره : {{ $data['job']->years_experience }}</p>
                        <p><i class="fa fa-building" aria-hidden="true"></i> الشركة المعلنة : <a href="/{{ $data['job']->companie_url }}">{{ $data['job']->companie }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')