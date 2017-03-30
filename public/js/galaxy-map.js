// When document has finished loading...
$(document).ready(function() {

    // The ID of the selected solar system. Default to -1, which no system should have.
    var selectedSystemID = -1;

    // The container for the solar system icons.
    var iconsContainer = $('#galaxy-overlay-innter-container');

    // For each solar system...
    $.each(solarSystems, function(key, system)
    {
        // Get the solar system's id, name, and location (x, y).
        var systemName = system['name'];
        var systemId = system['id'];
        var systemLocation = system['location'];

        // Generate the outer icon container.
        var iconContainer = $('<div></div>', {
            class: 'system-icon-container'
        });

        var iconInner = null;
        for(var i = 0; i < mySolarSystems.length; i++) {
            if(mySolarSystems[i].solar_system.id == systemId){
                // Generate the inner icon container.
                iconInner = $('<div></div>', {
                    class: 'system-icon-inner-container-my'
                });
            }
        }

        if(iconInner == null) {
            // Generate the inner icon container.
            iconInner = $('<div></div>', {
                class: 'system-icon-inner-container'
            });
        }
        // Add a click event to the outer icon container, which will populate the popup with the system's name and id.
        iconContainer.click(function() {OnSystemIconClick(systemId, systemName, $(this).position().left, $(this).position().top);});

        // Add the inner container to the outer container.
        iconContainer.append(iconInner);

        // Set the x/y-coordinate of the icon relative to the galaxy map.
        // The galaxy algorithm assumes the x-max and y-max are 1000. It generates coordinates around the (0, 0) point,
        // so we must move to the center (add 500) and divide by the width/height to get the percent.
        var xPercent = (systemLocation[0] + 500) / 1000 * 100;
        var yPercent = (systemLocation[1] + 500) / 1000 * 100;

        // Set the icon's position as percents. The icon is 16px wide so subtract 8px from the percent
        // to center the icon at its position.
        iconContainer.css({'left': 'calc(' + xPercent + "% - 8px)", 'top': 'calc(' + yPercent + '% - 8px'});

        // Add the icon to the icon container.
        iconsContainer.append(iconContainer);
    });

    // When the "View System" link is clicked, call the ViewSystemWithID() function with the selected ID.
    $('#go-to-system-link').click(function() {ViewSystemWithID(selectedSystemID);});

    // When the popup X-button is clicked, hide the popup.
    $('#popup-x-button').click(function() {$('#popup-container').hide();});

    /**
     * Populates, positions, and shows the popup box with a solar system's info.
     */
    function OnSystemIconClick(id, name, x, y)
    {
        // Change the currently selected system id.
        selectedSystemID = id;

        // Change the popup text to the system's name.
        $('#popup-system-name').text(name);

        // Show the popup, otherwise the outerWidth()/Height() will return 0.
        $('#popup-container').show();

        // Round the x and y of the clicked system icon, otherwise we get values like 113.111244652 pixels.
        var iconX = Math.round(x) + 4;
        var iconY = Math.round(y);

        var galaxyMapW = $('#galaxy-map-content-container').width();
        var galaxyMapH = $('#galaxy-map-content-container').height();

        // Get the width of the popup
        var popupWidth = $('#popup-container').outerWidth();
        var popupHeight = $('#popup-container').outerHeight();

        var newPopupXPercent = (iconX - popupWidth / 2) / galaxyMapW * 100;
        var newPopupYPercent = (iconY - popupHeight - 5) / galaxyMapH * 100;

        $('#popup-container').css({'left' : newPopupXPercent + '%', 'top': newPopupYPercent + '%'});
    }

    /**
     * Redirects user to the Empire-Overview page template with the system's info.
     */
    function ViewSystemWithID(id)
    {
        window.location.href = ('/solar-systems/' + id);
    }
});