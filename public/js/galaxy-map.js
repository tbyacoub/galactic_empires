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

eval("// When document has finished loading...\r\n$(document).ready(function() {\r\n\r\n\t// The ID of the selected solar system. Default to -1, which no system should have.\r\n\tvar selectedSystemID = -1;\r\n\r\n\t// The pixel width and height of the galaxy map image.\r\n\tvar galaxyMapWidth  = $('#galaxy-map-content-container').width();\r\n\tvar galaxyMapHeight = $('#galaxy-map-content-container').height();\r\n\t// The x and y position of the galaxy map image. Currently not used.\r\n\tvar galaxyXYPos = $('#galaxy-map-content-container').offset();\r\n\r\n\t// The container for the solar system icons.\r\n\tvar iconsContainer = $('#galaxy-overlay-innter-container');\r\n\r\n\t// For each solar system...\r\n\t$.each(solarSystems, function(key, system)\r\n\t{\r\n\t\t// Get the solar system's id, name, and location (x, y).\r\n\t\tvar systemName = system['name'];\r\n\t\tvar systemId = system['id'];\r\n\t\tvar systemLocation = JSON.parse(system['location']);\r\n\r\n\t\t// Generate the outer icon container.\r\n\t\tvar iconContainer = $('<div></div>', {\r\n\t\t\tclass: 'system-icon-container'\r\n\t\t});\r\n\r\n\t\t// Generate the inner icon container.\r\n\t\tvar iconInner = $('<div></div>', {\r\n\t\t\tclass: 'system-icon-inner-container'\r\n\t\t});\r\n\t\t// Add a click event to the outer icon container, which will populate the popup with the system's name and id.\r\n\t\ticonContainer.click(function() {OnSystemIconClick(systemId, systemName, $(this).offset().left, $(this).offset().top);});\r\n\r\n\t\t// Add the inner container to the outer container.\r\n\t\ticonContainer.append(iconInner);\r\n\r\n\t\t// Set the x/y-coordinate of the icon relative to the galaxy map.\r\n\t\t// I assume the max x and y coordinates are 1000.\r\n\t\tvar xPercent = systemLocation[0] / galaxyMapWidth * 100;\r\n\t\tvar yPercent = systemLocation[1] / galaxyMapHeight * 100;\r\n\r\n\t\t// Set the icon's position as percents. The icon is 16px wide so subtract 8px from the percent\r\n\t\t// to center the icon at its position.\r\n\t\ticonContainer.css({'left': 'calc(' + xPercent + \"% - 8px)\", 'top': 'calc(' + yPercent + '% - 8px'});\r\n\r\n\t\t// Add the icon to the icon container.\r\n\t\ticonsContainer.append(iconContainer);\r\n\t});\r\n\r\n\t// When the \"View System\" link is clicked, call the ViewSystemWithID() function with the selected ID.\r\n\t$('#go-to-system-link').click(function() {ViewSystemWithID(selectedSystemID);});\r\n\r\n\t// When the popup X-button is clicked, hide the popup.\r\n\t$('#popup-x-button').click(function() {$('#popup-container').hide();});\r\n\r\n\t/**\r\n\t * Populates, positions, and shows the popup box with a solar system's info.\r\n\t */\r\n\tfunction OnSystemIconClick(id, name, x, y)\r\n\t{\r\n\t\t// Change the currently selected system id.\r\n\t\tselectedSystemID = id;\r\n\r\n\t\t// Change the popup text to the system's name.\r\n\t\t$('#popup-system-name').text(name);\r\n\r\n\t\t// Show the popup, otherwise the outerWidth()/Height() will return 0.\r\n\t\t$('#popup-container').show();\r\n\r\n\t\t/*\r\n\t\t// This is code for dynamically positioning the popup near the selected system.\r\n\t\t// It currently does not work, so it is commented out.\r\n\r\n\t\t// Round the x and y of the clicked system icon, otherwise we get values like 113.111244652 pixels.\r\n\t\tvar iconX = Math.round(x);\r\n\t\tvar iconY = Math.round(y);\r\n\r\n\t\t// Get the width of the popup\r\n\t\tvar popupWidth = $('#popup-container').outerWidth();\r\n\t\tvar popupHeight = $('#popup-container').outerHeight();\r\n\r\n\t\tvar newPopupXPercent = iconX;\r\n\t\tvar newPopupYPercent = iconY;\r\n\r\n\t\t$('#popup-container').css({'left' : 0, 'top': 0});\r\n\r\n\t\tconsole.log((newPopupXPercent / 1000 * 100) + \": \" + (newPopupYPercent / 1000 * 100));\r\n\t\t*/\r\n\t}\r\n\r\n\t/**\r\n\t * Redirects user to the Empire-Overview page template with the system's info.\r\n\t */\r\n\tfunction ViewSystemWithID(id)\r\n\t{\r\n\t\tconsole.log(\"Viewing system with ID \" + id);\r\n\t}\r\n});\r\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2dhbGF4eS1tYXAuanM/OGZjYiJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBXaGVuIGRvY3VtZW50IGhhcyBmaW5pc2hlZCBsb2FkaW5nLi4uXHJcbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG5cclxuXHQvLyBUaGUgSUQgb2YgdGhlIHNlbGVjdGVkIHNvbGFyIHN5c3RlbS4gRGVmYXVsdCB0byAtMSwgd2hpY2ggbm8gc3lzdGVtIHNob3VsZCBoYXZlLlxyXG5cdHZhciBzZWxlY3RlZFN5c3RlbUlEID0gLTE7XHJcblxyXG5cdC8vIFRoZSBwaXhlbCB3aWR0aCBhbmQgaGVpZ2h0IG9mIHRoZSBnYWxheHkgbWFwIGltYWdlLlxyXG5cdHZhciBnYWxheHlNYXBXaWR0aCAgPSAkKCcjZ2FsYXh5LW1hcC1jb250ZW50LWNvbnRhaW5lcicpLndpZHRoKCk7XHJcblx0dmFyIGdhbGF4eU1hcEhlaWdodCA9ICQoJyNnYWxheHktbWFwLWNvbnRlbnQtY29udGFpbmVyJykuaGVpZ2h0KCk7XHJcblx0Ly8gVGhlIHggYW5kIHkgcG9zaXRpb24gb2YgdGhlIGdhbGF4eSBtYXAgaW1hZ2UuIEN1cnJlbnRseSBub3QgdXNlZC5cclxuXHR2YXIgZ2FsYXh5WFlQb3MgPSAkKCcjZ2FsYXh5LW1hcC1jb250ZW50LWNvbnRhaW5lcicpLm9mZnNldCgpO1xyXG5cclxuXHQvLyBUaGUgY29udGFpbmVyIGZvciB0aGUgc29sYXIgc3lzdGVtIGljb25zLlxyXG5cdHZhciBpY29uc0NvbnRhaW5lciA9ICQoJyNnYWxheHktb3ZlcmxheS1pbm50ZXItY29udGFpbmVyJyk7XHJcblxyXG5cdC8vIEZvciBlYWNoIHNvbGFyIHN5c3RlbS4uLlxyXG5cdCQuZWFjaChzb2xhclN5c3RlbXMsIGZ1bmN0aW9uKGtleSwgc3lzdGVtKVxyXG5cdHtcclxuXHRcdC8vIEdldCB0aGUgc29sYXIgc3lzdGVtJ3MgaWQsIG5hbWUsIGFuZCBsb2NhdGlvbiAoeCwgeSkuXHJcblx0XHR2YXIgc3lzdGVtTmFtZSA9IHN5c3RlbVsnbmFtZSddO1xyXG5cdFx0dmFyIHN5c3RlbUlkID0gc3lzdGVtWydpZCddO1xyXG5cdFx0dmFyIHN5c3RlbUxvY2F0aW9uID0gSlNPTi5wYXJzZShzeXN0ZW1bJ2xvY2F0aW9uJ10pO1xyXG5cclxuXHRcdC8vIEdlbmVyYXRlIHRoZSBvdXRlciBpY29uIGNvbnRhaW5lci5cclxuXHRcdHZhciBpY29uQ29udGFpbmVyID0gJCgnPGRpdj48L2Rpdj4nLCB7XHJcblx0XHRcdGNsYXNzOiAnc3lzdGVtLWljb24tY29udGFpbmVyJ1xyXG5cdFx0fSk7XHJcblxyXG5cdFx0Ly8gR2VuZXJhdGUgdGhlIGlubmVyIGljb24gY29udGFpbmVyLlxyXG5cdFx0dmFyIGljb25Jbm5lciA9ICQoJzxkaXY+PC9kaXY+Jywge1xyXG5cdFx0XHRjbGFzczogJ3N5c3RlbS1pY29uLWlubmVyLWNvbnRhaW5lcidcclxuXHRcdH0pO1xyXG5cdFx0Ly8gQWRkIGEgY2xpY2sgZXZlbnQgdG8gdGhlIG91dGVyIGljb24gY29udGFpbmVyLCB3aGljaCB3aWxsIHBvcHVsYXRlIHRoZSBwb3B1cCB3aXRoIHRoZSBzeXN0ZW0ncyBuYW1lIGFuZCBpZC5cclxuXHRcdGljb25Db250YWluZXIuY2xpY2soZnVuY3Rpb24oKSB7T25TeXN0ZW1JY29uQ2xpY2soc3lzdGVtSWQsIHN5c3RlbU5hbWUsICQodGhpcykub2Zmc2V0KCkubGVmdCwgJCh0aGlzKS5vZmZzZXQoKS50b3ApO30pO1xyXG5cclxuXHRcdC8vIEFkZCB0aGUgaW5uZXIgY29udGFpbmVyIHRvIHRoZSBvdXRlciBjb250YWluZXIuXHJcblx0XHRpY29uQ29udGFpbmVyLmFwcGVuZChpY29uSW5uZXIpO1xyXG5cclxuXHRcdC8vIFNldCB0aGUgeC95LWNvb3JkaW5hdGUgb2YgdGhlIGljb24gcmVsYXRpdmUgdG8gdGhlIGdhbGF4eSBtYXAuXHJcblx0XHQvLyBJIGFzc3VtZSB0aGUgbWF4IHggYW5kIHkgY29vcmRpbmF0ZXMgYXJlIDEwMDAuXHJcblx0XHR2YXIgeFBlcmNlbnQgPSBzeXN0ZW1Mb2NhdGlvblswXSAvIGdhbGF4eU1hcFdpZHRoICogMTAwO1xyXG5cdFx0dmFyIHlQZXJjZW50ID0gc3lzdGVtTG9jYXRpb25bMV0gLyBnYWxheHlNYXBIZWlnaHQgKiAxMDA7XHJcblxyXG5cdFx0Ly8gU2V0IHRoZSBpY29uJ3MgcG9zaXRpb24gYXMgcGVyY2VudHMuIFRoZSBpY29uIGlzIDE2cHggd2lkZSBzbyBzdWJ0cmFjdCA4cHggZnJvbSB0aGUgcGVyY2VudFxyXG5cdFx0Ly8gdG8gY2VudGVyIHRoZSBpY29uIGF0IGl0cyBwb3NpdGlvbi5cclxuXHRcdGljb25Db250YWluZXIuY3NzKHsnbGVmdCc6ICdjYWxjKCcgKyB4UGVyY2VudCArIFwiJSAtIDhweClcIiwgJ3RvcCc6ICdjYWxjKCcgKyB5UGVyY2VudCArICclIC0gOHB4J30pO1xyXG5cclxuXHRcdC8vIEFkZCB0aGUgaWNvbiB0byB0aGUgaWNvbiBjb250YWluZXIuXHJcblx0XHRpY29uc0NvbnRhaW5lci5hcHBlbmQoaWNvbkNvbnRhaW5lcik7XHJcblx0fSk7XHJcblxyXG5cdC8vIFdoZW4gdGhlIFwiVmlldyBTeXN0ZW1cIiBsaW5rIGlzIGNsaWNrZWQsIGNhbGwgdGhlIFZpZXdTeXN0ZW1XaXRoSUQoKSBmdW5jdGlvbiB3aXRoIHRoZSBzZWxlY3RlZCBJRC5cclxuXHQkKCcjZ28tdG8tc3lzdGVtLWxpbmsnKS5jbGljayhmdW5jdGlvbigpIHtWaWV3U3lzdGVtV2l0aElEKHNlbGVjdGVkU3lzdGVtSUQpO30pO1xyXG5cclxuXHQvLyBXaGVuIHRoZSBwb3B1cCBYLWJ1dHRvbiBpcyBjbGlja2VkLCBoaWRlIHRoZSBwb3B1cC5cclxuXHQkKCcjcG9wdXAteC1idXR0b24nKS5jbGljayhmdW5jdGlvbigpIHskKCcjcG9wdXAtY29udGFpbmVyJykuaGlkZSgpO30pO1xyXG5cclxuXHQvKipcclxuXHQgKiBQb3B1bGF0ZXMsIHBvc2l0aW9ucywgYW5kIHNob3dzIHRoZSBwb3B1cCBib3ggd2l0aCBhIHNvbGFyIHN5c3RlbSdzIGluZm8uXHJcblx0ICovXHJcblx0ZnVuY3Rpb24gT25TeXN0ZW1JY29uQ2xpY2soaWQsIG5hbWUsIHgsIHkpXHJcblx0e1xyXG5cdFx0Ly8gQ2hhbmdlIHRoZSBjdXJyZW50bHkgc2VsZWN0ZWQgc3lzdGVtIGlkLlxyXG5cdFx0c2VsZWN0ZWRTeXN0ZW1JRCA9IGlkO1xyXG5cclxuXHRcdC8vIENoYW5nZSB0aGUgcG9wdXAgdGV4dCB0byB0aGUgc3lzdGVtJ3MgbmFtZS5cclxuXHRcdCQoJyNwb3B1cC1zeXN0ZW0tbmFtZScpLnRleHQobmFtZSk7XHJcblxyXG5cdFx0Ly8gU2hvdyB0aGUgcG9wdXAsIG90aGVyd2lzZSB0aGUgb3V0ZXJXaWR0aCgpL0hlaWdodCgpIHdpbGwgcmV0dXJuIDAuXHJcblx0XHQkKCcjcG9wdXAtY29udGFpbmVyJykuc2hvdygpO1xyXG5cclxuXHRcdC8qXHJcblx0XHQvLyBUaGlzIGlzIGNvZGUgZm9yIGR5bmFtaWNhbGx5IHBvc2l0aW9uaW5nIHRoZSBwb3B1cCBuZWFyIHRoZSBzZWxlY3RlZCBzeXN0ZW0uXHJcblx0XHQvLyBJdCBjdXJyZW50bHkgZG9lcyBub3Qgd29yaywgc28gaXQgaXMgY29tbWVudGVkIG91dC5cclxuXHJcblx0XHQvLyBSb3VuZCB0aGUgeCBhbmQgeSBvZiB0aGUgY2xpY2tlZCBzeXN0ZW0gaWNvbiwgb3RoZXJ3aXNlIHdlIGdldCB2YWx1ZXMgbGlrZSAxMTMuMTExMjQ0NjUyIHBpeGVscy5cclxuXHRcdHZhciBpY29uWCA9IE1hdGgucm91bmQoeCk7XHJcblx0XHR2YXIgaWNvblkgPSBNYXRoLnJvdW5kKHkpO1xyXG5cclxuXHRcdC8vIEdldCB0aGUgd2lkdGggb2YgdGhlIHBvcHVwXHJcblx0XHR2YXIgcG9wdXBXaWR0aCA9ICQoJyNwb3B1cC1jb250YWluZXInKS5vdXRlcldpZHRoKCk7XHJcblx0XHR2YXIgcG9wdXBIZWlnaHQgPSAkKCcjcG9wdXAtY29udGFpbmVyJykub3V0ZXJIZWlnaHQoKTtcclxuXHJcblx0XHR2YXIgbmV3UG9wdXBYUGVyY2VudCA9IGljb25YO1xyXG5cdFx0dmFyIG5ld1BvcHVwWVBlcmNlbnQgPSBpY29uWTtcclxuXHJcblx0XHQkKCcjcG9wdXAtY29udGFpbmVyJykuY3NzKHsnbGVmdCcgOiAwLCAndG9wJzogMH0pO1xyXG5cclxuXHRcdGNvbnNvbGUubG9nKChuZXdQb3B1cFhQZXJjZW50IC8gMTAwMCAqIDEwMCkgKyBcIjogXCIgKyAobmV3UG9wdXBZUGVyY2VudCAvIDEwMDAgKiAxMDApKTtcclxuXHRcdCovXHJcblx0fVxyXG5cclxuXHQvKipcclxuXHQgKiBSZWRpcmVjdHMgdXNlciB0byB0aGUgRW1waXJlLU92ZXJ2aWV3IHBhZ2UgdGVtcGxhdGUgd2l0aCB0aGUgc3lzdGVtJ3MgaW5mby5cclxuXHQgKi9cclxuXHRmdW5jdGlvbiBWaWV3U3lzdGVtV2l0aElEKGlkKVxyXG5cdHtcclxuXHRcdGNvbnNvbGUubG9nKFwiVmlld2luZyBzeXN0ZW0gd2l0aCBJRCBcIiArIGlkKTtcclxuXHR9XHJcbn0pO1xyXG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9nYWxheHktbWFwLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTs7O0FBR0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOzs7O0FBSUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFvQkE7QUFDQTs7OztBQUlBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);