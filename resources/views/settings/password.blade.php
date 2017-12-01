@include('includes.header')
<body ng-controller="settings">
    <section class="settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="/settings/info" class="list-group-item"><i class="fa fa-info" aria-hidden="true"></i> المعلومات الشخصية</a>
                            <a href="/settings/job" class="list-group-item"><i class="fa fa-briefcase" aria-hidden="true"></i> اعدادات التوظيف</a>
                            <a href="/settings/communication" class="list-group-item"><i class="fa fa-comments" aria-hidden="true"></i> اعدادات لتواصل</a>
                            <a href="/settings/password" class="list-group-item active"><i class="fa fa-key" aria-hidden="true"></i> كلمة المرور</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="setting">
                            <div class="title">الحساب</div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                       
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>كلمة المرور القديمة</label>
                                                <input type="password" ng-model="password.password" ng-init="password.password=''"/>
                                            </div>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                        
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>كلمة المرور الجديدة</label>
                                                <input type="password" ng-model="password.newpassword" ng-init="password.newpassword=''"/>
                                            </div>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                        
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>كلمة المرور الجديدة مره اخري</label>
                                                <input type="password" ng-model="password.renewpassword" ng-init="password.renewpassword=''"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="komicho-input-group">
                                                <button id="loadinged" ng-click="userEditPassword()">حفظ كلمة المرور</button>
                                                <img id="loading" class="ajaxloading" src="/assets/resources/img/loading.svg">
                                            </div>
                                        </div>
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