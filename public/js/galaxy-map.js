// When document has finished loading...
$(document).ready(function() {
	
	// The ID of the selected solar system. Default to -1, which no system should have.
	var selectedSystemID = -1;
	
	// The pixel width and height of the galaxy map image.
	var galaxyMapWidth  = $('#galaxy-map-content-container').width();
	var galaxyMapHeight = $('#galaxy-map-content-container').height();
	// The x and y position of the galaxy map image. Currently not used.
	var galaxyXYPos = $('#galaxy-map-content-container').offset();
	
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
		
		// Generate the inner icon container.
		var iconInner = $('<div></div>', {
			class: 'system-icon-inner-container'
		});
		// Add a click event to the outer icon container, which will populate the popup with the system's name and id.
		iconContainer.click(function() {OnSystemIconClick(systemId, systemName, $(this).offset().left, $(this).offset().top);});
		
		// Add the inner container to the outer container.
		iconContainer.append(iconInner);
		
		// Set the x/y-coordinate of the icon relative to the galaxy map.
		// I assume the max x and y coordinates are 1000.
		var xPercent = systemLocation[0] / galaxyMapWidth * 100;
		var yPercent = systemLocation[1] / galaxyMapHeight * 100;
		
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
		
		/*
		// This is code for dynamically positioning the popup near the selected system.
		// It currently does not work, so it is commented out.
		
		// Round the x and y of the clicked system icon, otherwise we get values like 113.111244652 pixels.
		var iconX = Math.round(x);
		var iconY = Math.round(y);
		
		// Get the width of the popup
		var popupWidth = $('#popup-container').outerWidth();
		var popupHeight = $('#popup-container').outerHeight();
		
		var newPopupXPercent = iconX;
		var newPopupYPercent = iconY;
		
		$('#popup-container').css({'left' : 0, 'top': 0});
		
		console.log((newPopupXPercent / 1000 * 100) + ": " + (newPopupYPercent / 1000 * 100));
		*/
	}
	
	/**
	 * Redirects user to the Empire-Overview page template with the system's info.
	 */
	function ViewSystemWithID(id)
	{
		window.location.href = ('/galaxy-map/' + id);
	}
});
