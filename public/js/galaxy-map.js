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

eval("// When document has finished loading...\n$(document).ready(function() {\n\t\n\t// The ID of the selected solar system. Default to -1, which no system should have.\n\tvar selectedSystemID = -1;\n\t\n\t// The pixel width and height of the galaxy map image.\n\tvar galaxyMapWidth  = $('#galaxy-map-content-container').width();\n\tvar galaxyMapHeight = $('#galaxy-map-content-container').height();\n\t// The x and y position of the galaxy map image. Currently not used.\n\tvar galaxyXYPos = $('#galaxy-map-content-container').offset();\n\t\n\t// The container for the solar system icons.\n\tvar iconsContainer = $('#galaxy-overlay-innter-container');\n\t\n\t// For each solar system...\n\t$.each(solarSystems, function(key, system)\n\t{\n\t\t// Get the solar system's id, name, and location (x, y).\n\t\tvar systemName = system['name'];\n\t\tvar systemId = system['id'];\n\t\tvar systemLocation = JSON.parse(system['location']);\n\t\t\n\t\t// Generate the outer icon container.\n\t\tvar iconContainer = $('<div></div>', {\n\t\t\tclass: 'system-icon-container'\n\t\t});\n\t\t\n\t\t// Generate the inner icon container.\n\t\tvar iconInner = $('<div></div>', {\n\t\t\tclass: 'system-icon-inner-container'\n\t\t});\n\t\t// Add a click event to the outer icon container, which will populate the popup with the system's name and id.\n\t\ticonContainer.click(function() {OnSystemIconClick(systemId, systemName, $(this).offset().left, $(this).offset().top);});\n\t\t\n\t\t// Add the inner container to the outer container.\n\t\ticonContainer.append(iconInner);\n\t\t\n\t\t// Set the x/y-coordinate of the icon relative to the galaxy map.\n\t\t// I assume the max x and y coordinates are 1000.\n\t\tvar xPercent = systemLocation[0] / galaxyMapWidth * 100;\n\t\tvar yPercent = systemLocation[1] / galaxyMapHeight * 100;\n\t\t\n\t\t// Set the icon's position as percents. The icon is 16px wide so subtract 8px from the percent\n\t\t// to center the icon at its position.\n\t\ticonContainer.css({'left': 'calc(' + xPercent + \"% - 8px)\", 'top': 'calc(' + yPercent + '% - 8px'});\n\t\t\n\t\t// Add the icon to the icon container.\n\t\ticonsContainer.append(iconContainer);\n\t});\n\t\n\t// When the \"View System\" link is clicked, call the ViewSystemWithID() function with the selected ID.\n\t$('#go-to-system-link').click(function() {ViewSystemWithID(selectedSystemID);});\n\t\n\t// When the popup X-button is clicked, hide the popup.\n\t$('#popup-x-button').click(function() {$('#popup-container').hide();});\n\t\n\t/**\n\t * Populates, positions, and shows the popup box with a solar system's info.\n\t */\n\tfunction OnSystemIconClick(id, name, x, y)\n\t{\n\t\t// Change the currently selected system id.\n\t\tselectedSystemID = id;\n\t\t\n\t\t// Change the popup text to the system's name.\n\t\t$('#popup-system-name').text(name);\n\t\t\n\t\t// Show the popup, otherwise the outerWidth()/Height() will return 0.\n\t\t$('#popup-container').show();\n\t\t\n\t\t/*\n\t\t// This is code for dynamically positioning the popup near the selected system.\n\t\t// It currently does not work, so it is commented out.\n\t\t\n\t\t// Round the x and y of the clicked system icon, otherwise we get values like 113.111244652 pixels.\n\t\tvar iconX = Math.round(x);\n\t\tvar iconY = Math.round(y);\n\t\t\n\t\t// Get the width of the popup\n\t\tvar popupWidth = $('#popup-container').outerWidth();\n\t\tvar popupHeight = $('#popup-container').outerHeight();\n\t\t\n\t\tvar newPopupXPercent = iconX;\n\t\tvar newPopupYPercent = iconY;\n\t\t\n\t\t$('#popup-container').css({'left' : 0, 'top': 0});\n\t\t\n\t\tconsole.log((newPopupXPercent / 1000 * 100) + \": \" + (newPopupYPercent / 1000 * 100));\n\t\t*/\n\t}\n\t\n\t/**\n\t * Redirects user to the Empire-Overview page template with the system's info.\n\t */\n\tfunction ViewSystemWithID(id)\n\t{\n\t\tconsole.log(\"Viewing system with ID \" + id);\n\t}\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2dhbGF4eS1tYXAuanM/OGZjYiJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBXaGVuIGRvY3VtZW50IGhhcyBmaW5pc2hlZCBsb2FkaW5nLi4uXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcblx0XG5cdC8vIFRoZSBJRCBvZiB0aGUgc2VsZWN0ZWQgc29sYXIgc3lzdGVtLiBEZWZhdWx0IHRvIC0xLCB3aGljaCBubyBzeXN0ZW0gc2hvdWxkIGhhdmUuXG5cdHZhciBzZWxlY3RlZFN5c3RlbUlEID0gLTE7XG5cdFxuXHQvLyBUaGUgcGl4ZWwgd2lkdGggYW5kIGhlaWdodCBvZiB0aGUgZ2FsYXh5IG1hcCBpbWFnZS5cblx0dmFyIGdhbGF4eU1hcFdpZHRoICA9ICQoJyNnYWxheHktbWFwLWNvbnRlbnQtY29udGFpbmVyJykud2lkdGgoKTtcblx0dmFyIGdhbGF4eU1hcEhlaWdodCA9ICQoJyNnYWxheHktbWFwLWNvbnRlbnQtY29udGFpbmVyJykuaGVpZ2h0KCk7XG5cdC8vIFRoZSB4IGFuZCB5IHBvc2l0aW9uIG9mIHRoZSBnYWxheHkgbWFwIGltYWdlLiBDdXJyZW50bHkgbm90IHVzZWQuXG5cdHZhciBnYWxheHlYWVBvcyA9ICQoJyNnYWxheHktbWFwLWNvbnRlbnQtY29udGFpbmVyJykub2Zmc2V0KCk7XG5cdFxuXHQvLyBUaGUgY29udGFpbmVyIGZvciB0aGUgc29sYXIgc3lzdGVtIGljb25zLlxuXHR2YXIgaWNvbnNDb250YWluZXIgPSAkKCcjZ2FsYXh5LW92ZXJsYXktaW5udGVyLWNvbnRhaW5lcicpO1xuXHRcblx0Ly8gRm9yIGVhY2ggc29sYXIgc3lzdGVtLi4uXG5cdCQuZWFjaChzb2xhclN5c3RlbXMsIGZ1bmN0aW9uKGtleSwgc3lzdGVtKVxuXHR7XG5cdFx0Ly8gR2V0IHRoZSBzb2xhciBzeXN0ZW0ncyBpZCwgbmFtZSwgYW5kIGxvY2F0aW9uICh4LCB5KS5cblx0XHR2YXIgc3lzdGVtTmFtZSA9IHN5c3RlbVsnbmFtZSddO1xuXHRcdHZhciBzeXN0ZW1JZCA9IHN5c3RlbVsnaWQnXTtcblx0XHR2YXIgc3lzdGVtTG9jYXRpb24gPSBKU09OLnBhcnNlKHN5c3RlbVsnbG9jYXRpb24nXSk7XG5cdFx0XG5cdFx0Ly8gR2VuZXJhdGUgdGhlIG91dGVyIGljb24gY29udGFpbmVyLlxuXHRcdHZhciBpY29uQ29udGFpbmVyID0gJCgnPGRpdj48L2Rpdj4nLCB7XG5cdFx0XHRjbGFzczogJ3N5c3RlbS1pY29uLWNvbnRhaW5lcidcblx0XHR9KTtcblx0XHRcblx0XHQvLyBHZW5lcmF0ZSB0aGUgaW5uZXIgaWNvbiBjb250YWluZXIuXG5cdFx0dmFyIGljb25Jbm5lciA9ICQoJzxkaXY+PC9kaXY+Jywge1xuXHRcdFx0Y2xhc3M6ICdzeXN0ZW0taWNvbi1pbm5lci1jb250YWluZXInXG5cdFx0fSk7XG5cdFx0Ly8gQWRkIGEgY2xpY2sgZXZlbnQgdG8gdGhlIG91dGVyIGljb24gY29udGFpbmVyLCB3aGljaCB3aWxsIHBvcHVsYXRlIHRoZSBwb3B1cCB3aXRoIHRoZSBzeXN0ZW0ncyBuYW1lIGFuZCBpZC5cblx0XHRpY29uQ29udGFpbmVyLmNsaWNrKGZ1bmN0aW9uKCkge09uU3lzdGVtSWNvbkNsaWNrKHN5c3RlbUlkLCBzeXN0ZW1OYW1lLCAkKHRoaXMpLm9mZnNldCgpLmxlZnQsICQodGhpcykub2Zmc2V0KCkudG9wKTt9KTtcblx0XHRcblx0XHQvLyBBZGQgdGhlIGlubmVyIGNvbnRhaW5lciB0byB0aGUgb3V0ZXIgY29udGFpbmVyLlxuXHRcdGljb25Db250YWluZXIuYXBwZW5kKGljb25Jbm5lcik7XG5cdFx0XG5cdFx0Ly8gU2V0IHRoZSB4L3ktY29vcmRpbmF0ZSBvZiB0aGUgaWNvbiByZWxhdGl2ZSB0byB0aGUgZ2FsYXh5IG1hcC5cblx0XHQvLyBJIGFzc3VtZSB0aGUgbWF4IHggYW5kIHkgY29vcmRpbmF0ZXMgYXJlIDEwMDAuXG5cdFx0dmFyIHhQZXJjZW50ID0gc3lzdGVtTG9jYXRpb25bMF0gLyBnYWxheHlNYXBXaWR0aCAqIDEwMDtcblx0XHR2YXIgeVBlcmNlbnQgPSBzeXN0ZW1Mb2NhdGlvblsxXSAvIGdhbGF4eU1hcEhlaWdodCAqIDEwMDtcblx0XHRcblx0XHQvLyBTZXQgdGhlIGljb24ncyBwb3NpdGlvbiBhcyBwZXJjZW50cy4gVGhlIGljb24gaXMgMTZweCB3aWRlIHNvIHN1YnRyYWN0IDhweCBmcm9tIHRoZSBwZXJjZW50XG5cdFx0Ly8gdG8gY2VudGVyIHRoZSBpY29uIGF0IGl0cyBwb3NpdGlvbi5cblx0XHRpY29uQ29udGFpbmVyLmNzcyh7J2xlZnQnOiAnY2FsYygnICsgeFBlcmNlbnQgKyBcIiUgLSA4cHgpXCIsICd0b3AnOiAnY2FsYygnICsgeVBlcmNlbnQgKyAnJSAtIDhweCd9KTtcblx0XHRcblx0XHQvLyBBZGQgdGhlIGljb24gdG8gdGhlIGljb24gY29udGFpbmVyLlxuXHRcdGljb25zQ29udGFpbmVyLmFwcGVuZChpY29uQ29udGFpbmVyKTtcblx0fSk7XG5cdFxuXHQvLyBXaGVuIHRoZSBcIlZpZXcgU3lzdGVtXCIgbGluayBpcyBjbGlja2VkLCBjYWxsIHRoZSBWaWV3U3lzdGVtV2l0aElEKCkgZnVuY3Rpb24gd2l0aCB0aGUgc2VsZWN0ZWQgSUQuXG5cdCQoJyNnby10by1zeXN0ZW0tbGluaycpLmNsaWNrKGZ1bmN0aW9uKCkge1ZpZXdTeXN0ZW1XaXRoSUQoc2VsZWN0ZWRTeXN0ZW1JRCk7fSk7XG5cdFxuXHQvLyBXaGVuIHRoZSBwb3B1cCBYLWJ1dHRvbiBpcyBjbGlja2VkLCBoaWRlIHRoZSBwb3B1cC5cblx0JCgnI3BvcHVwLXgtYnV0dG9uJykuY2xpY2soZnVuY3Rpb24oKSB7JCgnI3BvcHVwLWNvbnRhaW5lcicpLmhpZGUoKTt9KTtcblx0XG5cdC8qKlxuXHQgKiBQb3B1bGF0ZXMsIHBvc2l0aW9ucywgYW5kIHNob3dzIHRoZSBwb3B1cCBib3ggd2l0aCBhIHNvbGFyIHN5c3RlbSdzIGluZm8uXG5cdCAqL1xuXHRmdW5jdGlvbiBPblN5c3RlbUljb25DbGljayhpZCwgbmFtZSwgeCwgeSlcblx0e1xuXHRcdC8vIENoYW5nZSB0aGUgY3VycmVudGx5IHNlbGVjdGVkIHN5c3RlbSBpZC5cblx0XHRzZWxlY3RlZFN5c3RlbUlEID0gaWQ7XG5cdFx0XG5cdFx0Ly8gQ2hhbmdlIHRoZSBwb3B1cCB0ZXh0IHRvIHRoZSBzeXN0ZW0ncyBuYW1lLlxuXHRcdCQoJyNwb3B1cC1zeXN0ZW0tbmFtZScpLnRleHQobmFtZSk7XG5cdFx0XG5cdFx0Ly8gU2hvdyB0aGUgcG9wdXAsIG90aGVyd2lzZSB0aGUgb3V0ZXJXaWR0aCgpL0hlaWdodCgpIHdpbGwgcmV0dXJuIDAuXG5cdFx0JCgnI3BvcHVwLWNvbnRhaW5lcicpLnNob3coKTtcblx0XHRcblx0XHQvKlxuXHRcdC8vIFRoaXMgaXMgY29kZSBmb3IgZHluYW1pY2FsbHkgcG9zaXRpb25pbmcgdGhlIHBvcHVwIG5lYXIgdGhlIHNlbGVjdGVkIHN5c3RlbS5cblx0XHQvLyBJdCBjdXJyZW50bHkgZG9lcyBub3Qgd29yaywgc28gaXQgaXMgY29tbWVudGVkIG91dC5cblx0XHRcblx0XHQvLyBSb3VuZCB0aGUgeCBhbmQgeSBvZiB0aGUgY2xpY2tlZCBzeXN0ZW0gaWNvbiwgb3RoZXJ3aXNlIHdlIGdldCB2YWx1ZXMgbGlrZSAxMTMuMTExMjQ0NjUyIHBpeGVscy5cblx0XHR2YXIgaWNvblggPSBNYXRoLnJvdW5kKHgpO1xuXHRcdHZhciBpY29uWSA9IE1hdGgucm91bmQoeSk7XG5cdFx0XG5cdFx0Ly8gR2V0IHRoZSB3aWR0aCBvZiB0aGUgcG9wdXBcblx0XHR2YXIgcG9wdXBXaWR0aCA9ICQoJyNwb3B1cC1jb250YWluZXInKS5vdXRlcldpZHRoKCk7XG5cdFx0dmFyIHBvcHVwSGVpZ2h0ID0gJCgnI3BvcHVwLWNvbnRhaW5lcicpLm91dGVySGVpZ2h0KCk7XG5cdFx0XG5cdFx0dmFyIG5ld1BvcHVwWFBlcmNlbnQgPSBpY29uWDtcblx0XHR2YXIgbmV3UG9wdXBZUGVyY2VudCA9IGljb25ZO1xuXHRcdFxuXHRcdCQoJyNwb3B1cC1jb250YWluZXInKS5jc3MoeydsZWZ0JyA6IDAsICd0b3AnOiAwfSk7XG5cdFx0XG5cdFx0Y29uc29sZS5sb2coKG5ld1BvcHVwWFBlcmNlbnQgLyAxMDAwICogMTAwKSArIFwiOiBcIiArIChuZXdQb3B1cFlQZXJjZW50IC8gMTAwMCAqIDEwMCkpO1xuXHRcdCovXG5cdH1cblx0XG5cdC8qKlxuXHQgKiBSZWRpcmVjdHMgdXNlciB0byB0aGUgRW1waXJlLU92ZXJ2aWV3IHBhZ2UgdGVtcGxhdGUgd2l0aCB0aGUgc3lzdGVtJ3MgaW5mby5cblx0ICovXG5cdGZ1bmN0aW9uIFZpZXdTeXN0ZW1XaXRoSUQoaWQpXG5cdHtcblx0XHRjb25zb2xlLmxvZyhcIlZpZXdpbmcgc3lzdGVtIHdpdGggSUQgXCIgKyBpZCk7XG5cdH1cbn0pO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2dhbGF4eS1tYXAuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7O0FBR0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7Ozs7QUFJQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBOzs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQW9CQTtBQUNBOzs7O0FBSUE7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);