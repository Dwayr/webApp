@include('includes.header')
<body ng-controller="generateCv">
    <section class="generate_cv">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    @if(session()->has('success'))
                    <div class="alert dw-alert alert-success">
                        <a href="#" class="alert-link">نجاح</a> {{ session()->get('success') }}.
                    </div>
                    @endif
                    @if(session()->has('warning'))
                    <div class="alert dw-alert alert-warning">
                        <a href="#" class="alert-link">تحذير</a> {{ session()->get('warning') }}.
                    </div>
                    @endif
                    @if(session()->has('danger'))
                    <div class="alert dw-alert alert-danger">
                        <a href="#" class="alert-link">خطر</a> {{ session()->get('danger') }}.
                    </div>
                    @endif
                    <form action="/cv_post" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>
                            <legend>المعلومات الشخصية</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="komicho-input-group">
                                        <label>الاسم بالكامل</label>
                                        <input name="fullname" value="{{ old('fullname') }}" ng-model="generateCv.fullname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="komicho-input-group">
                                        <label>تاريخ الميلاد</label>
                                        <input name="dateBirth" ng-model="generateCv.dateBirth">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="komicho-input-group">
                                        <label>العنوان</label>
                                        <input name="address" ng-model="generateCv.address">
    <!--                                    <p></p>-->
    <!--                                    <p><button type="button" ng-click="getLocation()" class="btn btn-default btn-xs">تحديد موقعك</button></p>-->
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>معلومات التواصل</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="komicho-input-group">
                                        <label>رقم الهاتف</label>
                                        <input name="phone" ng-model="generateCv.phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="komicho-input-group">
                                        <label>البريد الاكتروني</label>
                                        <input name="email" ng-model="generateCv.email">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="komicho-input-group">
                                        <label>رابط حساب github</label>
                                        <input name="githublink" ng-model="generateCv.githublink">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="komicho-input-group">
                                        <label>رابط حساب linkedin</label>
                                        <input name="linkedinlink" ng-model="generateCv.linkedinlink">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>المهمارات</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="komicho-input-group">
                                        <label>ادخل المهارات الخاصة بك</label>
                                        <select id="skills" multiple>
                                            <option value="php">php</option>
                                        </select>
                                        <input name="skills" type="hidden" id="skills_input">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>المرفقات</legend>
                            <div class="attachments">
                                <div class="komicho-input-group">
                                    <label>رفع السيره الذاتية</label>
                                    <input type="file" name="attachment">
                                </div>
                            </div>
                        </fieldset>

                        <div class="komicho-input-group">
                            <button type="submit">الرسال المعلومات</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')