$(document).ready(function() {
	
	var galaxyMapWidth  = $('#galaxy-map-content-container').width();
	var galaxyMapHeight = $('#galaxy-map-content-container').height();
	
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
		
		iconContainer.click(function() {OnSystemIconClick(systemId, systemName);});
		
		iconContainer.append(iconInner);
		
		var xPercent = systemLocation[0] / galaxyMapWidth * 100;
		var yPercent = systemLocation[1] / galaxyMapHeight * 100;
		
		iconContainer.css({'left': 'calc(' + xPercent + "% - 8px)", 'top': 'calc(' + yPercent + '% - 8px'});
		
		iconsContainer.append(iconContainer);
	});
	
	function OnSystemIconClick(id, name)
	{
		console.log("System " + id + ":" + name + " was clicked.");
	}
});