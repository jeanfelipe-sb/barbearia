$(document).ready(function () {

    $("#myCarousel").Carousel({
        afterUpdate: function () {
            updateSize();
        },
        afterInit:function(){
            updateSize();
        }
    });
    function updateSize(){
        var minHeight=parseInt($('.carousel-inner>item').eq(0).css('height'));
        $('.carousel-inner>item').each(function () {
            var thisHeight = parseInt($(this).css('height'));
            minHeight=(minHeight<=thisHeight?minHeight:thisHeight);
        });
        $('.owl-wrapper-outer').css('height',minHeight+'px');
    }
});