$('#show-password').click(function () {
    $(this).children().toggleClass('bi bi-eye-fill bi bi-eye-slash-fill');
    let input = $(this).prev();
    input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
});
