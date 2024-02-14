let nav = $('#navbar').offset().top;
let backTop = $('#toTopBtn');
$(window).bind('scroll', function () {
    if  ($(window).scrollTop() >= nav)  {
        backTop.addClass('top-btn-show');
    } else {
        backTop.removeClass('top-btn-show');
    }
});
$('#toTopBtn').click(function(){
    $(document).scrollTop(0);
})
