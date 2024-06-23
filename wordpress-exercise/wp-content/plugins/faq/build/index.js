/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/edit.js":
/*!*********************!*\
  !*** ./src/edit.js ***!
  \*********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ FAQBlockEdit)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/server-side-render */ "@wordpress/server-side-render");
/* harmony import */ var _wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _index_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./index.js */ "./src/index.js");
/* harmony import */ var _faq_block_css__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./faq-block.css */ "./src/faq-block.css");








function FAQBlockEdit({
  attributes,
  setAttributes
}) {
  const [availableCategories, setAvailableCategories] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)([]);
  const [availableTags, setAvailableTags] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)([]);
  const [availableFAQs, setAvailableFAQs] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)([]);
  const [loading, setLoading] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const [step, setStep] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(1);
  const [dropdown, setDropdown] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(null);
  const {
    selectedCategories = [],
    selectedTags = [],
    selectedFAQs = []
  } = attributes;
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    if (step === 2) {
      fetchCategoriesAndTags();
    }
  }, [step]);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    if (step === 2 && (selectedCategories.length || selectedTags.length)) {
      (0,_index_js__WEBPACK_IMPORTED_MODULE_6__.loadFAQs)(selectedCategories, selectedTags, setAvailableFAQs, setLoading);
    }
  }, [step, selectedCategories, selectedTags]);
  const fetchCategoriesAndTags = async () => {
    try {
      const categoriesResponse = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5___default()({
        path: '/wp/v2/categories'
      });
      const tagsResponse = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5___default()({
        path: '/wp/v2/tags'
      });
      setAvailableCategories(categoriesResponse);
      setAvailableTags(tagsResponse);
    } catch (error) {
      console.error('Error loading categories and tags:', error);
    }
  };
  const handleStart = () => {
    setStep(2);
  };
  const handleNextStep = () => {
    setStep(3);
  };
  const handleDone = () => {
    setStep(4);
  };
  const handleCategorySelection = categoryId => {
    const updatedCategories = selectedCategories.includes(categoryId) ? selectedCategories.filter(id => id !== categoryId) : [...selectedCategories, categoryId];
    setAttributes({
      selectedCategories: updatedCategories
    });
  };
  const handleTagSelection = tagId => {
    const updatedTags = selectedTags.includes(tagId) ? selectedTags.filter(id => id !== tagId) : [...selectedTags, tagId];
    setAttributes({
      selectedTags: updatedTags
    });
  };
  const handleFAQSelection = (faqId, isChecked) => {
    const updatedFAQs = isChecked ? [...selectedFAQs, availableFAQs.find(faq => faq.id === faqId)] : selectedFAQs.filter(faq => faq.id !== faqId);
    setAttributes({
      selectedFAQs: updatedFAQs
    });
  };
  const isCategorySelected = categoryId => selectedCategories.includes(categoryId);
  const isTagSelected = tagId => selectedTags.includes(tagId);
  const isFAQSelected = faqId => selectedFAQs.some(faq => faq.id === faqId);
  const toggleDropdown = menu => {
    setDropdown(dropdown === menu ? null : menu);
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, step === 1 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-block"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", {
    className: "title"
  }, "Add FAQ"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Button, {
    primary: true,
    onClick: handleStart,
    className: "add-faq-button"
  }, "+")), step === 2 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-block"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, "Select Category and Tags"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-block-select"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "dropdown"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "dropdown-toggle",
    onClick: () => toggleDropdown('categories')
  }, "Search md-faq-category ", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: `dropdown-arrow ${dropdown === 'categories' ? 'open' : ''}`
  }, "\u25BC")), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `dropdown-menu ${dropdown === 'categories' ? 'active' : ''}`
  }, availableCategories.map(category => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: category.id
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.CheckboxControl, {
    label: category.name,
    checked: isCategorySelected(category.id),
    onChange: () => handleCategorySelection(category.id)
  }))))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "dropdown"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "dropdown-toggle",
    onClick: () => toggleDropdown('tags')
  }, "Search md-faq-tag ", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: `dropdown-arrow ${dropdown === 'tags' ? 'open' : ''}`
  }, "\u25BC")), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `dropdown-menu ${dropdown === 'tags' ? 'active' : ''}`
  }, availableTags.map(tag => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: tag.id
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.CheckboxControl, {
    label: tag.name,
    checked: isTagSelected(tag.id),
    onChange: () => handleTagSelection(tag.id)
  })))))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, "Select FAQs"), loading, availableFAQs.map(faq => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.CheckboxControl, {
    key: faq.id,
    label: faq.title && faq.title.rendered ? faq.title.rendered : 'Unknown FAQ',
    checked: isFAQSelected(faq.id),
    onChange: isChecked => handleFAQSelection(faq.id, isChecked)
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Button, {
    onClick: handleNextStep
  }, "Next")), step === 3 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-block"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, "Reorder FAQs"), selectedFAQs.map(faq => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: faq.id
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, faq.title ? faq.title.rendered : 'Unknown FAQ'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Button, {
    onClick: handleDone
  }, "Done")), step === 4 && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "faq-block"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, "Selected FAQs"), selectedFAQs.map(faq => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: faq.id
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, faq.title ? faq.title.rendered : 'Unknown FAQ'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)((_wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_4___default()), {
    block: "faq-block/faq",
    attributes: {
      selectedFAQs: selectedFAQs.map(faq => faq.id)
    }
  })));
}

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   loadFAQs: () => (/* binding */ loadFAQs)
/* harmony export */ });
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/style.scss");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/edit.js");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./block.json */ "./src/block.json");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./save */ "./src/save.js");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5__);




 // Import the save function

