app.controller('user', function($scope,$http) {
    
    $scope.urlHash = window.location.hash.substr(1);
    
    $scope._showInfo = true;
    $scope._showProjects = false;
    $scope._showCompanies = false;
    $scope.showInfo = function()
    {
        $scope._showInfo = true;
        $scope._showProjects = false;
        $scope._showCompanies = false;
    }
    $scope.showProjects = function()
    {
        $scope._showInfo = false;
        $scope._showProjects = true;
        $scope._showCompanies = false;
    }
    $scope.showCompanies = function()
    {
        $scope._showInfo = false;
        $scope._showProjects = false;
        $scope._showCompanies = true;
    }
    
    if ( $scope.urlHash == 'showInfo' ) {
        $scope.showInfo();
    } else if ( $scope.urlHash == 'showProjects' ) {
        $scope.showProjects();
    } else if ( $scope.urlHash == 'showCompanies' ) {
        $scope.showCompanies();
    } else {
        $scope.showInfo();
    }
    
    $scope.signUp = function()
    {
        console.log($scope.signUpData);
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/user/sign_up',
            data: $.param($scope.signUpData),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            console.log(res.data);
            makeAlert(res.data);
        });
    }
    
    $scope.signIn = function()
    {
        console.log($scope.signInData);
        $http({
            method : 'POST',
            url : URLPASE + '/ajax/user/sign_in',
            data: $.param($scope.signInData),
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function(res) {
            makeAlert(res.data);
        });
    }
    
});