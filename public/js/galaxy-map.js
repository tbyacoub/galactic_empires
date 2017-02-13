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

eval("// When document has finished loading...\r\n$(document).ready(function() {\r\n\t\r\n\t// The ID of the selected solar system. Default to -1, which no system should have.\r\n\tvar selectedSystemID = -1;\r\n\t\r\n\t// The pixel width and height of the galaxy map image.\r\n\tvar galaxyMapWidth  = $('#galaxy-map-content-container').width();\r\n\tvar galaxyMapHeight = $('#galaxy-map-content-container').height();\r\n\t// The x and y position of the galaxy map image. Currently not used.\r\n\tvar galaxyXYPos = $('#galaxy-map-content-container').offset();\r\n\t\r\n\t// The container for the solar system icons.\r\n\tvar iconsContainer = $('#galaxy-overlay-innter-container');\r\n\t\r\n\t// For each solar system...\r\n\t$.each(solarSystems, function(key, system)\r\n\t{\r\n\t\t// Get the solar system's id, name, and location (x, y).\r\n\t\tvar systemName = system['name'];\r\n\t\tvar systemId = system['id'];\r\n\t\tvar systemLocation = JSON.parse(system['location']);\r\n\t\t\r\n\t\t// Generate the outer icon container.\r\n\t\tvar iconContainer = $('<div></div>', {\r\n\t\t\tclass: 'system-icon-container'\r\n\t\t});\r\n\t\t\r\n\t\t// Generate the inner icon container.\r\n\t\tvar iconInner = $('<div></div>', {\r\n\t\t\tclass: 'system-icon-inner-container'\r\n\t\t});\r\n\t\t// Add a click event to the outer icon container, which will populate the popup with the system's name and id.\r\n\t\ticonContainer.click(function() {OnSystemIconClick(systemId, systemName, $(this).offset().left, $(this).offset().top);});\r\n\t\t\r\n\t\t// Add the inner container to the outer container.\r\n\t\ticonContainer.append(iconInner);\r\n\t\t\r\n\t\t// Set the x/y-coordinate of the icon relative to the galaxy map.\r\n\t\t// I assume the max x and y coordinates are 1000.\r\n\t\tvar xPercent = systemLocation[0] / galaxyMapWidth * 100;\r\n\t\tvar yPercent = systemLocation[1] / galaxyMapHeight * 100;\r\n\t\t\r\n\t\t// Set the icon's position as percents. The icon is 16px wide so subtract 8px from the percent\r\n\t\t// to center the icon at its position.\r\n\t\ticonContainer.css({'left': 'calc(' + xPercent + \"% - 8px)\", 'top': 'calc(' + yPercent + '% - 8px'});\r\n\t\t\r\n\t\t// Add the icon to the icon container.\r\n\t\ticonsContainer.append(iconContainer);\r\n\t});\r\n\t\r\n\t// When the \"View System\" link is clicked, call the ViewSystemWithID() function with the selected ID.\r\n\t$('#go-to-system-link').click(function() {ViewSystemWithID(selectedSystemID);});\r\n\t\r\n\t// When the popup X-button is clicked, hide the popup.\r\n\t$('#popup-x-button').click(function() {$('#popup-container').hide();});\r\n\t\r\n\t/**\r\n\t * Populates, positions, and shows the popup box with a solar system's info.\r\n\t */\r\n\tfunction OnSystemIconClick(id, name, x, y)\r\n\t{\r\n\t\t// Change the currently selected system id.\r\n\t\tselectedSystemID = id;\r\n\t\t\r\n\t\t// Change the popup text to the system's name.\r\n\t\t$('#popup-system-name').text(name);\r\n\t\t\r\n\t\t// Show the popup, otherwise the outerWidth()/Height() will return 0.\r\n\t\t$('#popup-container').show();\r\n\t\t\r\n\t\t/*\r\n\t\t// This is code for dynamically positioning the popup near the selected system.\r\n\t\t// It currently does not work, so it is commented out.\r\n\t\t\r\n\t\t// Round the x and y of the clicked system icon, otherwise we get values like 113.111244652 pixels.\r\n\t\tvar iconX = Math.round(x);\r\n\t\tvar iconY = Math.round(y);\r\n\t\t\r\n\t\t// Get the width of the popup\r\n\t\tvar popupWidth = $('#popup-container').outerWidth();\r\n\t\tvar popupHeight = $('#popup-container').outerHeight();\r\n\t\t\r\n\t\tvar newPopupXPercent = iconX;\r\n\t\tvar newPopupYPercent = iconY;\r\n\t\t\r\n\t\t$('#popup-container').css({'left' : 0, 'top': 0});\r\n\t\t\r\n\t\tconsole.log((newPopupXPercent / 1000 * 100) + \": \" + (newPopupYPercent / 1000 * 100));\r\n\t\t*/\r\n\t}\r\n\t\r\n\t/**\r\n\t * Redirects user to the Empire-Overview page template with the system's info.\r\n\t */\r\n\tfunction ViewSystemWithID(id)\r\n\t{\r\n\t\tconsole.log(\"Viewing system with ID \" + id);\r\n\t}\r\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2dhbGF4eS1tYXAuanM/OGZjYiJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBXaGVuIGRvY3VtZW50IGhhcyBmaW5pc2hlZCBsb2FkaW5nLi4uXHJcbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG5cdFxyXG5cdC8vIFRoZSBJRCBvZiB0aGUgc2VsZWN0ZWQgc29sYXIgc3lzdGVtLiBEZWZhdWx0IHRvIC0xLCB3aGljaCBubyBzeXN0ZW0gc2hvdWxkIGhhdmUuXHJcblx0dmFyIHNlbGVjdGVkU3lzdGVtSUQgPSAtMTtcclxuXHRcclxuXHQvLyBUaGUgcGl4ZWwgd2lkdGggYW5kIGhlaWdodCBvZiB0aGUgZ2FsYXh5IG1hcCBpbWFnZS5cclxuXHR2YXIgZ2FsYXh5TWFwV2lkdGggID0gJCgnI2dhbGF4eS1tYXAtY29udGVudC1jb250YWluZXInKS53aWR0aCgpO1xyXG5cdHZhciBnYWxheHlNYXBIZWlnaHQgPSAkKCcjZ2FsYXh5LW1hcC1jb250ZW50LWNvbnRhaW5lcicpLmhlaWdodCgpO1xyXG5cdC8vIFRoZSB4IGFuZCB5IHBvc2l0aW9uIG9mIHRoZSBnYWxheHkgbWFwIGltYWdlLiBDdXJyZW50bHkgbm90IHVzZWQuXHJcblx0dmFyIGdhbGF4eVhZUG9zID0gJCgnI2dhbGF4eS1tYXAtY29udGVudC1jb250YWluZXInKS5vZmZzZXQoKTtcclxuXHRcclxuXHQvLyBUaGUgY29udGFpbmVyIGZvciB0aGUgc29sYXIgc3lzdGVtIGljb25zLlxyXG5cdHZhciBpY29uc0NvbnRhaW5lciA9ICQoJyNnYWxheHktb3ZlcmxheS1pbm50ZXItY29udGFpbmVyJyk7XHJcblx0XHJcblx0Ly8gRm9yIGVhY2ggc29sYXIgc3lzdGVtLi4uXHJcblx0JC5lYWNoKHNvbGFyU3lzdGVtcywgZnVuY3Rpb24oa2V5LCBzeXN0ZW0pXHJcblx0e1xyXG5cdFx0Ly8gR2V0IHRoZSBzb2xhciBzeXN0ZW0ncyBpZCwgbmFtZSwgYW5kIGxvY2F0aW9uICh4LCB5KS5cclxuXHRcdHZhciBzeXN0ZW1OYW1lID0gc3lzdGVtWyduYW1lJ107XHJcblx0XHR2YXIgc3lzdGVtSWQgPSBzeXN0ZW1bJ2lkJ107XHJcblx0XHR2YXIgc3lzdGVtTG9jYXRpb24gPSBKU09OLnBhcnNlKHN5c3RlbVsnbG9jYXRpb24nXSk7XHJcblx0XHRcclxuXHRcdC8vIEdlbmVyYXRlIHRoZSBvdXRlciBpY29uIGNvbnRhaW5lci5cclxuXHRcdHZhciBpY29uQ29udGFpbmVyID0gJCgnPGRpdj48L2Rpdj4nLCB7XHJcblx0XHRcdGNsYXNzOiAnc3lzdGVtLWljb24tY29udGFpbmVyJ1xyXG5cdFx0fSk7XHJcblx0XHRcclxuXHRcdC8vIEdlbmVyYXRlIHRoZSBpbm5lciBpY29uIGNvbnRhaW5lci5cclxuXHRcdHZhciBpY29uSW5uZXIgPSAkKCc8ZGl2PjwvZGl2PicsIHtcclxuXHRcdFx0Y2xhc3M6ICdzeXN0ZW0taWNvbi1pbm5lci1jb250YWluZXInXHJcblx0XHR9KTtcclxuXHRcdC8vIEFkZCBhIGNsaWNrIGV2ZW50IHRvIHRoZSBvdXRlciBpY29uIGNvbnRhaW5lciwgd2hpY2ggd2lsbCBwb3B1bGF0ZSB0aGUgcG9wdXAgd2l0aCB0aGUgc3lzdGVtJ3MgbmFtZSBhbmQgaWQuXHJcblx0XHRpY29uQ29udGFpbmVyLmNsaWNrKGZ1bmN0aW9uKCkge09uU3lzdGVtSWNvbkNsaWNrKHN5c3RlbUlkLCBzeXN0ZW1OYW1lLCAkKHRoaXMpLm9mZnNldCgpLmxlZnQsICQodGhpcykub2Zmc2V0KCkudG9wKTt9KTtcclxuXHRcdFxyXG5cdFx0Ly8gQWRkIHRoZSBpbm5lciBjb250YWluZXIgdG8gdGhlIG91dGVyIGNvbnRhaW5lci5cclxuXHRcdGljb25Db250YWluZXIuYXBwZW5kKGljb25Jbm5lcik7XHJcblx0XHRcclxuXHRcdC8vIFNldCB0aGUgeC95LWNvb3JkaW5hdGUgb2YgdGhlIGljb24gcmVsYXRpdmUgdG8gdGhlIGdhbGF4eSBtYXAuXHJcblx0XHQvLyBJIGFzc3VtZSB0aGUgbWF4IHggYW5kIHkgY29vcmRpbmF0ZXMgYXJlIDEwMDAuXHJcblx0XHR2YXIgeFBlcmNlbnQgPSBzeXN0ZW1Mb2NhdGlvblswXSAvIGdhbGF4eU1hcFdpZHRoICogMTAwO1xyXG5cdFx0dmFyIHlQZXJjZW50ID0gc3lzdGVtTG9jYXRpb25bMV0gLyBnYWxheHlNYXBIZWlnaHQgKiAxMDA7XHJcblx0XHRcclxuXHRcdC8vIFNldCB0aGUgaWNvbidzIHBvc2l0aW9uIGFzIHBlcmNlbnRzLiBUaGUgaWNvbiBpcyAxNnB4IHdpZGUgc28gc3VidHJhY3QgOHB4IGZyb20gdGhlIHBlcmNlbnRcclxuXHRcdC8vIHRvIGNlbnRlciB0aGUgaWNvbiBhdCBpdHMgcG9zaXRpb24uXHJcblx0XHRpY29uQ29udGFpbmVyLmNzcyh7J2xlZnQnOiAnY2FsYygnICsgeFBlcmNlbnQgKyBcIiUgLSA4cHgpXCIsICd0b3AnOiAnY2FsYygnICsgeVBlcmNlbnQgKyAnJSAtIDhweCd9KTtcclxuXHRcdFxyXG5cdFx0Ly8gQWRkIHRoZSBpY29uIHRvIHRoZSBpY29uIGNvbnRhaW5lci5cclxuXHRcdGljb25zQ29udGFpbmVyLmFwcGVuZChpY29uQ29udGFpbmVyKTtcclxuXHR9KTtcclxuXHRcclxuXHQvLyBXaGVuIHRoZSBcIlZpZXcgU3lzdGVtXCIgbGluayBpcyBjbGlja2VkLCBjYWxsIHRoZSBWaWV3U3lzdGVtV2l0aElEKCkgZnVuY3Rpb24gd2l0aCB0aGUgc2VsZWN0ZWQgSUQuXHJcblx0JCgnI2dvLXRvLXN5c3RlbS1saW5rJykuY2xpY2soZnVuY3Rpb24oKSB7Vmlld1N5c3RlbVdpdGhJRChzZWxlY3RlZFN5c3RlbUlEKTt9KTtcclxuXHRcclxuXHQvLyBXaGVuIHRoZSBwb3B1cCBYLWJ1dHRvbiBpcyBjbGlja2VkLCBoaWRlIHRoZSBwb3B1cC5cclxuXHQkKCcjcG9wdXAteC1idXR0b24nKS5jbGljayhmdW5jdGlvbigpIHskKCcjcG9wdXAtY29udGFpbmVyJykuaGlkZSgpO30pO1xyXG5cdFxyXG5cdC8qKlxyXG5cdCAqIFBvcHVsYXRlcywgcG9zaXRpb25zLCBhbmQgc2hvd3MgdGhlIHBvcHVwIGJveCB3aXRoIGEgc29sYXIgc3lzdGVtJ3MgaW5mby5cclxuXHQgKi9cclxuXHRmdW5jdGlvbiBPblN5c3RlbUljb25DbGljayhpZCwgbmFtZSwgeCwgeSlcclxuXHR7XHJcblx0XHQvLyBDaGFuZ2UgdGhlIGN1cnJlbnRseSBzZWxlY3RlZCBzeXN0ZW0gaWQuXHJcblx0XHRzZWxlY3RlZFN5c3RlbUlEID0gaWQ7XHJcblx0XHRcclxuXHRcdC8vIENoYW5nZSB0aGUgcG9wdXAgdGV4dCB0byB0aGUgc3lzdGVtJ3MgbmFtZS5cclxuXHRcdCQoJyNwb3B1cC1zeXN0ZW0tbmFtZScpLnRleHQobmFtZSk7XHJcblx0XHRcclxuXHRcdC8vIFNob3cgdGhlIHBvcHVwLCBvdGhlcndpc2UgdGhlIG91dGVyV2lkdGgoKS9IZWlnaHQoKSB3aWxsIHJldHVybiAwLlxyXG5cdFx0JCgnI3BvcHVwLWNvbnRhaW5lcicpLnNob3coKTtcclxuXHRcdFxyXG5cdFx0LypcclxuXHRcdC8vIFRoaXMgaXMgY29kZSBmb3IgZHluYW1pY2FsbHkgcG9zaXRpb25pbmcgdGhlIHBvcHVwIG5lYXIgdGhlIHNlbGVjdGVkIHN5c3RlbS5cclxuXHRcdC8vIEl0IGN1cnJlbnRseSBkb2VzIG5vdCB3b3JrLCBzbyBpdCBpcyBjb21tZW50ZWQgb3V0LlxyXG5cdFx0XHJcblx0XHQvLyBSb3VuZCB0aGUgeCBhbmQgeSBvZiB0aGUgY2xpY2tlZCBzeXN0ZW0gaWNvbiwgb3RoZXJ3aXNlIHdlIGdldCB2YWx1ZXMgbGlrZSAxMTMuMTExMjQ0NjUyIHBpeGVscy5cclxuXHRcdHZhciBpY29uWCA9IE1hdGgucm91bmQoeCk7XHJcblx0XHR2YXIgaWNvblkgPSBNYXRoLnJvdW5kKHkpO1xyXG5cdFx0XHJcblx0XHQvLyBHZXQgdGhlIHdpZHRoIG9mIHRoZSBwb3B1cFxyXG5cdFx0dmFyIHBvcHVwV2lkdGggPSAkKCcjcG9wdXAtY29udGFpbmVyJykub3V0ZXJXaWR0aCgpO1xyXG5cdFx0dmFyIHBvcHVwSGVpZ2h0ID0gJCgnI3BvcHVwLWNvbnRhaW5lcicpLm91dGVySGVpZ2h0KCk7XHJcblx0XHRcclxuXHRcdHZhciBuZXdQb3B1cFhQZXJjZW50ID0gaWNvblg7XHJcblx0XHR2YXIgbmV3UG9wdXBZUGVyY2VudCA9IGljb25ZO1xyXG5cdFx0XHJcblx0XHQkKCcjcG9wdXAtY29udGFpbmVyJykuY3NzKHsnbGVmdCcgOiAwLCAndG9wJzogMH0pO1xyXG5cdFx0XHJcblx0XHRjb25zb2xlLmxvZygobmV3UG9wdXBYUGVyY2VudCAvIDEwMDAgKiAxMDApICsgXCI6IFwiICsgKG5ld1BvcHVwWVBlcmNlbnQgLyAxMDAwICogMTAwKSk7XHJcblx0XHQqL1xyXG5cdH1cclxuXHRcclxuXHQvKipcclxuXHQgKiBSZWRpcmVjdHMgdXNlciB0byB0aGUgRW1waXJlLU92ZXJ2aWV3IHBhZ2UgdGVtcGxhdGUgd2l0aCB0aGUgc3lzdGVtJ3MgaW5mby5cclxuXHQgKi9cclxuXHRmdW5jdGlvbiBWaWV3U3lzdGVtV2l0aElEKGlkKVxyXG5cdHtcclxuXHRcdGNvbnNvbGUubG9nKFwiVmlld2luZyBzeXN0ZW0gd2l0aCBJRCBcIiArIGlkKTtcclxuXHR9XHJcbn0pO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2dhbGF4eS1tYXAuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7O0FBR0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7Ozs7QUFJQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOzs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQW9CQTtBQUNBOzs7O0FBSUE7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);