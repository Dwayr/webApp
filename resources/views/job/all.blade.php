@include('includes.header')
<body ng-controller="job">
    <section class="job">
        <h1>معرض الوظائف</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="job-list" ng-init="listJob()">
                        <div class="job-box" ng-repeat="i in list | filter:search">
                            <h2><a href="/job/show/{% i.job_id %}">{% i.title %}</a></h2>
                            <p>
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> تاريخ النشر: {% i.created_at %}</span>
                                <span><i class="fa fa-building" aria-hidden="true"></i> الشركة: <a hraf="#">{% i.companie %}</a></span>
                                <span><i class="fa fa-briefcase" aria-hidden="true"></i> نوع العمل:
                         
                                    <span>{% i.type_work %}</span>
                                    
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="filters">
                        <div class="title"><i class="fa fa-filter" aria-hidden="true"></i> تصفية البيانات</div>
                        
                        <div class="komicho-input-group">
                            <label>بحث</label>
                            <input ng-model='search.title'/>
                            <span class="slogan">بحث بعنوان الوظيفة</span>
                        </div>

                        <div class="komicho-input-group">
                            <label>وقت العمل</label>
                            <select ng-model='search.type_work'>
                                <option value="">عرض الجميع</option>
                                @foreach ($data['options']['type_job'] as $i)
                                <option value="{{ $i->option_text }}">{{ $i->option_text }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="komicho-input-group">
                            <label>نوع الجنس</label>
                            <select ng-model='search.gender'>
                                <option value="">عرض الجميع</option>
                                <option value="1">ذكر</option>
                                <option value="2">انثي</option>
                                <option value="3">ذكر او انثي</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')