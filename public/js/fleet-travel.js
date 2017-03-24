$(document).ready(function () {
    var from_travels = $('.from-travel-pb');
    var to_travels = $('.to-travel-pb');

    var from_interval = window.setInterval(function(){ updateTravelBars(from_travels);}, 1000);
    var to_interval = window.setInterval(function(){ updateTravelBars(to_travels);}, 1000);

    function updateTravelBars(travels) {
       $.each(travels, function (index, value) {
            var travel_rate = $(value).data('rate');
            var width_ratio = parseFloat($(value).parent().width()) / 100;
            var width = parseFloat($(value).data('width'));

            var update = (width_ratio * travel_rate) + width;

            $(value).data('width', update);
            $(value).css('width', update +"%");
       })
    }

});