@include('includes.header')
<body>
    <section class="companie-show">
        <div class="content-show">
            show
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="datas">

                        <div class="data about">
                            <div class="title"><i class="fa fa-bullhorn" aria-hidden="true"></i> عن الشركة</div>
                            <p>{!! $data->about !!}</p>
                        </div>

                        <div class="data projects">
                            <div class="title"><i class="fa fa-wrench" aria-hidden="true"></i> مشاريع</div>
                            <div class="row">
@foreach ($data['projects'] as $i)
                                <div class="col-md-4">
                                    <div class="project">
                                        <img src="{{ url('/') }}/project/logo/{{ $i->id }}">
                                        <b>{{ $i->title }}</b>
                                    </div>
                                </div>
@endforeach
                            </div>
                        </div>
                        <div class="data team">
                            <div class="title"><i class="fa fa-users" aria-hidden="true"></i> الفريق</div>
                            <div class="row">
@foreach ($data['team'] as $i)
                                <div class="col-md-4">
                                    <div class="member">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                <img class="media-object" src="/user/avatar/{{ $i->username }}" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $i->username }}</h4>
                                                <p>web devolber</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
@endforeach
                            </div>
                        </div>

                        @if( true == false )
                        <div class="data rsses">
                            <div class="title"><i class="fa fa-rss" aria-hidden="true"></i> الاحداث</div>
                            @foreach ($data['rss'] as $i)
                            <div class="rss">
                                <div class="rss-title">{{ $i->title }}</div>
                                <div class="rss-body">{{ mb_substr($i->content, 0, 150) }}...</div>
                                <div class="rss-show">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget info">
                        <img src="companie/logo/{{ $data['url'] }}">
                        <h2>{{ $data['name'] }}</h2>
                        <div class="infos">
                            <p><b><i class="fa fa-globe" aria-hidden="true"></i> موقع الكتروني</b><span><a href="{{ $data['site'] }}">{{ $data['host'] }}</a></span></p>
                            <p><b><i class="fa fa-tag" aria-hidden="true"></i> التخصص</b><span>{{ $data['specialization'] }}</span></p>
                            <p><b><i class="fa fa-map-marker" aria-hidden="true"></i> المقر</b><span>{{ $data['headquarters'] }}</span></p>
                            <p><b><i class="fa fa-cogs" aria-hidden="true"></i> التاسيس</b><span>{{ $data['establishment'] }}</span></p>
                        </div>
                    </div>
                    
                    @if( true == false )
                    <div class="widget rating">
                        <div class="title">تقيم فريق العمل</div>
                        <div class="ratingbar">
                            <div class="rating-progress {{ $data['reat_text']  }}" style="width: {{ $data['reat_percent'] }}%">
                            @if ($data['reat_text']  == 'zero')
                                لم يتم تسجيل اي تقيم     
                            @endif
                            </div>
                        </div>
                        @if ($data['reat_text']  != 'zero')
                        <div class="value">
                            <span>{{ $data['reat_percent'] }}%</span>
                            @if ($data['reat_text']  == 'Bad')
                            <i class="fa fa-frown-o {{ $data['reat_text']  }}" aria-hidden="true"></i>
                            @elseif ($data['reat_text']  == 'Mediocre' || $data['reat_text']  == 'Good')
                            <i class="fa fa-meh-o {{ $data['reat_text']  }}" aria-hidden="true"></i>
                            @elseif ($data['reat_text']  == 'VGood' || $data['reat_text']  == 'Excellent')
                            <i class="fa fa-smile-o {{ $data['reat_text']  }}" aria-hidden="true"></i>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endif
                    
                    <div class="widget jobs">
                        <div class="title">الوظائف المتاحة</div>
                        @if ( $data['jobs'] != '[]' )
                        <div class="list-group">
                            @foreach ($data['jobs'] as $i)
                            <a href="/job/show/{{ $i->id }}" class="list-group-item">{{ $i->title }}</a>
                            @endforeach
                        </div>
                        @else
                            <div class="empty">لايوجد وظائف متاحه الان</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')