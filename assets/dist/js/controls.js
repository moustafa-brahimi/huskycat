/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/controls.js":
/*!***********************************!*\
  !*** ./assets/src/js/controls.js ***!
  \***********************************/
/***/ (function() {

eval("var fonts;\nfetch(huskycatControls.googleFonts).then(function (response) {\n  return response.json();\n}).then(function (list) {\n  fonts = list;\n  jQuery(document).ready(function ($) {\n    $('.huskycat-control.typography').trigger('fonts.ready');\n  });\n});\njQuery(document).ready(function ($) {\n  // select 2 dropdowns\n  $(\".customize-control-select2\").select2({\n    width: \"100%\"\n  }); // typography control\n  // rely on json fonts file\n\n  $(\".huskycat-control.typography\").on('fonts.ready', function () {\n    var that = $(this),\n        currentFontFamily = that.find('.family__select').val(),\n        currentFont = fonts ? fonts[currentFontFamily] : null; // show recommended only fonts\n\n    that.find('.family__recommend').on('change', function () {\n      var allFonts = $(this).parents('.huskycat-control.typography').find('optgroup.all');\n\n      if (this.checked) {\n        allFonts.attr({\n          disabled: \"disabled\"\n        });\n      } else {\n        allFonts.removeAttr(\"disabled\");\n      }\n    });\n    /* family changes */\n\n    that.find(\".family__select\").on(\"change\", function () {\n      currentFontFamily = $(this).val();\n      currentFont = fonts[currentFontFamily];\n\n      if (!currentFont || !currentFont.variants) {\n        return;\n      }\n\n      var styleSelect = that.find(\".style__select--dynamic\");\n      styleSelect.empty();\n      styleSelect.removeAttr('disabled');\n\n      for (var style in currentFont.variants) {\n        $(\"<option value=\\\"\".concat(style, \"\\\" \").concat(style == 'normal' ? 'selected' : '', \">\").concat(style, \"</option>\")).appendTo(styleSelect);\n      }\n\n      styleSelect.trigger('change');\n    });\n    /* style changes */\n\n    that.find(\".style__select--dynamic\").on('change', function () {\n      var style = $(this).val(),\n          weightSelect = that.find(\".weight__select--dynamic\"),\n          previousValue = weightSelect.val();\n      $(weightSelect).empty();\n      weightSelect.removeAttr('disabled');\n\n      if (currentFont && currentFont.variants && currentFont.variants[style]) {\n        var weights = currentFont.variants[style],\n            selected = weights.hasOwnProperty(previousValue) ? previousValue : 400;\n\n        for (var weight in weights) {\n          $(\"<option value=\\\"\".concat(weight, \"\\\" \").concat(weight == selected ? 'selected' : '', \">\").concat(weight, \"</option>\")).appendTo(weightSelect);\n        }\n      }\n\n      weightSelect.trigger('change');\n    });\n  });\n  $(\".huskycat-control.typography\").each(function () {\n    var that = $(this);\n    /* font size input */\n\n    that.find('.size__hero').on(\"input\", function () {\n      var mainInput = $(this).parents('.size').find('.size__input');\n      mainInput.val($(this).val());\n      mainInput.trigger('change');\n    });\n    that.find('.size__input').on('input', function () {\n      var secondaryInput = $(this).parents('.size').find('.size__hero');\n      secondaryInput.val($(this).val());\n      secondaryInput.trigger('change');\n    });\n    /* letter-spacing input */\n\n    that.find('.letter-spacing__hero').on(\"input\", function () {\n      var mainInput = $(this).parents('.letter-spacing').find('.letter-spacing__input');\n      mainInput.val($(this).val());\n      mainInput.trigger('change');\n    });\n    that.find('.letter-spacing__input').on('input', function () {\n      var secondaryInput = $(this).parents('.letter-spacing').find('.letter-spacing__hero');\n      secondaryInput.val($(this).val());\n      secondaryInput.trigger('change');\n    });\n    /* line-height input */\n\n    that.find('.line-height__hero').on(\"input\", function () {\n      var mainInput = $(this).parents('.line-height').find('.line-height__input');\n      mainInput.val($(this).val());\n      mainInput.trigger('change');\n    });\n    that.find('.line-height__input').on('input', function () {\n      var secondaryInput = $(this).parents('.line-height').find('.line-height__hero');\n      secondaryInput.val($(this).val());\n      secondaryInput.trigger('change');\n    });\n  });\n});\n\n//# sourceURL=webpack://huskycat/./assets/src/js/controls.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./assets/src/js/controls.js"]();
/******/ 	
/******/ })()
;