(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(_block_json__WEBPACK_IMPORTED_MODULE_3__.name, {
  attributes: {
    selectedFAQs: {
      type: 'array',
      default: []
    }
  },
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"],
  save: _save__WEBPACK_IMPORTED_MODULE_4__["default"]
});

const loadFAQs = async (selectedCategories, selectedTags, setSelectedFAQs, setLoading) => {
  setLoading(true);
  try {
    // Ensure that selectedCategories and selectedTags are arrays
    if (!Array.isArray(selectedCategories) || !Array.isArray(selectedTags)) {
      throw new Error('Selected categories and tags must be arrays.');
    }

    // Convert any non-integer IDs to integers
    const categoryIds = selectedCategories.map(id => parseInt(id, 10)).filter(id => !isNaN(id));
    const tagIds = selectedTags.map(id => parseInt(id, 10)).filter(id => !isNaN(id));

    // Construct the URL with properly formatted query parameters
    const categoriesQueryParam = categoryIds.length > 0 ? `categories=${categoryIds.join(',')}` : '';
    const tagsQueryParam = tagIds.length > 0 ? `tags=${tagIds.join(',')}` : '';
    const queryParams = [categoriesQueryParam, tagsQueryParam].filter(param => param).join('&');
    const url = `/wp/v2/faq?${queryParams}&per_page=100`;
    const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_5___default()({
      path: url
    });
    setSelectedFAQs(response.map(faq => ({
      ...faq,
      isChecked: false
    }))); // Set initial isChecked to false
  } catch (error) {
    console.error('Error loading FAQs:', error);
    setSelectedFAQs([]); // Set to empty array in case of error
  } finally {
    setLoading(false);
  }
};

/***/ }),

/***/ "./src/save.js":
/*!*********************!*\
  !*** ./src/save.js ***!
  \*********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const save = () => {
  return null;
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (save);

/***/ }),

/***/ "./src/faq-block.css":
/*!***************************!*\
  !*** ./src/faq-block.css ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/style.scss":
/*!************************!*\
  !*** ./src/style.scss ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["wp"]["apiFetch"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/server-side-render":
/*!******************************************!*\
  !*** external ["wp","serverSideRender"] ***!
  \******************************************/
/***/ ((module) => {

module.exports = window["wp"]["serverSideRender"];

/***/ }),

/***/ "./src/block.json":
/*!************************!*\
  !*** ./src/block.json ***!
  \************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"apiVersion":2,"name":"faq-block/faq","title":"FAQ Block","category":"widgets","icon":"excerpt-view","description":"A block to display FAQs","keywords":["faq","questions","answers"],"supports":{"html":false},"attributes":{"selectedCategories":{"type":"array","default":[]},"selectedTags":{"type":"array","default":[]},"selectedFAQs":{"type":"array","default":[]}},"textdomain":"faq","editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"index": 0,
/******/ 			"./style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = globalThis["webpackChunkfaq"] = globalThis["webpackChunkfaq"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["./style-index"], () => (__webpack_require__("./src/index.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map