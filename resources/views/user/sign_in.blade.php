@include('includes.header')
<body  ng-controller="user">
    <section class="sign">
        <div class="login">
            <div class="komicho-input-group">
                <label>البريد الالكترواني</label>
                <input ng-model="signInData.email" ng-init="signInData.email=''"/>
            </div>
            <div class="komicho-input-group">
                <label>كلمة المرور</label>
                <input type="password" ng-model="signInData.password" ng-init="signInData.password=''"/>
            </div>
            <div class="komicho-input-group">
                <button ng-click="signIn()">تسجيل دخول</button>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')