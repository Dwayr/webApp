app.controller('companie', function($scope, $http, fileUpload) {
    
    $("#file_imguser").on('change',function(){
        setTimeout(function(){
            fileUpload.uploadFileToUrl(URLPASE + '/upload', $scope.file, function(data){
                $scope.returnUpload = data.data.data;
            });
        }, 100);
    });

    $scope.add = function()
    {
        loading();
        if ( !$scope.companieInfo ) {
            $scope.companieInfo = {};
        } else {
            $scope.companieInfo = $scope.companieInfo;
        }
        $scope.companieInfo.logo = $scope.returnUpload;
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/companie/add',
            data: $.param($scope.companieInfo),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
});