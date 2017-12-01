@include('includes.header')
<body ng-controller="settings">
    <section class="settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="/settings/info" class="list-group-item"><i class="fa fa-info" aria-hidden="true"></i> المعلومات الشخصية</a>
                            <a href="/settings/job" class="list-group-item"><i class="fa fa-briefcase" aria-hidden="true"></i> اعدادات التوظيف</a>
                            <a href="/settings/communication" class="list-group-item active"><i class="fa fa-comments" aria-hidden="true"></i> اعدادات لتواصل</a>
                            <a href="/settings/password" class="list-group-item"><i class="fa fa-key" aria-hidden="true"></i> كلمة المرور</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="setting">
                            <div class="title">الحساب</div>
                            <div class="row">
                               
                                <div class="col-md-7">
                                    <div class="komicho-input-group">
                                        <label>البريد الالكتروني</label>
                                        <input type="text" ng-model="settingCommunication.email" ng-init="settingCommunication.email='{{ $data['setting_communication']['email'] }}'">
                                    </div>
                                </div>
                                
                                <div class="col-md-7">
                                    <div class="komicho-input-group">
                                        <label>رقم الهاتف</label>
                                        <input type="text" ng-model="settingCommunication.phone_number" ng-init="settingCommunication.phone_number='{{ $data['setting_communication']['phone_number'] }}'">
                                    </div>
                                </div>
                                
                                <div class="col-md-7">
                                    <div class="komicho-input-group">
                                        <label>رابط حساب GitHub</label>
                                        <input type="text" ng-model="settingCommunication.github_link" ng-init="settingCommunication.github_link='{{ $data['setting_communication']['github_link'] }}'">
                                    </div>
                                </div>
                                
                                <div class="col-md-7">
                                    <div class="komicho-input-group">
                                        <label>رابط حساب Facebook</label>
                                        <input type="text" ng-model="settingCommunication.facebook_link" ng-init="settingCommunication.facebook_link='{{ $data['setting_communication']['facebook_link'] }}'">
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
                                    <div class="komicho-input-group">
                                        <button id="loadinged" ng-click="userSettingCommunication()">حفظ</button>
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