$(document).ready(function() {
	
	var selectedSystemID = -1;
	
	var galaxyMapWidth  = $('#galaxy-map-content-container').width();
	var galaxyMapHeight = $('#galaxy-map-content-container').height();
	var galaxyXYPos = $('#galaxy-map-content-container').offset();
	
	var iconsContainer = $('#galaxy-overlay-innter-container');
	
	$.each(solarSystems, function(key, system)
	{
		var systemName = system['name'];
		var systemId = system['id'];
		var systemLocation = JSON.parse(system['location']);
		
		var iconContainer = $('<div></div>', {
			class: 'system-icon-container'
		});
		
		var iconInner = $('<div></div>', {
			class: 'system-icon-inner-container'
		});
		
		iconContainer.click(function() {OnSystemIconClick(systemId, systemName, $(this).offset().left, $(this).offset().top);});
		
		iconContainer.append(iconInner);
		
		var xPercent = systemLocation[0] / galaxyMapWidth * 100;
		var yPercent = systemLocation[1] / galaxyMapHeight * 100;
		
		iconContainer.css({'left': 'calc(' + xPercent + "% - 8px)", 'top': 'calc(' + yPercent + '% - 8px'});
		
		iconsContainer.append(iconContainer);
	});
	
	$('#go-to-system-link').click(function() {ViewSystemWithID(selectedSystemID);});
	
	$('#popup-x-button').click(function() {$('#popup-container').hide();});
	
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
	
	function ViewSystemWithID(id)
	{
		console.log("Viewing system with ID " + id);
	}
});