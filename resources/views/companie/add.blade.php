@include('includes.header')
<body ng-controller="companie">
    <section class="companie-add">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title"><i class="fa fa-briefcase" aria-hidden="true"></i> اضافة شركة جديده</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="komicho-input-group">
                                <label>اسم الشركة</label>
                                <input ng-model="companieInfo.name"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="komicho-input-group">
                                <label>الاسم المستعار</label>
                                <input ng-model="companieInfo.url"/>
                                <p class="help-block">مثل : dwayr.com/example</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="komicho-input-group">
                                <label>الموقع الكتروني</label>
                                <input ng-model="companieInfo.site"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="komicho-input-group">
                                <label>البريد الاكتروني الكتروني</label>
                                <input ng-model="companieInfo.email"/>
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="komicho-input-group">
                                <label>التخصص</label>
                                <input ng-model="companieInfo.specialization"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="komicho-input-group">
                                <label>المقر</label>
                                <input ng-model="companieInfo.headquarters"/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="komicho-input-group">
                                <label>التاسيس</label>
                                <input ng-model="companieInfo.establishment"/>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="komicho-input-group">
                                <label>عن الشركة</label>
                                <textarea rows="9" ui-tinymce="tinymceOptions" ng-model="companieInfo.about"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="komicho-input-group">
                                <button id="loadinged" ng-click="add()">اضافة شركتك</button>
                                <img id="loading" class="ajaxloading" src="/assets/resources/img/loading.svg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="f">شعار الشركة</label>
                        <input id="file_imguser" type="file" class="logoup-input form-control input-lg" file-model="file">
                        <label class="logoup-label" for="file_imguser">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span ng-hide="returnUpload">رفع شعار الشركة</span>
                            <span ng-show="returnUpload">تغير شعار الشركة</span>
                        </label>
                    </div>
                    <img ng-show="returnUpload" style="width: 100%;height: auto;" src="{{ url('/') }}/public/uploads/photos/{% returnUpload %}">
                </div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')