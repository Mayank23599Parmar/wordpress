/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/Likes.js":
/*!******************************!*\
  !*** ./src/modules/Likes.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
class Likes {
  constructor() {
    this.likesDiv = document.querySelector(".like-box");
    this.events();
  }
  events() {
    if (this.likesDiv) {
      this.likesDiv.addEventListener("click", this.likeBtnClick.bind(this));
    }
  }
  likeBtnClick(btn) {
    const likeBox = btn.currentTarget;
    if (likeBox.dataset.exists == "yes") {
      this.removeLike(likeBox);
    } else {
      this.addLikes(likeBox);
    }
  }
  async removeLike(likeBox) {
    const url = `${siteData.root_url}/wp-json/university/vi/manage-like`;
    const res = await fetch(url, {
      method: "DELETE",
      body: JSON.stringify({
        likeid: likeBox.dataset.likeid
      }),
      headers: {
        "Content-Type": "application/json",
        "X-WP-Nonce": `${siteData.nonce}`
      }
    });
    const response = await res.json();
    if (response.success) {
      window.location.reload();
    }
    console.log(res);
  }
  async addLikes(likeBox) {
    const url = `${siteData.root_url}/wp-json/university/vi/manage-like`;
    const res = await fetch(url, {
      method: "POST",
      body: JSON.stringify({
        professor_id: likeBox.dataset.profesorid
      }),
      headers: {
        "Content-Type": "application/json",
        "X-WP-Nonce": `${siteData.nonce}`
      }
    });
    const response = await res.json();
    if (response.success) {
      window.location.reload();
    }
    console.log(res);
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Likes);

/***/ }),

/***/ "./src/modules/Mynotes.js":
/*!********************************!*\
  !*** ./src/modules/Mynotes.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
class MyNotes {
  constructor() {
    this.deleteBTN = document.querySelectorAll(".delete-note");
    this.editBTN = document.querySelectorAll(".edit-note");
    this.cancleBtn = document.querySelectorAll(".cancle-note");
    this.updatePost = document.querySelectorAll(".save-note");
    this.createPostBtn = document.querySelector(".create-note");
    this.events();
  }
  //events
  events() {
    //delete notes event
    if (this.deleteBTN) {
      this.deleteBTN.forEach(btn => {
        btn.addEventListener("click", this.deleteNotes.bind(btn));
      });
    }
    // EDIT notes Events
    if (this.editBTN) {
      this.editBTN.forEach(btn => {
        btn.addEventListener("click", this.editNotes.bind(btn));
      });
    }
    // cancle button 
    if (this.cancleBtn) {
      this.cancleBtn.forEach(btn => {
        btn.addEventListener("click", this.cancleBTNClick.bind(btn));
      });
    }
    //update post
    if (this.updatePost) {
      this.updatePost.forEach(btn => {
        btn.addEventListener("click", this.updatePostClick.bind(btn));
      });
    }
    if (this.createPostBtn) {
      this.createPostBtn.addEventListener("submit", this.addNote.bind(this));
    }
  }

  // method 
  async deleteNotes(btn) {
    const id = btn.currentTarget.dataset.id;
    const url = `${siteData.root_url}/wp-json/wp/v2/note/${id}`;
    const res = await fetch(url, {
      method: "DELETE",
      headers: {
        "X-WP-Nonce": `${siteData.nonce}`
      }
    });
    if (res.status == 200) {
      window.location.reload();
    }
    console.log(res, "ddd");
  }
  editNotes(btn) {
    const editBtn = btn.currentTarget;
    const parent = editBtn.closest("li");
    const cancleBtn = parent.querySelector(".cancle-note");
    const input = parent.querySelector(".note-title-field");
    const saveBtn = parent.querySelector(".save-note");
    const textArea = parent.querySelector(".note-body-field");
    if (input && textArea) {
      input.removeAttribute("readonly");
      input.classList.add("note-active-field");
      textArea.removeAttribute("readonly");
      textArea.classList.add("note-active-field");
      editBtn.classList.add("hide");
      editBtn.classList.remove("show");
      cancleBtn.classList.remove("hide");
      cancleBtn.classList.add("show");
      saveBtn.classList.remove("hide");
      saveBtn.classList.add("show");
    }
  }
  cancleBTNClick(btn) {
    const cancletBtn = btn.currentTarget;
    console.log(cancletBtn);
    const parent = cancletBtn.closest("li");
    const editBtn = parent.querySelector(".edit-note");
    const input = parent.querySelector(".note-title-field");
    const textArea = parent.querySelector(".note-body-field");
    const saveBtn = parent.querySelector(".save-note");
    if (input && textArea) {
      input.setAttribute("readonly", true);
      input.classList.remove("note-active-field");
      textArea.setAttribute("readonly", true);
      textArea.classList.remove("note-active-field");
      editBtn.classList.remove("hide");
      editBtn.classList.add("show");
      cancletBtn.classList.remove("show");
      cancletBtn.classList.add("hide");
      saveBtn.classList.remove("show");
      saveBtn.classList.add("hide");
    }
  }
  async updatePostClick(btn) {
    const updatePostBTN = btn.currentTarget;
    const id = updatePostBTN.dataset.id;
    const parent = updatePostBTN.closest("li");
    const input = parent.querySelector(".note-title-field");
    const textArea = parent.querySelector(".note-body-field");
    if (input && textArea) {
      const data = {
        "title": input.value,
        "content": textArea.value
      };
      const url = `${siteData.root_url}/wp-json/wp/v2/note/${id}`;
      const res = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": `${siteData.nonce}`
        },
        body: JSON.stringify(data)
      });
      if (res.status == 200) {
        window.location.reload();
      }
      console.log(res, "aaaa");
    }
  }
  async addNote(e) {
    e.preventDefault();
    const form = e.currentTarget;
    const input = form.querySelector(".title-filed");
    const textArea = form.querySelector(".body-field");
    if (input && textArea) {
      const data = {
        "title": input.value.trim(),
        "content": textArea.value.trim(),
        "status": "publish"
      };
      const id = form.dataset.id;
      const url = `${siteData.root_url}/wp-json/wp/v2/note`;
      const res = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": `${siteData.nonce}`
        },
        body: JSON.stringify(data)
      });
      const response = await res.text();
      console.log(response, "Sss");
      if (res.ok) {
        console.log(res, "Sss");
      }
      console.log(res, "aaaa");
    }
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (MyNotes);

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
/************************************************************************/
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
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_Likes__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/Likes */ "./src/modules/Likes.js");
/* harmony import */ var _modules_Mynotes__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/Mynotes */ "./src/modules/Mynotes.js");


const notes = new _modules_Mynotes__WEBPACK_IMPORTED_MODULE_1__["default"]();
const likes = new _modules_Likes__WEBPACK_IMPORTED_MODULE_0__["default"]();
})();

/******/ })()
;
//# sourceMappingURL=index.js.map