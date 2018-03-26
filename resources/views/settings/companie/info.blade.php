@include('includes.header')
<body ng-controller="settings">
    <section class="settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/info" class="list-group-item active"><i class="fa fa-info" aria-hidden="true"></i> المعلومات الاساسية</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/projects" class="list-group-item"><i class="fa fa-cubes" aria-hidden="true"></i> المشاريع</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/team" class="list-group-item"><i class="fa fa-users" aria-hidden="true"></i> الفريق</a>
                            <a href="/settings/companies/dashboard/{{ $data['companie']->url }}/jobs" class="list-group-item"><i class="fa fa-briefcase" aria-hidden="true"></i> الوظائف</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="setting">
                            <div class="title">المعلومات الاساسية</div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>اسم الشركة</label>
                                                <input ng-model="companieInfo.name"  ng-init="companieInfo.name='{{ $data['companie']->name }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>عنوان الرابط</label>
                                                <input ng-model="companieInfo.url"  ng-init="companieInfo.url='{{ $data['companie']->url }}'"/>
                                                <input type="hidden" ng-model="companieInfo.seturl"  ng-init="companieInfo.seturl='{{ $data['companie']->url }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>الموقع الاكتروني</label>
                                                <input ng-model="companieInfo.site"  ng-init="companieInfo.site='{{ $data['companie']->site }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>البريد الاكتروني</label>
                                                <input ng-model="companieInfo.email"  ng-init="companieInfo.email='{{ $data['companie']->email }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>التخصص</label>
                                                <input ng-model="companieInfo.specialization"  ng-init="companieInfo.specialization='{{ $data['companie']->specialization }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>المقر</label>
                                                <input ng-model="companieInfo.headquarters"  ng-init="companieInfo.headquarters='{{ $data['companie']->headquarters }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>التخصص</label>
                                                <input ng-model="companieInfo.specialization"  ng-init="companieInfo.specialization='{{ $data['companie']->specialization }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>سنة التاسيس</label>
                                                <input ng-model="companieInfo.establishment"  ng-init="companieInfo.establishment='{{ $data['companie']->establishment }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="komicho-input-group">
                                                <label>الوصف</label>
                                                <textarea rows="7" ui-tinymce="tinymceOptions" ng-model="companieInfo.about" ng-init="companieInfo.about='{{ $data['companie']->about }}'"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="komicho-input-group">
                                                <button id="loadinged" ng-click="companieEditInfo('{{ $data['companie']->logo }}')">حفظ المعلومات</button>
                                                <img id="loading" class="ajaxloading" src="/assets/resources/img/loading.svg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="komicho-input-group">
                                        <label for="f">شعار الشركة</label>
                                        <input id="file_imguser" type="file" class="logoup-input form-control input-lg" file-model="file">
                                        <label class="logoup-label" for="file_imguser">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            <span>تغير شعار الشركة</span>
                                        </label>
                                    </div>
                                    <img ng-hide="returnUpload" style="width: 100%;height: auto;" src="{{ url('/') }}/public/uploads/photos/{{ $data['companie']->logo }}">
                                    <img ng-show="returnUpload" style="width: 100%;height: auto;" src="{{ url('/') }}/public/uploads/photos/{% returnUpload %}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
@include('includes.footer')