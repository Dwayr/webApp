@include('includes.header')
<body ng-controller="project">
    <section class="project" ng-init="editGetData({{ $data['project']->id }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title"><i class="fa fa-briefcase" aria-hidden="true"></i> اضافة مشروع جديد</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="komicho-input-group">
                                <label>اسم المشروع</label>
                                <input ng-model="projectAdd.title" ng-init="projectAdd.title='{{ $data['project']->title }}'"/>
                                <input type="hidden" ng-model="projectAdd.id" ng-init="projectAdd.id='{{ $data['project']->id }}'"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="komicho-input-group">
                                <label>الشركة</label>
                                <select ng-model="projectAdd.co_id" ng-init="projectAdd.co_id='{{ $data['project']['companies'][0]->id }}'">
                                    <option value="">اختيار اسم الشركة</option>
                                    @foreach ($data['user']['mycompanie'] as $i)
                                    <option value="{{ $i->id }}">{{ $i->name }}</option>
                                    @endforeach
                                </select>
                                <span class="slogan">قائمة الشركات التابعة لك</span>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="komicho-input-group">
                                <label>وصف المشروع</label>
                                <textarea rows="9" ng-model="projectAdd.about" ng-init="projectAdd.about='{{ $data['project']->about }}'"></textarea>
                            </div>
                        </div>
                           
                        <div class="col-md-12">
                            <div class="komicho-input-group">
                                <label>فريق المشروع</label>
                                <tags-input ng-model="tags">
                                  <auto-complete source="loadItems($query)" template="/public/tag/tag.html"></auto-complete>
                                </tags-input>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="komicho-input-group">
                                <button ng-click="edit('{{ $data['project']->icon }}')">حفظ تعديلات المشروع</button>
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
                    <img ng-hide="returnUpload" style="width: 100%;height: auto;" src="{{ url('/') }}/public/uploads/photos/{{ $data['project']->icon }}">
                    <img ng-show="returnUpload" style="width: 100%;height: auto;" src="{{ url('/') }}/public/uploads/photos/{% returnUpload %}">
                </div>
            </div>
        </div>
    </section>
</body>
@include('includes.footer')