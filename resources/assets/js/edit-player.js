$(document).ready(function() {
    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            function getCookie(name) {
                var cookieValue = null;
                if (document.cookie && document.cookie != '') {
                    var cookies = document.cookie.split(';');
                    for (var i = 0; i < cookies.length; i++) {
                        var cookie = jQuery.trim(cookies[i]);
                        // Does this cookie string begin with the name we want?
                        if (cookie.substring(0, name.length + 1) == (name + '=')) {
                            cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                            break;
                        }
                    }
                }
                return cookieValue;
            }
            if (!(/^http:.*/.test(settings.url) || /^https:.*/.test(settings.url))) {
                // Only send the token to relative URLs i.e. locally.
                xhr.setRequestHeader("X-CSRFToken", getCookie('csrftoken'));
            }
        }
    });

    var add_metal = $('.add-metal');
    var add_crystal = $('.add-crystal');
    var add_energy = $('.add-energy');
    var subtract_metal = $('.subtract-metal');
    var subtract_crystal = $('.subtract-crystal');
    var subtract_energy = $('.subtract-energy');


    $(add_metal).click(function () {
        var planet_id = $(this).data('planet-id');

        request(planet_id,true, 1000, 0);
    });

    $(add_crystal).click(function () {
        var planet_id = $(this).data('planet-id');

        request(planet_id,true, 1000, 1);
    });

    $(add_energy).click(function () {
        var planet_id = $(this).data('planet-id');

        request(planet_id,true, 1000, 2);
    });

    $(subtract_metal).click(function () {
        var planet_id = $(this).data('planet-id');

        request(planet_id,false, 1000, 0);
    });

    $(subtract_crystal).click(function () {
        var planet_id = $(this).data('planet-id');

        request(planet_id,false, 1000, 1);
    });

    $(subtract_energy).click(function () {
        var planet_id = $(this).data('planet-id');

        request(planet_id,false, 1000, 2);
    });

    function request(planet_id, add, qty, type) {
        $.ajax({
            type: "POST",
            url: '/admin/edit-player/modify-resource/'+planet_id,
            data: {
                _token :  $('meta[name="csrf-token"]').attr('content'),
                add : add,
                quantity : qty,
                type : type,
            },
            success: function (data) {
                console.log(data);
            }
        });
    }



});