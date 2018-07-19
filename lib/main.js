$('#menu-navegacao').find('a').click(function(){

var the_id = $(this).attr("href");

    $('html, body').animate({
        scrollTop:$(the_id).offset().top
    }, 1000);

return false;});

 $('input.maxlength').maxlength({
    alwaysShow: true,
    threshold: 10,
    warningClass: "label label-success",
    limitReachedClass: "label label-danger"
});
