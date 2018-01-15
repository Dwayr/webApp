angular.module("komicho",[])
.directive('fileModel', ['$parse', function ($parse) {
    return {
    restrict: 'A',
    link: function(scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
        });
    }
   };
}])
// We can write our own fileUpload service to reuse it in the controller
.service('fileUpload',function ($http) {
    this.uploadFileToUrl = function(urlTo, file, callback){
         var fd = new FormData();
         fd.append('file', file);
 
         $http.post(urlTo, fd, {
             transformRequest: angular.identity,
             headers: {'Content-Type': undefined,'Process-Data': false}
         }).then(function(response) {
             
             callback(response.data);
            
        });
     }
 });