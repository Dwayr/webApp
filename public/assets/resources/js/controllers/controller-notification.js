app.controller('notification', function($scope,$http) {
      
    $scope.isRead = function(id)
    {
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/notification/is_read',
            data: $.param({
                id : id
            }),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            console.log(res.data);
        });
    }
    
});