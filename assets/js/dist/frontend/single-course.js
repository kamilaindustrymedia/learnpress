this["LP"] = this["LP"] || {}; this["LP"]["singleCourse"] =
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/src/apps/js/frontend/single-course.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/apps/js/frontend/single-course.js":
/*!******************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course.js ***!
  \******************************************************/
/*! exports provided: default, init, initCourseTabs, initCourseSidebar, enrollCourse */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "init", function() { return init; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCourseTabs", function() { return initCourseTabs; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCourseSidebar", function() { return initCourseSidebar; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "enrollCourse", function() { return enrollCourse; });
/* harmony import */ var _single_course_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./single-course/index */ "./assets/src/apps/js/frontend/single-course/index.js");
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


/* harmony default export */ __webpack_exports__["default"] = (_single_course_index__WEBPACK_IMPORTED_MODULE_0__["default"]);
var init = function init() {
  wp.element.render( /*#__PURE__*/React.createElement(_single_course_index__WEBPACK_IMPORTED_MODULE_0__["default"], null));
};
var $ = jQuery;

var initCourseTabs = function initCourseTabs() {
  $('#learn-press-course-tabs').on('change', 'input[name="learn-press-course-tab-radio"]', function () {
    var selectedTab = $('input[name="learn-press-course-tab-radio"]:checked').val();
    LP.Cookies.set('course-tab', selectedTab);
    $('label[for="' + $(event.target).attr('id') + '"]').closest('li').addClass('active').siblings().removeClass('active');
  });
};

var initCourseSidebar = function initCourseSidebar() {
  var $sidebar = $('.course-summary-sidebar');

  if (!$sidebar.length) {
    return;
  }

  var $window = $(window);
  var $scrollable = $sidebar.children();
  var offset = $sidebar.offset();
  var scrollTop = 0;
  var maxHeight = $sidebar.height();
  var scrollHeight = $scrollable.height();
  var options = {
    offsetTop: 32
  };

  var onScroll = function onScroll() {
    scrollTop = $window.scrollTop();
    var top = scrollTop - offset.top + options.offsetTop;

    if (top < 0) {
      $sidebar.removeClass('slide-top slide-down');
      $scrollable.css('top', '');
      return;
    }

    if (top > maxHeight - scrollHeight) {
      $sidebar.removeClass('slide-down').addClass('slide-top');
      $scrollable.css('top', maxHeight - scrollHeight);
    } else {
      $sidebar.removeClass('slide-top').addClass('slide-down');
      $scrollable.css('top', options.offsetTop);
    }
  };

  $window.on('scroll.fixed-course-sidebar', onScroll).trigger('scroll.fixed-course-sidebar');
}; // Rest API Enroll course - Nhamdv.


var enrollCourse = function enrollCourse() {
  var formEnroll = document.querySelector('form.enroll-course');

  if (!formEnroll || !document.body.classList.contains('logged-in')) {
    return;
  }

  var submit = /*#__PURE__*/function () {
    var _ref = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee(id, btnEnroll) {
      var response, status, redirect, message;
      return regeneratorRuntime.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return wp.apiFetch({
                path: 'lp/v1/courses/enroll-course',
                method: 'POST',
                data: {
                  id: id
                }
              });

            case 2:
              response = _context.sent;
              btnEnroll.classList.remove('loading');
              btnEnroll.disabled = false;
              status = response.status, redirect = response.redirect, message = response.message;

              if (message && status) {
                formEnroll.innerHTML += "<div class=\"lp-enroll-notice ".concat(status, "\">").concat(message, "</div>");
              }

              if (status === 'success' && redirect) {
                window.location.href = redirect;
              }

              return _context.abrupt("return", response);

            case 9:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function submit(_x, _x2) {
      return _ref.apply(this, arguments);
    };
  }();

  formEnroll.addEventListener('submit', function (event) {
    event.preventDefault();
    var id = formEnroll.querySelector('input[name=enroll-course]').value;
    var btnEnroll = formEnroll.querySelector('button.button-enroll-course');
    btnEnroll.classList.add('loading');
    btnEnroll.disabled = true;
    submit(id, btnEnroll);
  }); // Reload when press back button in chrome.

  if (document.querySelector('.course-detail-info') !== null) {
    window.addEventListener('pageshow', function (event) {
      var hasCache = event.persisted || typeof window.performance != 'undefined' && String(window.performance.getEntriesByType('navigation')[0].type) == 'back_forward';

      if (hasCache) {
        location.reload();
      }
    });
  }
};


$(window).on('load', function () {
  var $popup = $('#popup-course');
  var timerClearScroll;
  var $curriculum = $('#learn-press-course-curriculum');
  initCourseTabs();
  initCourseSidebar();
  enrollCourse();
});

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-course/index.js":
/*!************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course/index.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _learnpress_quiz__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @learnpress/quiz */ "@learnpress/quiz");
/* harmony import */ var _learnpress_quiz__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_learnpress_quiz__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./store */ "./assets/src/apps/js/frontend/single-course/store/index.js");
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_store__WEBPACK_IMPORTED_MODULE_2__);
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }





var SingleCourse = /*#__PURE__*/function (_Component) {
  _inherits(SingleCourse, _Component);

  var _super = _createSuper(SingleCourse);

  function SingleCourse() {
    _classCallCheck(this, SingleCourse);

    return _super.apply(this, arguments);
  }

  _createClass(SingleCourse, [{
    key: "render",
    value: function render() {
      return /*#__PURE__*/React.createElement(React.Fragment, null);
    }
  }]);

  return SingleCourse;
}(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (SingleCourse);

function run() {// commentForm();
}

window.addEventListener('DOMContentLoaded', function () {
  run();
});

/***/ }),

/***/ "./assets/src/apps/js/frontend/single-course/store/index.js":
/*!******************************************************************!*\
  !*** ./assets/src/apps/js/frontend/single-course/store/index.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Created by tu on 9/19/19.
 */

/***/ }),

/***/ "@learnpress/quiz":
/*!***************************************!*\
  !*** external {"this":["LP","quiz"]} ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["LP"]["quiz"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!******************************************!*\
  !*** external {"this":["wp","element"]} ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["element"]; }());

/***/ })

/******/ });
//# sourceMappingURL=single-course.js.map