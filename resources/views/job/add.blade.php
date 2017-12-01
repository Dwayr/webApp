@include('includes.header')
<body ng-controller="job">
    <section class="job">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title"><i class="fa fa-briefcase" aria-hidden="true"></i> اضافة اعلان جديد</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="komicho-input-group">
                                <label>عنوان الاعلان</label>
                                <input ng-model="jobAd.title"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="komicho-input-group">
                                <label>المدينة</label>
                                <select ng-model="jobAd.city" ng-init="jobAd.city=''">
                                    <option value="">اختيار المدينة</option>
                                    @foreach ($data['options']['cities'] as $i)
                                    <option value="{{ $i->option_value }}">{{ $i->option_text }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="komicho-input-group">
                                <label>الشركة</label>
                                <select ng-model="jobAd.co_id" ng-init="jobAd.co_id=''">
                                    <option value="">اختيار اسم الشركة</option>
                                    @foreach ($data['list_co'] as $i)
                                    <option value="{{ $i->id }}">{{ $i->name }}</option>
                                    @endforeach
                                </select>
                                <span class="slogan">قائمة الشركات التابعة لك</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="komicho-input-group">
                                <label>سنين الخبرة المطلوبة</label>
                                <input ng-model="jobAd.years_experience"/>
                                <span class="slogan">يمكنك تحديد اقل عدد سنين خبرة مطلوبة</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="komicho-input-group">
                                <label>متوسط الراتب</label>
                                <input ng-model="jobAd.average_salary"/>
                                <span class="slogan">1 = لم يحدد بعد</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="komicho-input-group">
                                <label>النوع</label>
                                <select ng-model="jobAd.gender" ng-init="jobAd.gender=''">
                                    <option value="">اختيار النوع</option>
                                    <option value="1">ذكر</option>
                                    <option value="2">انثي</option>
                                    <option value="3">ذكر او انثي</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="komicho-input-group">
                                <label>نوع الوظيفة</label>
                                <select ng-model="jobAd.type_work" ng-init="jobAd.type_work=''">
                                    <option value="">اختيار نوع الدوام</option>
                                    @foreach ($data['options']['type_job'] as $i)
                                    <option value="{{ $i->option_value }}">{{ $i->option_text }}</option>
                                    @endforeach
<!--
                                    <option value="1">full time</option>
                                    <option value="2">part time</option>
                                    <option value="3">outsource</option>
-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="komicho-input-group">
                                <label>وصف الوظيفة</label>
                                <textarea rows="9" ui-tinymce="tinymceOptions" ng-model="jobAd.description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="komicho-input-group">
                                <label>مهراتك</label>
<!--                                <input id="skills" ng-model="jobAd.skills">-->
                                <select id="skills" multiple></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="komicho-input-group">
                                <button id="loadinged" ng-click="add()">نشر الاعلان</button>
                                <img id="loading" class="ajaxloading" src="/assets/resources/img/loading.svg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="com-md-3"></div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')