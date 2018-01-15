app.controller('project', function($scope, $http, fileUpload) {
    
    $("#file_imguser").on('change',function(){
        setTimeout(function(){
            fileUpload.uploadFileToUrl(URLPASE + '/upload', $scope.file, function(data){
                $scope.returnUpload = data.data.data;
            });
        }, 100);
    });
    
//    $scope.tags = [{"username":"komicho","text":"komicho"}];
    $scope.loadItems = function(query) {
        var res = $http.get('/project/tag/team/' + query);
        return res;
    };
    
    $scope.add = function()
    {
        loading();
        $scope.projectAdd.icon = $scope.returnUpload;
        $scope.projectAdd.team = $scope.tags;
        console.log($scope.projectAdd);
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/project/add',
            data: $.param($scope.projectAdd),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
    
    $scope.editGetData = function(id)
    {
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/project/edit/data',
            data: $.param({'id':id}),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            $scope.tags = res.data;
        });
    }
    
    $scope.edit = function(icon)
    {
        if ( $scope.returnUpload ) {
            $scope.projectAdd.icon = $scope.returnUpload;
        } else {
            $scope.projectAdd.icon = icon;
        }
        $scope.projectAdd.team = $scope.tags;
        console.log($scope.projectAdd);
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/project/edit',
            data: $.param($scope.projectAdd),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
        });
    }
    
});