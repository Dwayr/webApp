@include('includes.header')
<body>
    <section class="job">
        <h1>معرض الوظائف</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="job-list">
                        @foreach ($list as $i)
                        <div class="job-box">
                            <h2><a href="/job/show/{{ $i->job_id }}">{{ $i->title }}</a></h2>
                            <p>
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> تاريخ النشر: {{ $i->created_at }}</span>
                                <span><i class="fa fa-building" aria-hidden="true"></i> الشركة: <a hraf="#">{{ $i->companie }}</a></span>
                                <span><i class="fa fa-briefcase" aria-hidden="true"></i> نوع العمل:
                                    @if ($i->type_work == 1)
                                    <span>دوام كامل</span>
                                    @elseif ($i->type_work == 2)
                                    <span>دوام جزئى</span>
                                    @elseif ($i->type_work == 3)
                                    <span>الاستعانة بمصادر خارجية</span>
                                    @endif
                                </span>
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="com-md-3"></div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')