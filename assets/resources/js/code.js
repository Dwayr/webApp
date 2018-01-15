//$(window).scroll(function () { 
//if ($(window).scrollTop() > 550) {
//$('nav').addClass('navbar-fixed');
//}
//if ($(window).scrollTop() < 551) {
//$('nav').removeClass('navbar-fixed');
//}
//});
//
//
//
//$( document ).ready(function() {
//    var box_home = $('section.vh > .layer').height();
//    var box_home_content = $('section.vh > .layer .content').height();
//    var total = (box_home - box_home_content)/2;
//    console.log(box_home, box_home_content, total);
//    $('section.vh > .layer').css({
//        'padding-top' : total
//    });
//});
//
//
//
//window.ityped.init(document.querySelector('.ityped'), {
//    typeSpeed : 111,
//    strings : ['نعمل علي التطوير من اجل استخدام افضل', 'كومتشو'],
//    loop : true
//});

var goTO = function (url)
{
    location.href = url;
}