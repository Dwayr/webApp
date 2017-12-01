app.controller('settings', function($scope, $http, fileUpload) {
    
    $("#file_imguser").on('change',function(){
        setTimeout(function(){
            fileUpload.uploadFileToUrl(URLPASE + '/upload', $scope.file, function(data){
                $scope.returnUpload = data.data.data;
            });
        }, 100);
    });
    
    $("#skills").tagsinput();
    
    $scope.userEditInfo = function()
    {
        loading();
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/user/edit_info',
            data: $.param($scope.userEdit),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
    
    $scope.userEditPassword = function()
    {
        loading();
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/user/edit_password',
            data: $.param($scope.password),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
    
    $scope.userSettingJob = function()
    {
        loading();
        $scope.settingJob.skills = $("#skills").val();
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/user/setting_job',
            data: $.param($scope.settingJob),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
    
    $scope.userSettingCommunication = function()
    {
        loading();
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/user/setting_communication',
            data: $.param($scope.settingCommunication),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
    
    $scope.companieEditInfo = function(logo)
    {
        loading();
        if ( $scope.returnUpload ) {
            $scope.companieInfo.logo = $scope.returnUpload;
        } else {
            $scope.companieInfo.logo = logo;
        }
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/companie/settings/edit',
            data: $.param($scope.companieInfo),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
    

    $scope.addToTeam = function(){
        $scope._addToTeam = true;
    }
    $scope.AddTeam = function()
    {
        loading();
        console.log($scope.coAddTeam);
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/companie/settings/team/add',
            data: $.param($scope.coAddTeam),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
    
    $scope.applyFunction = function(id)
    {
        console.log($scope.coAddTeam);
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/companie/settings/jobs/apply',
            data: $.param({
                id : id
            }),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
        });
    }
    
    $scope.cancelFunction = function(id)
    {
        console.log($scope.coAddTeam);
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/companie/settings/jobs/cancel',
            data: $.param({
                id : id
            }),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
        });
    }
    
});