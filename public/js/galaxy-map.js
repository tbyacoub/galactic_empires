/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("// When document has finished loading...\n$(document).ready(function() {\n\n\t// The ID of the selected solar system. Default to -1, which no system should have.\n\tvar selectedSystemID = -1;\n\n\t// The pixel width and height of the galaxy map image.\n\tvar galaxyMapWidth  = $('#galaxy-map-content-container').width();\n\tvar galaxyMapHeight = $('#galaxy-map-content-container').height();\n\t// The x and y position of the galaxy map image. Currently not used.\n\tvar galaxyXYPos = $('#galaxy-map-content-container').offset();\n\n\t// The container for the solar system icons.\n\tvar iconsContainer = $('#galaxy-overlay-innter-container');\n\n\t// For each solar system...\n\t$.each(solarSystems, function(key, system)\n\t{\n\t\t// Get the solar system's id, name, and location (x, y).\n\t\tvar systemName = system['name'];\n\t\tvar systemId = system['id'];\n\t\tvar systemLocation = JSON.parse(system['location']);\n\n\t\t// Generate the outer icon container.\n\t\tvar iconContainer = $('<div></div>', {\n\t\t\tclass: 'system-icon-container'\n\t\t});\n\n\t\t// Generate the inner icon container.\n\t\tvar iconInner = $('<div></div>', {\n\t\t\tclass: 'system-icon-inner-container'\n\t\t});\n\t\t// Add a click event to the outer icon container, which will populate the popup with the system's name and id.\n\t\ticonContainer.click(function() {OnSystemIconClick(systemId, systemName, $(this).offset().left, $(this).offset().top);});\n\n\t\t// Add the inner container to the outer container.\n\t\ticonContainer.append(iconInner);\n\n\t\t// Set the x/y-coordinate of the icon relative to the galaxy map.\n\t\t// I assume the max x and y coordinates are 1000.\n\t\tvar xPercent = systemLocation[0] / galaxyMapWidth * 100;\n\t\tvar yPercent = systemLocation[1] / galaxyMapHeight * 100;\n\n\t\t// Set the icon's position as percents. The icon is 16px wide so subtract 8px from the percent\n\t\t// to center the icon at its position.\n\t\ticonContainer.css({'left': 'calc(' + xPercent + \"% - 8px)\", 'top': 'calc(' + yPercent + '% - 8px'});\n\n\t\t// Add the icon to the icon container.\n\t\ticonsContainer.append(iconContainer);\n\t});\n\n\t// When the \"View System\" link is clicked, call the ViewSystemWithID() function with the selected ID.\n\t$('#go-to-system-link').click(function() {ViewSystemWithID(selectedSystemID);});\n\n\t// When the popup X-button is clicked, hide the popup.\n\t$('#popup-x-button').click(function() {$('#popup-container').hide();});\n\n\t/**\n\t * Populates, positions, and shows the popup box with a solar system's info.\n\t */\n\tfunction OnSystemIconClick(id, name, x, y)\n\t{\n\t\t// Change the currently selected system id.\n\t\tselectedSystemID = id;\n\n\t\t// Change the popup text to the system's name.\n\t\t$('#popup-system-name').text(name);\n\n\t\t// Show the popup, otherwise the outerWidth()/Height() will return 0.\n\t\t$('#popup-container').show();\n\n\t\t/*\n\t\t// This is code for dynamically positioning the popup near the selected system.\n\t\t// It currently does not work, so it is commented out.\n\n\t\t// Round the x and y of the clicked system icon, otherwise we get values like 113.111244652 pixels.\n\t\tvar iconX = Math.round(x);\n\t\tvar iconY = Math.round(y);\n\n\t\t// Get the width of the popup\n\t\tvar popupWidth = $('#popup-container').outerWidth();\n\t\tvar popupHeight = $('#popup-container').outerHeight();\n\n\t\tvar newPopupXPercent = iconX;\n\t\tvar newPopupYPercent = iconY;\n\n\t\t$('#popup-container').css({'left' : 0, 'top': 0});\n\n\t\tconsole.log((newPopupXPercent / 1000 * 100) + \": \" + (newPopupYPercent / 1000 * 100));\n\t\t*/\n\t}\n\n\t/**\n\t * Redirects user to the Empire-Overview page template with the system's info.\n\t */\n\tfunction ViewSystemWithID(id)\n\t{\n\t\tconsole.log(\"Viewing system with ID \" + id);\n\t}\n});\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2dhbGF4eS1tYXAuanM/OGZjYiJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBXaGVuIGRvY3VtZW50IGhhcyBmaW5pc2hlZCBsb2FkaW5nLi4uXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcblxuXHQvLyBUaGUgSUQgb2YgdGhlIHNlbGVjdGVkIHNvbGFyIHN5c3RlbS4gRGVmYXVsdCB0byAtMSwgd2hpY2ggbm8gc3lzdGVtIHNob3VsZCBoYXZlLlxuXHR2YXIgc2VsZWN0ZWRTeXN0ZW1JRCA9IC0xO1xuXG5cdC8vIFRoZSBwaXhlbCB3aWR0aCBhbmQgaGVpZ2h0IG9mIHRoZSBnYWxheHkgbWFwIGltYWdlLlxuXHR2YXIgZ2FsYXh5TWFwV2lkdGggID0gJCgnI2dhbGF4eS1tYXAtY29udGVudC1jb250YWluZXInKS53aWR0aCgpO1xuXHR2YXIgZ2FsYXh5TWFwSGVpZ2h0ID0gJCgnI2dhbGF4eS1tYXAtY29udGVudC1jb250YWluZXInKS5oZWlnaHQoKTtcblx0Ly8gVGhlIHggYW5kIHkgcG9zaXRpb24gb2YgdGhlIGdhbGF4eSBtYXAgaW1hZ2UuIEN1cnJlbnRseSBub3QgdXNlZC5cblx0dmFyIGdhbGF4eVhZUG9zID0gJCgnI2dhbGF4eS1tYXAtY29udGVudC1jb250YWluZXInKS5vZmZzZXQoKTtcblxuXHQvLyBUaGUgY29udGFpbmVyIGZvciB0aGUgc29sYXIgc3lzdGVtIGljb25zLlxuXHR2YXIgaWNvbnNDb250YWluZXIgPSAkKCcjZ2FsYXh5LW92ZXJsYXktaW5udGVyLWNvbnRhaW5lcicpO1xuXG5cdC8vIEZvciBlYWNoIHNvbGFyIHN5c3RlbS4uLlxuXHQkLmVhY2goc29sYXJTeXN0ZW1zLCBmdW5jdGlvbihrZXksIHN5c3RlbSlcblx0e1xuXHRcdC8vIEdldCB0aGUgc29sYXIgc3lzdGVtJ3MgaWQsIG5hbWUsIGFuZCBsb2NhdGlvbiAoeCwgeSkuXG5cdFx0dmFyIHN5c3RlbU5hbWUgPSBzeXN0ZW1bJ25hbWUnXTtcblx0XHR2YXIgc3lzdGVtSWQgPSBzeXN0ZW1bJ2lkJ107XG5cdFx0dmFyIHN5c3RlbUxvY2F0aW9uID0gSlNPTi5wYXJzZShzeXN0ZW1bJ2xvY2F0aW9uJ10pO1xuXG5cdFx0Ly8gR2VuZXJhdGUgdGhlIG91dGVyIGljb24gY29udGFpbmVyLlxuXHRcdHZhciBpY29uQ29udGFpbmVyID0gJCgnPGRpdj48L2Rpdj4nLCB7XG5cdFx0XHRjbGFzczogJ3N5c3RlbS1pY29uLWNvbnRhaW5lcidcblx0XHR9KTtcblxuXHRcdC8vIEdlbmVyYXRlIHRoZSBpbm5lciBpY29uIGNvbnRhaW5lci5cblx0XHR2YXIgaWNvbklubmVyID0gJCgnPGRpdj48L2Rpdj4nLCB7XG5cdFx0XHRjbGFzczogJ3N5c3RlbS1pY29uLWlubmVyLWNvbnRhaW5lcidcblx0XHR9KTtcblx0XHQvLyBBZGQgYSBjbGljayBldmVudCB0byB0aGUgb3V0ZXIgaWNvbiBjb250YWluZXIsIHdoaWNoIHdpbGwgcG9wdWxhdGUgdGhlIHBvcHVwIHdpdGggdGhlIHN5c3RlbSdzIG5hbWUgYW5kIGlkLlxuXHRcdGljb25Db250YWluZXIuY2xpY2soZnVuY3Rpb24oKSB7T25TeXN0ZW1JY29uQ2xpY2soc3lzdGVtSWQsIHN5c3RlbU5hbWUsICQodGhpcykub2Zmc2V0KCkubGVmdCwgJCh0aGlzKS5vZmZzZXQoKS50b3ApO30pO1xuXG5cdFx0Ly8gQWRkIHRoZSBpbm5lciBjb250YWluZXIgdG8gdGhlIG91dGVyIGNvbnRhaW5lci5cblx0XHRpY29uQ29udGFpbmVyLmFwcGVuZChpY29uSW5uZXIpO1xuXG5cdFx0Ly8gU2V0IHRoZSB4L3ktY29vcmRpbmF0ZSBvZiB0aGUgaWNvbiByZWxhdGl2ZSB0byB0aGUgZ2FsYXh5IG1hcC5cblx0XHQvLyBJIGFzc3VtZSB0aGUgbWF4IHggYW5kIHkgY29vcmRpbmF0ZXMgYXJlIDEwMDAuXG5cdFx0dmFyIHhQZXJjZW50ID0gc3lzdGVtTG9jYXRpb25bMF0gLyBnYWxheHlNYXBXaWR0aCAqIDEwMDtcblx0XHR2YXIgeVBlcmNlbnQgPSBzeXN0ZW1Mb2NhdGlvblsxXSAvIGdhbGF4eU1hcEhlaWdodCAqIDEwMDtcblxuXHRcdC8vIFNldCB0aGUgaWNvbidzIHBvc2l0aW9uIGFzIHBlcmNlbnRzLiBUaGUgaWNvbiBpcyAxNnB4IHdpZGUgc28gc3VidHJhY3QgOHB4IGZyb20gdGhlIHBlcmNlbnRcblx0XHQvLyB0byBjZW50ZXIgdGhlIGljb24gYXQgaXRzIHBvc2l0aW9uLlxuXHRcdGljb25Db250YWluZXIuY3NzKHsnbGVmdCc6ICdjYWxjKCcgKyB4UGVyY2VudCArIFwiJSAtIDhweClcIiwgJ3RvcCc6ICdjYWxjKCcgKyB5UGVyY2VudCArICclIC0gOHB4J30pO1xuXG5cdFx0Ly8gQWRkIHRoZSBpY29uIHRvIHRoZSBpY29uIGNvbnRhaW5lci5cblx0XHRpY29uc0NvbnRhaW5lci5hcHBlbmQoaWNvbkNvbnRhaW5lcik7XG5cdH0pO1xuXG5cdC8vIFdoZW4gdGhlIFwiVmlldyBTeXN0ZW1cIiBsaW5rIGlzIGNsaWNrZWQsIGNhbGwgdGhlIFZpZXdTeXN0ZW1XaXRoSUQoKSBmdW5jdGlvbiB3aXRoIHRoZSBzZWxlY3RlZCBJRC5cblx0JCgnI2dvLXRvLXN5c3RlbS1saW5rJykuY2xpY2soZnVuY3Rpb24oKSB7Vmlld1N5c3RlbVdpdGhJRChzZWxlY3RlZFN5c3RlbUlEKTt9KTtcblxuXHQvLyBXaGVuIHRoZSBwb3B1cCBYLWJ1dHRvbiBpcyBjbGlja2VkLCBoaWRlIHRoZSBwb3B1cC5cblx0JCgnI3BvcHVwLXgtYnV0dG9uJykuY2xpY2soZnVuY3Rpb24oKSB7JCgnI3BvcHVwLWNvbnRhaW5lcicpLmhpZGUoKTt9KTtcblxuXHQvKipcblx0ICogUG9wdWxhdGVzLCBwb3NpdGlvbnMsIGFuZCBzaG93cyB0aGUgcG9wdXAgYm94IHdpdGggYSBzb2xhciBzeXN0ZW0ncyBpbmZvLlxuXHQgKi9cblx0ZnVuY3Rpb24gT25TeXN0ZW1JY29uQ2xpY2soaWQsIG5hbWUsIHgsIHkpXG5cdHtcblx0XHQvLyBDaGFuZ2UgdGhlIGN1cnJlbnRseSBzZWxlY3RlZCBzeXN0ZW0gaWQuXG5cdFx0c2VsZWN0ZWRTeXN0ZW1JRCA9IGlkO1xuXG5cdFx0Ly8gQ2hhbmdlIHRoZSBwb3B1cCB0ZXh0IHRvIHRoZSBzeXN0ZW0ncyBuYW1lLlxuXHRcdCQoJyNwb3B1cC1zeXN0ZW0tbmFtZScpLnRleHQobmFtZSk7XG5cblx0XHQvLyBTaG93IHRoZSBwb3B1cCwgb3RoZXJ3aXNlIHRoZSBvdXRlcldpZHRoKCkvSGVpZ2h0KCkgd2lsbCByZXR1cm4gMC5cblx0XHQkKCcjcG9wdXAtY29udGFpbmVyJykuc2hvdygpO1xuXG5cdFx0Lypcblx0XHQvLyBUaGlzIGlzIGNvZGUgZm9yIGR5bmFtaWNhbGx5IHBvc2l0aW9uaW5nIHRoZSBwb3B1cCBuZWFyIHRoZSBzZWxlY3RlZCBzeXN0ZW0uXG5cdFx0Ly8gSXQgY3VycmVudGx5IGRvZXMgbm90IHdvcmssIHNvIGl0IGlzIGNvbW1lbnRlZCBvdXQuXG5cblx0XHQvLyBSb3VuZCB0aGUgeCBhbmQgeSBvZiB0aGUgY2xpY2tlZCBzeXN0ZW0gaWNvbiwgb3RoZXJ3aXNlIHdlIGdldCB2YWx1ZXMgbGlrZSAxMTMuMTExMjQ0NjUyIHBpeGVscy5cblx0XHR2YXIgaWNvblggPSBNYXRoLnJvdW5kKHgpO1xuXHRcdHZhciBpY29uWSA9IE1hdGgucm91bmQoeSk7XG5cblx0XHQvLyBHZXQgdGhlIHdpZHRoIG9mIHRoZSBwb3B1cFxuXHRcdHZhciBwb3B1cFdpZHRoID0gJCgnI3BvcHVwLWNvbnRhaW5lcicpLm91dGVyV2lkdGgoKTtcblx0XHR2YXIgcG9wdXBIZWlnaHQgPSAkKCcjcG9wdXAtY29udGFpbmVyJykub3V0ZXJIZWlnaHQoKTtcblxuXHRcdHZhciBuZXdQb3B1cFhQZXJjZW50ID0gaWNvblg7XG5cdFx0dmFyIG5ld1BvcHVwWVBlcmNlbnQgPSBpY29uWTtcblxuXHRcdCQoJyNwb3B1cC1jb250YWluZXInKS5jc3MoeydsZWZ0JyA6IDAsICd0b3AnOiAwfSk7XG5cblx0XHRjb25zb2xlLmxvZygobmV3UG9wdXBYUGVyY2VudCAvIDEwMDAgKiAxMDApICsgXCI6IFwiICsgKG5ld1BvcHVwWVBlcmNlbnQgLyAxMDAwICogMTAwKSk7XG5cdFx0Ki9cblx0fVxuXG5cdC8qKlxuXHQgKiBSZWRpcmVjdHMgdXNlciB0byB0aGUgRW1waXJlLU92ZXJ2aWV3IHBhZ2UgdGVtcGxhdGUgd2l0aCB0aGUgc3lzdGVtJ3MgaW5mby5cblx0ICovXG5cdGZ1bmN0aW9uIFZpZXdTeXN0ZW1XaXRoSUQoaWQpXG5cdHtcblx0XHRjb25zb2xlLmxvZyhcIlZpZXdpbmcgc3lzdGVtIHdpdGggSUQgXCIgKyBpZCk7XG5cdH1cbn0pO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvZ2FsYXh5LW1hcC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7OztBQUlBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBb0JBO0FBQ0E7Ozs7QUFJQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);