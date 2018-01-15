app.controller('job', function($scope, $http) {
    
    $("#skills").tagsinput();
    
    $scope.tinymceOptions = {
        plugins: 'link lists',
        toolbar: 'undo redo | bold italic | numlist bullist | alignleft aligncenter alignright | link',
    };
    
    $scope.listJob = function()
    {
        $http({
            method : 'get',
            url : URLPASE + '/ajax/job/list',
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            $scope.list = res.data;
        });
    }
    
    $scope.add = function()
    {
        loading();
        $scope.jobAd.skills = $("#skills").val();
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/job/add',
            data: $.param($scope.jobAd),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
            loadinged();
        });
    }
    
    $scope.apply = function(id)
    {
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/job/apply',
            data: $.param({'id':id}),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
        });
    }
});