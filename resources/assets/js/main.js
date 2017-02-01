// Script for toggling active class on li items in

$(".nav li").on("click", function() {
    console.log(this);
    $(".nav li").removeClass("active");
    $(this).addClass("active");
});