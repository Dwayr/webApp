@include('includes.header')
<body ng-controller="settings">
    <section class="settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="/settings/info" class="list-group-item active"><i class="fa fa-info" aria-hidden="true"></i> المعلومات الشخصية</a>
                            <a href="/settings/job" class="list-group-item"><i class="fa fa-briefcase" aria-hidden="true"></i> اعدادات التوظيف</a>
                            <a href="/settings/communication" class="list-group-item"><i class="fa fa-comments" aria-hidden="true"></i> اعدادات لتواصل</a>
                            <a href="/settings/password" class="list-group-item"><i class="fa fa-key" aria-hidden="true"></i> كلمة المرور</a>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-9">
                        <div class="setting">
                            <div class="title">الحساب</div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>اسم المستخدم</label>
                                                <input readonly="readonly" value="{{ $data['user']->username }}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>المعرف الخاص بك</label>
                                                <input readonly="readonly" value="{{ $data['user']->public_code }}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>الاسم الاول</label>
                                                <input ng-model="userEdit.first_name"  ng-init="userEdit.first_name='{{ $data['user']->first_name }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>الاسم الثاني</label>
                                                <input ng-model="userEdit.last_name"  ng-init="userEdit.last_name='{{ $data['user']->last_name }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>البريد الالكتروني</label>
                                                <input ng-model="userEdit.email"  ng-init="userEdit.email='{{ $data['user']->email }}'"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="komicho-input-group">
                                                <label>البلد</label>
                                                <select ng-model="userEdit.country_code"  ng-init="userEdit.country_code='{{ $data['user']->country_code }}'">
                                                    <option value="">اختيار البلد</option>
                                                    <option value="EG">مصر</option>
                                                    <option value="DZ">الجزائر</option>
                                                    <option value="SD">السودان</option>
                                                    <option value="IQ">العراق</option>
                                                    <option value="MA">المغرب</option>
                                                    <option value="SA">السعودية</option>
                                                    <option value="YE">اليمن</option>
                                                    <option value="SY">سوريا</option>
                                                    <option value="TN">تونس</option>
                                                    <option value="SO">الصومال</option>
                                                    <option value="JO">الأردن</option>
                                                    <option value="AE">الإمارات العربية المتحدة</option>
                                                    <option value="LY">ليبيا</option>
                                                    <option value="PS">فلسطين</option>
                                                    <option value="LB">لبنان</option>
                                                    <option value="OM">عمان</option>
                                                    <option value="KW">الكويت</option>
                                                    <option value="MR">موريتانيا</option>
                                                    <option value="QA">قطر</option>
                                                    <option value="BH">البحرين</option>
                                                    <option value="DJ">جيبوتي</option>
                                                    <option value="KM">جزر القمر</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="komicho-input-group">
                                                <label>وصف عنك</label>
                                                <textarea rows="7" ng-model="userEdit.about" ng-init="userEdit.about='{{ $data['user']->about }}'"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="komicho-input-group">
                                                <button id="loadinged" ng-click="userEditInfo()">حفظ المعلومات</button>
                                                <img id="loading" class="ajaxloading" src="/assets/resources/img/loading.svg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img class="me" src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $data['user']->email ) ) ) }}?s=500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
@include('includes.footer')