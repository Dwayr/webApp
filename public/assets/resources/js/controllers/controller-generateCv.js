app.controller('generateCv', function($scope,$http) {
    
    $("#skills").tagsinput();
    
    $( "#skills" ).change(function() {
        $("#skills_input").val($("#skills").val());
    });
     
    $scope.getLocation = function()
    {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position){
                $.get('http://maps.googleapis.com/maps/api/geocode/json?latlng=' + position.coords.latitude + ',' + position.coords.longitude + '&sensor=true', function(data){
                    console.log(data.results[0].formatted_address);
                    $scope.generateCv.address = data.results[0].formatted_address;
                });
            });
        }
    }
    
    
});