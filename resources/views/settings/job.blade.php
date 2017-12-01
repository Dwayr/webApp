@include('includes.header')
<body ng-controller="settings">
    <section class="settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="/settings/info" class="list-group-item"><i class="fa fa-info" aria-hidden="true"></i> المعلومات الشخصية</a>
                            <a href="/settings/job" class="list-group-item active"><i class="fa fa-briefcase" aria-hidden="true"></i> اعدادات التوظيف</a>
                            <a href="/settings/communication" class="list-group-item"><i class="fa fa-comments" aria-hidden="true"></i> اعدادات لتواصل</a>
                            <a href="/settings/password" class="list-group-item"><i class="fa fa-key" aria-hidden="true"></i> كلمة المرور</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="setting">
                            <div class="title">الحساب</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="komicho-input-group">
                                        <label>المدينة</label>
                                        <select ng-model="settingJob.city" ng-init="settingJob.city='{{ $data['setting_job']['city'] }}'" class="ng-pristine ng-valid ng-empty ng-touched">
                                            <option value="">اختيار المدينة</option>
                                            @foreach ($data['options']['cities'] as $i)
                                            <option value="{{ $i->option_value }}">{{ $i->option_text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="komicho-input-group">
                                        <label>نوع الوظيفة</label>
                                        <select ng-model="settingJob.type_work" ng-init="settingJob.type_work='{{ $data['setting_job']['type_work'] }}'" class="ng-pristine ng-valid ng-empty ng-touched">
                                            <option value="">اختيار نوع الدوام</option>
                                            @foreach ($data['options']['type_job'] as $i)
                                            <option value="{{ $i->option_value }}">{{ $i->option_text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="komicho-input-group">
                                        <label>مهراتك</label>
                                        <select id="skills" multiple>
                                            @foreach ($data['setting_job']['skills'] as $i)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="komicho-input-group">
                                        <button id="loadinged" ng-click="userSettingJob()">حفظ</button>
                                        <img id="loading" class="ajaxloading" src="/assets/resources/img/loading.svg">
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