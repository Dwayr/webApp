@include('includes.header')
<body ng-controller="user">
    <section class="sign">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="komicho-input-group">
                                    <label>الاسم الاول</label>
                                    <input ng-model="signUpData.first_name" ng-init="signUpData.first_name=''"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="komicho-input-group">
                                    <label>الاسم الثاني</label>
                                    <input ng-model="signUpData.last_name"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="komicho-input-group">
                                    <label>اسم المستخدم</label>
                                    <input ng-model="signUpData.username"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="komicho-input-group">
                                    <label>البريد الالكتروني</label>
                                    <input ng-model="signUpData.email"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="komicho-input-group">
                                    <label>كلمة المرور</label>
                                    <input type="password" ng-model="signUpData.password"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="komicho-input-group">
                                    <label>كلمة المرور مره اخري</label>
                                    <input type="password" ng-model="signUpData.repassword"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="komicho-input-group">
                                    <button ng-click="signUp()">تسجيل الحساب</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="datails">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <h2>تسجيل مستخدم جديد</h2>
                        <ol>
                            <li>جميع المعلومات الحساسة تكون سرية</li>
                            <li>بتسجيل عضوية في تطبيق دوائر يمكنك من المميزات الي يقدمة التطبيق</li>
                            <li>بعد تسحيل البيانات برجاء الذهاب الي بريد الالكتروني لتفعيل جميع مميزات التطبيق وحتي يمكنك التاكد بان هذا الحساب هو لك انت</li>
                            <li>تاكيد حساب يمكنك في المستقبل من الاسترجاء مره اخري</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')