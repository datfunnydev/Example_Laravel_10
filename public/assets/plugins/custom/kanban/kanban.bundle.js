!function r(a,c,d){function s(t,e){if(!c[t]){if(!a[t]){var n="function"==typeof require&&require;if(!e&&n)return n(t,!0);if(u)return u(t,!0);var i=new Error("Cannot find module '"+t+"'");throw i.code="MODULE_NOT_FOUND",i}var o=c[t]={exports:{}};a[t][0].call(o.exports,function(e){return s(a[t][1][e]||e)},o,o.exports,r,a,c,d)}return c[t].exports}for(var u="function"==typeof require&&require,e=0;e<d.length;e++)s(d[e]);return s}({1:[function(e,t,n){var i=e("dragula");!function(){this.jKanban=function(){var b=this,e={enabled:!1};this._disallowedItemProperties=["id","title","click","drag","dragend","drop","order"],this.element="",this.container="",this.boardContainer=[],this.handlers=[],this.dragula=i,this.drake="",this.drakeBoard="",this.addItemButton=!1;var t={element:"",gutter:"15px",widthBoard:"250px",responsive:"700",responsivePercentage:!(this.buttonContent="+"),boards:[],dragBoards:!0,dragItems:!0,addItemButton:!1,buttonContent:"+",itemHandleOptions:this.itemHandleOptions=e,dragEl:function(e,t){},dragendEl:function(e){},dropEl:function(e,t,n,i){},dragBoard:function(e,t){},dragendBoard:function(e){},dropBoard:function(e,t,n,i){},click:function(e){},buttonClick:function(e,t){}};function y(e){e.addEventListener("click",function(e){e.preventDefault(),b.options.click(this),"function"==typeof this.clickfn&&this.clickfn(this)})}function w(e,t){e.addEventListener("click",function(e){e.preventDefault(),b.options.buttonClick(this,t)})}function r(t){var n=[];return b.options.boards.map(function(e){if(e.id===t)return n.push(e)}),n[0]}function E(e,t){for(var n in t)-1<b._disallowedItemProperties.indexOf(n)||e.setAttribute("data-"+n,t[n])}function T(e){var t=e;if(b.options.itemHandleOptions.enabled)if(void 0===(b.options.itemHandleOptions.customHandler||void 0)){var n=b.options.itemHandleOptions.customCssHandler,i=b.options.itemHandleOptions.customCssIconHandler;void 0===(n||void 0)&&(n="drag_handler"),void 0===(i||void 0)&&(i=n+"_icon"),t="<div class='item_handle "+n+"'><i class='item_handle "+i+"'></i></div><div>"+t+"</div>"}else t=b.options.itemHandleOptions.customHandler.replace("%s",t);return t}arguments[0]&&"object"==typeof arguments[0]&&(this.options=function(e,t){var n;for(n in t)t.hasOwnProperty(n)&&(e[n]=t[n]);return e}(t,arguments[0])),this.__getCanMove=function(e){return b.options.itemHandleOptions.enabled?b.options.itemHandleOptions.handleClass?e.classList.contains(b.options.itemHandleOptions.handleClass):e.classList.contains("item_handle"):!!b.options.dragItems},this.init=function(){!function(){b.element=document.querySelector(b.options.element);var e=document.createElement("div");e.classList.add("kanban-container"),b.container=e,b.addBoards(b.options.boards,!0),b.element.appendChild(b.container)}(),window.innerWidth>b.options.responsive&&(b.drakeBoard=b.dragula([b.container],{moves:function(e,t,n,i){return!!b.options.dragBoards&&(n.classList.contains("kanban-board-header")||n.classList.contains("kanban-title-board"))},accepts:function(e,t,n,i){return t.classList.contains("kanban-container")},revertOnSpill:!0,direction:"horizontal"}).on("drag",function(e,t){e.classList.add("is-moving"),b.options.dragBoard(e,t),"function"==typeof e.dragfn&&e.dragfn(e,t)}).on("dragend",function(e){!function(){for(var e=1,t=0;t<b.container.childNodes.length;t++)b.container.childNodes[t].dataset.order=e++}(),e.classList.remove("is-moving"),b.options.dragendBoard(e),"function"==typeof e.dragendfn&&e.dragendfn(e)}).on("drop",function(e,t,n,i){e.classList.remove("is-moving"),b.options.dropBoard(e,t,n,i),"function"==typeof e.dropfn&&e.dropfn(e,t,n,i)}),b.drake=b.dragula(b.boardContainer,{moves:function(e,t,n,i){return b.__getCanMove(n)},revertOnSpill:!0}).on("cancel",function(e,t,n){b.enableAllBoards()}).on("drag",function(e,t){var n=e.getAttribute("class");if(""!==n&&-1<n.indexOf("not-draggable"))b.drake.cancel(!0);else{e.classList.add("is-moving");var i=r(t.parentNode.dataset.id);void 0!==i.dragTo&&b.options.boards.map(function(e){-1===i.dragTo.indexOf(e.id)&&e.id!==t.parentNode.dataset.id&&b.findBoard(e.id).classList.add("disabled-board")}),b.options.dragEl(e,t),null!==e&&"function"==typeof e.dragfn&&e.dragfn(e,t)}}).on("dragend",function(e){b.options.dragendEl(e),null!==e&&"function"==typeof e.dragendfn&&e.dragendfn(e)}).on("drop",function(e,t,n,i){b.enableAllBoards();var o=r(n.parentNode.dataset.id);void 0!==o.dragTo&&-1===o.dragTo.indexOf(t.parentNode.dataset.id)&&t.parentNode.dataset.id!==n.parentNode.dataset.id&&b.drake.cancel(!0),null!==e&&(!1===b.options.dropEl(e,t,n,i)&&b.drake.cancel(!0),e.classList.remove("is-moving"),"function"==typeof e.dropfn&&e.dropfn(e,t,n,i))}))},this.enableAllBoards=function(){var e=document.querySelectorAll(".kanban-board");if(0<e.length&&void 0!==e)for(var t=0;t<e.length;t++)e[t].classList.remove("disabled-board")},this.addElement=function(e,t){var n=b.element.querySelector('[data-id="'+e+'"] .kanban-drag'),i=document.createElement("div");return i.classList.add("kanban-item"),void 0!==t.id&&""!==t.id&&i.setAttribute("data-eid",t.id),t.class&&Array.isArray(t.class)&&t.class.forEach(function(e){i.classList.add(e)}),i.innerHTML=T(t.title),i.clickfn=t.click,i.dragfn=t.drag,i.dragendfn=t.dragend,i.dropfn=t.drop,E(i,t),y(i),b.options.itemHandleOptions.enabled&&(i.style.cursor="default"),n.appendChild(i),b},this.addForm=function(e,t){var n=b.element.querySelector('[data-id="'+e+'"] .kanban-drag'),i=t.getAttribute("class");return t.setAttribute("class",i+" not-draggable"),n.appendChild(t),b},this.addBoards=function(e,t){if(b.options.responsivePercentage)if(b.container.style.width="100%",b.options.gutter="1%",window.innerWidth>b.options.responsive)var n=(100-2*e.length)/e.length;else n=100-2*e.length;else n=b.options.widthBoard;var i=b.options.addItemButton,o=b.options.buttonContent;for(var r in e){var a=e[r];t||b.options.boards.push(a),b.options.responsivePercentage||(""===b.container.style.width?b.container.style.width=parseInt(n)+2*parseInt(b.options.gutter)+"px":b.container.style.width=parseInt(b.container.style.width)+parseInt(n)+2*parseInt(b.options.gutter)+"px");var c=document.createElement("div");c.dataset.id=a.id,c.dataset.order=b.container.childNodes.length+1,c.classList.add("kanban-board"),b.options.responsivePercentage?c.style.width=n+"%":c.style.width=n,c.style.marginLeft=b.options.gutter,c.style.marginRight=b.options.gutter;var d=document.createElement("header");if(""!==a.class&&void 0!==a.class)var s=a.class.split(",");else s=[];if(d.classList.add("kanban-board-header"),s.map(function(e){d.classList.add(e)}),d.innerHTML='<div class="kanban-title-board">'+a.title+"</div>",i){var u=document.createElement("BUTTON"),l=document.createTextNode(o);u.setAttribute("class","kanban-title-button btn btn-default btn-xs"),u.appendChild(l),d.appendChild(u),w(u,a.id)}var f=document.createElement("main");if(f.classList.add("kanban-drag"),""!==a.bodyClass&&void 0!==a.bodyClass)var p=a.bodyClass.split(",");else p=[];for(var v in p.map(function(e){f.classList.add(e)}),b.boardContainer.push(f),a.item){var m=a.item[v],h=document.createElement("div");h.classList.add("kanban-item"),m.id&&(h.dataset.eid=m.id),m.class&&Array.isArray(m.class)&&m.class.forEach(function(e){h.classList.add(e)}),h.innerHTML=T(m.title),h.clickfn=m.click,h.dragfn=m.drag,h.dragendfn=m.dragend,h.dropfn=m.drop,E(h,m),y(h),b.options.itemHandleOptions.enabled&&(h.style.cursor="default"),f.appendChild(h)}var g=document.createElement("footer");c.appendChild(d),c.appendChild(f),c.appendChild(g),b.container.appendChild(c)}return b},this.findBoard=function(e){return b.element.querySelector('[data-id="'+e+'"]')},this.getParentBoardID=function(e){return"string"==typeof e&&(e=b.element.querySelector('[data-eid="'+e+'"]')),null===e?null:e.parentNode.parentNode.dataset.id},this.moveElement=function(e,t,n){if(e!==this.getParentBoardID(t))return this.removeElement(t),this.addElement(e,n)},this.replaceElement=function(e,t){var n=e;return"string"==typeof n&&(n=b.element.querySelector('[data-eid="'+e+'"]')),n.innerHTML=t.title,n.clickfn=t.click,n.dragfn=t.drag,n.dragendfn=t.dragend,n.dropfn=t.drop,E(n,t),b},this.findElement=function(e){return b.element.querySelector('[data-eid="'+e+'"]')},this.getBoardElements=function(e){return b.element.querySelector('[data-id="'+e+'"] .kanban-drag').childNodes},this.removeElement=function(e){return"string"==typeof e&&(e=b.element.querySelector('[data-eid="'+e+'"]')),null!==e&&("function"==typeof e.remove?e.remove():e.parentNode.removeChild(e)),b},this.removeBoard=function(e){var t=null;"string"==typeof e&&(t=b.element.querySelector('[data-id="'+e+'"]')),null!==t&&("function"==typeof t.remove?t.remove():t.parentNode.removeChild(t));for(var n=0;n<b.options.boards.length;n++)if(b.options.boards[n].id===e){b.options.boards.splice(n,1);break}return b},this.onButtonClick=function(e){},this.init()}}()},{dragula:9}],2:[function(e,t,n){t.exports=function(e,t){return Array.prototype.slice.call(e,t)}},{}],3:[function(e,t,n){"use strict";var i=e("ticky");t.exports=function(e,t,n){e&&i(function(){e.apply(n||null,t||[])})}},{ticky:11}],4:[function(e,t,n){"use strict";var c=e("atoa"),d=e("./debounce");t.exports=function(o,e){var r=e||{},a={};return void 0===o&&(o={}),o.on=function(e,t){return a[e]?a[e].push(t):a[e]=[t],o},o.once=function(e,t){return t._once=!0,o.on(e,t),o},o.off=function(e,t){var n=arguments.length;if(1===n)delete a[e];else if(0===n)a={};else{var i=a[e];if(!i)return o;i.splice(i.indexOf(t),1)}return o},o.emit=function(){var e=c(arguments);return o.emitterSnapshot(e.shift()).apply(this,e)},o.emitterSnapshot=function(i){var e=(a[i]||[]).slice(0);return function(){var t=c(arguments),n=this||o;if("error"===i&&!1!==r.throws&&!e.length)throw 1===t.length?t[0]:t;return e.forEach(function(e){r.async?d(e,t,n):e.apply(n,t),e._once&&o.off(i,e)}),o}},o}},{"./debounce":3,atoa:2}],5:[function(n,i,e){(function(o){"use strict";var r=n("custom-event"),a=n("./eventmap"),c=o.document,e=function(e,t,n,i){return e.addEventListener(t,n,i)},t=function(e,t,n,i){return e.removeEventListener(t,n,i)},d=[];function s(e,t,n){var i=function(e,t,n){var i,o;for(i=0;i<d.length;i++)if((o=d[i]).element===e&&o.type===t&&o.fn===n)return i}(e,t,n);if(i){var o=d[i].wrapper;return d.splice(i,1),o}}o.addEventListener||(e=function(e,t,n){return e.attachEvent("on"+t,function(e,t,n){var i=s(e,t,n)||function(n,e,i){return function(e){var t=e||o.event;t.target=t.target||t.srcElement,t.preventDefault=t.preventDefault||function(){t.returnValue=!1},t.stopPropagation=t.stopPropagation||function(){t.cancelBubble=!0},t.which=t.which||t.keyCode,i.call(n,t)}}(e,0,n);return d.push({wrapper:i,element:e,type:t,fn:n}),i}(e,t,n))},t=function(e,t,n){var i=s(e,t,n);if(i)return e.detachEvent("on"+t,i)}),i.exports={add:e,remove:t,fabricate:function(e,t,n){var i=-1===a.indexOf(t)?new r(t,{detail:n}):function(){var e;c.createEvent?(e=c.createEvent("Event")).initEvent(t,!0,!0):c.createEventObject&&(e=c.createEventObject());return e}();e.dispatchEvent?e.dispatchEvent(i):e.fireEvent("on"+t,i)}}}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{"./eventmap":6,"custom-event":7}],6:[function(e,o,t){(function(e){"use strict";var t=[],n="",i=/^on/;for(n in e)i.test(n)&&t.push(n.slice(2));o.exports=t}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{}],7:[function(e,n,t){(function(e){var t=e.CustomEvent;n.exports=function(){try{var e=new t("cat",{detail:{foo:"bar"}});return"cat"===e.type&&"bar"===e.detail.foo}catch(e){}return!1}()?t:"function"==typeof document.createEvent?function(e,t){var n=document.createEvent("CustomEvent");return t?n.initCustomEvent(e,t.bubbles,t.cancelable,t.detail):n.initCustomEvent(e,!1,!1,void 0),n}:function(e,t){var n=document.createEventObject();return n.type=e,t?(n.bubbles=Boolean(t.bubbles),n.cancelable=Boolean(t.cancelable),n.detail=t.detail):(n.bubbles=!1,n.cancelable=!1,n.detail=void 0),n}}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{}],8:[function(e,t,n){"use strict";var i={},o="(?:^|\\s)",r="(?:\\s|$)";function a(e){var t=i[e];return t?t.lastIndex=0:i[e]=t=new RegExp(o+e+r,"g"),t}t.exports={add:function(e,t){var n=e.className;n.length?a(t).test(n)||(e.className+=" "+t):e.className=t},rm:function(e,t){e.className=e.className.replace(a(t)," ").trim()}}},{}],9:[function(e,t,n){(function(o){"use strict";var M=e("contra/emitter"),X=e("crossvent"),Y=e("./classes"),j=document,F=j.documentElement;function R(e,t,n,i){o.navigator.pointerEnabled?X[t](e,{mouseup:"pointerup",mousedown:"pointerdown",mousemove:"pointermove"}[n],i):o.navigator.msPointerEnabled?X[t](e,{mouseup:"MSPointerUp",mousedown:"MSPointerDown",mousemove:"MSPointerMove"}[n],i):(X[t](e,{mouseup:"touchend",mousedown:"touchstart",mousemove:"touchmove"}[n],i),X[t](e,n,i))}function U(e){if(void 0!==e.touches)return e.touches.length;if(void 0!==e.which&&0!==e.which)return e.which;if(void 0!==e.buttons)return e.buttons;var t=e.button;return void 0!==t?1&t?1:2&t?3:4&t?2:0:void 0}function K(e,t){return void 0!==o[t]?o[t]:F.clientHeight?F[e]:j.body[e]}function z(e,t,n){var i,o=e||{},r=o.className;return o.className+=" gu-hide",i=j.elementFromPoint(t,n),o.className=r,i}function W(){return!1}function V(){return!0}function $(e){return e.width||e.right-e.left}function G(e){return e.height||e.bottom-e.top}function J(e){return e.parentNode===j?null:e.parentNode}function Q(e){return"INPUT"===e.tagName||"TEXTAREA"===e.tagName||"SELECT"===e.tagName||function e(t){if(!t)return!1;if("false"===t.contentEditable)return!1;if("true"===t.contentEditable)return!0;return e(J(t))}(e)}function Z(t){return t.nextElementSibling||function(){var e=t;for(;e=e.nextSibling,e&&1!==e.nodeType;);return e}()}function ee(e,t){var n=function(e){return e.targetTouches&&e.targetTouches.length?e.targetTouches[0]:e.changedTouches&&e.changedTouches.length?e.changedTouches[0]:e}(t),i={pageX:"clientX",pageY:"clientY"};return e in i&&!(e in n)&&i[e]in n&&(e=i[e]),n[e]}t.exports=function(e,t){var p,v,m,h,g,r,a,b,y,w,n;1===arguments.length&&!1===Array.isArray(e)&&(t=e,e=[]);var c,E=null,T=t||{};void 0===T.moves&&(T.moves=V),void 0===T.accepts&&(T.accepts=V),void 0===T.invalid&&(T.invalid=function(){return!1}),void 0===T.containers&&(T.containers=e||[]),void 0===T.isContainer&&(T.isContainer=W),void 0===T.copy&&(T.copy=!1),void 0===T.copySortSource&&(T.copySortSource=!1),void 0===T.revertOnSpill&&(T.revertOnSpill=!1),void 0===T.removeOnSpill&&(T.removeOnSpill=!1),void 0===T.direction&&(T.direction="vertical"),void 0===T.ignoreInputTextSelection&&(T.ignoreInputTextSelection=!0),void 0===T.mirrorContainer&&(T.mirrorContainer=j.body);var C=M({containers:T.containers,start:function(e){var t=k(e);t&&S(t)},end:x,cancel:N,remove:I,destroy:function(){i(!0),O({})},canMove:function(e){return!!k(e)},dragging:!1});return!0===T.removeOnSpill&&C.on("over",function(e){Y.rm(e,"gu-hide")}).on("out",function(e){C.dragging&&Y.add(e,"gu-hide")}),i(),C;function d(e){return-1!==C.containers.indexOf(e)||T.isContainer(e)}function i(e){var t=e?"remove":"add";R(F,t,"mousedown",l),R(F,t,"mouseup",O)}function s(e){R(F,e?"remove":"add","mousemove",f)}function u(e){var t=e?"remove":"add";X[t](F,"selectstart",o),X[t](F,"click",o)}function o(e){c&&e.preventDefault()}function l(e){if(r=e.clientX,a=e.clientY,!(1!==U(e)||e.metaKey||e.ctrlKey)){var t=e.target,n=k(t);n&&(c=n,s(),"mousedown"===e.type&&(Q(t)?t.focus():e.preventDefault()))}}function f(e){if(c)if(0!==U(e)){if(void 0===e.clientX||e.clientX!==r||void 0===e.clientY||e.clientY!==a){if(T.ignoreInputTextSelection){var t=ee("clientX",e),n=ee("clientY",e);if(Q(j.elementFromPoint(t,n)))return}var i=c;s(!0),u(),x(),S(i);var o=function(e){var t=e.getBoundingClientRect();return{left:t.left+K("scrollLeft","pageXOffset"),top:t.top+K("scrollTop","pageYOffset")}}(m);h=ee("pageX",e)-o.left,g=ee("pageY",e)-o.top,Y.add(w||m,"gu-transit"),function(){if(p)return;var e=m.getBoundingClientRect();(p=m.cloneNode(!0)).style.width=$(e)+"px",p.style.height=G(e)+"px",Y.rm(p,"gu-transit"),Y.add(p,"gu-mirror"),T.mirrorContainer.appendChild(p),R(F,"add","mousemove",P),Y.add(T.mirrorContainer,"gu-unselectable"),C.emit("cloned",p,m,"mirror")}(),P(e)}}else O({})}function k(e){if(!(C.dragging&&p||d(e))){for(var t=e;J(e)&&!1===d(J(e));){if(T.invalid(e,t))return;if(!(e=J(e)))return}var n=J(e);if(n)if(!T.invalid(e,t))if(T.moves(e,n,t,Z(e)))return{item:e,source:n}}}function S(e){!function(e,t){return"boolean"==typeof T.copy?T.copy:T.copy(e,t)}(e.item,e.source)||(w=e.item.cloneNode(!0),C.emit("cloned",w,e.item,"copy")),v=e.source,m=e.item,b=y=Z(e.item),C.dragging=!0,C.emit("drag",m,v)}function x(){if(C.dragging){var e=w||m;B(e,J(e))}}function L(){s(!(c=!1)),u(!0)}function O(e){if(L(),C.dragging){var t=w||m,n=ee("clientX",e),i=ee("clientY",e),o=H(z(p,n,i),n,i);o&&(w&&T.copySortSource||!w||o!==v)?B(t,o):T.removeOnSpill?I():N()}}function B(e,t){var n=J(e);w&&T.copySortSource&&t===v&&n.removeChild(m),A(t)?C.emit("cancel",e,v,v):C.emit("drop",e,t,v,y),_()}function I(){if(C.dragging){var e=w||m,t=J(e);t&&t.removeChild(e),C.emit(w?"cancel":"remove",e,t,v),_()}}function N(e){if(C.dragging){var t=0<arguments.length?e:T.revertOnSpill,n=w||m,i=J(n),o=A(i);!1===o&&t&&(w?i&&i.removeChild(w):v.insertBefore(n,b)),o||t?C.emit("cancel",n,v,v):C.emit("drop",n,i,v,y),_()}}function _(){var e=w||m;L(),p&&(Y.rm(T.mirrorContainer,"gu-unselectable"),R(F,"remove","mousemove",P),J(p).removeChild(p),p=null),e&&Y.rm(e,"gu-transit"),n&&clearTimeout(n),C.dragging=!1,E&&C.emit("out",e,E,v),C.emit("dragend",e),v=m=w=b=y=n=E=null}function A(e,t){var n;return n=void 0!==t?t:p?y:Z(w||m),e===v&&n===b}function H(n,i,o){for(var r=n;r&&!e();)r=J(r);return r;function e(){if(!1===d(r))return!1;var e=q(r,n),t=D(r,e,i,o);return!!A(r,t)||T.accepts(m,r,v,t)}}function P(e){if(p){e.preventDefault();var t=ee("clientX",e),n=ee("clientY",e),i=t-h,o=n-g;p.style.left=i+"px",p.style.top=o+"px";var r=w||m,a=z(p,t,n),c=H(a,t,n),d=null!==c&&c!==E;!d&&null!==c||(E&&f("out"),E=c,d&&f("over"));var s=J(r);if(c!==v||!w||T.copySortSource){var u,l=q(c,a);if(null!==l)u=D(c,l,t,n);else{if(!0!==T.revertOnSpill||w)return void(w&&s&&s.removeChild(r));u=b,c=v}(null===u&&d||u!==r&&u!==Z(r))&&(y=u,c.insertBefore(r,u),C.emit("shadow",r,c,v))}else s&&s.removeChild(r)}function f(e){C.emit(e,r,E,v)}}function q(e,t){for(var n=t;n!==e&&J(n)!==e;)n=J(n);return n===F?null:n}function D(o,t,r,a){var c="horizontal"===T.direction;return t!==o?function(){var e=t.getBoundingClientRect();if(c)return n(r>e.left+$(e)/2);return n(a>e.top+G(e)/2)}():function(){var e,t,n,i=o.children.length;for(e=0;e<i;e++){if(t=o.children[e],n=t.getBoundingClientRect(),c&&n.left+n.width/2>r)return t;if(!c&&n.top+n.height/2>a)return t}return null}();function n(e){return e?Z(t):t}}}}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{"./classes":8,"contra/emitter":4,crossvent:5}],10:[function(e,t,n){var i,o,r=t.exports={};function a(){throw new Error("setTimeout has not been defined")}function c(){throw new Error("clearTimeout has not been defined")}function d(t){if(i===setTimeout)return setTimeout(t,0);if((i===a||!i)&&setTimeout)return i=setTimeout,setTimeout(t,0);try{return i(t,0)}catch(e){try{return i.call(null,t,0)}catch(e){return i.call(this,t,0)}}}!function(){try{i="function"==typeof setTimeout?setTimeout:a}catch(e){i=a}try{o="function"==typeof clearTimeout?clearTimeout:c}catch(e){o=c}}();var s,u=[],l=!1,f=-1;function p(){l&&s&&(l=!1,s.length?u=s.concat(u):f=-1,u.length&&v())}function v(){if(!l){var e=d(p);l=!0;for(var t=u.length;t;){for(s=u,u=[];++f<t;)s&&s[f].run();f=-1,t=u.length}s=null,l=!1,function(t){if(o===clearTimeout)return clearTimeout(t);if((o===c||!o)&&clearTimeout)return o=clearTimeout,clearTimeout(t);try{o(t)}catch(e){try{return o.call(null,t)}catch(e){return o.call(this,t)}}}(e)}}function m(e,t){this.fun=e,this.array=t}function h(){}r.nextTick=function(e){var t=new Array(arguments.length-1);if(1<arguments.length)for(var n=1;n<arguments.length;n++)t[n-1]=arguments[n];u.push(new m(e,t)),1!==u.length||l||d(v)},m.prototype.run=function(){this.fun.apply(null,this.array)},r.title="browser",r.browser=!0,r.env={},r.argv=[],r.version="",r.versions={},r.on=h,r.addListener=h,r.once=h,r.off=h,r.removeListener=h,r.removeAllListeners=h,r.emit=h,r.prependListener=h,r.prependOnceListener=h,r.listeners=function(e){return[]},r.binding=function(e){throw new Error("process.binding is not supported")},r.cwd=function(){return"/"},r.chdir=function(e){throw new Error("process.chdir is not supported")},r.umask=function(){return 0}},{}],11:[function(e,n,t){(function(t){var e;e="function"==typeof t?function(e){t(e)}:function(e){setTimeout(e,0)},n.exports=e}).call(this,e("timers").setImmediate)},{timers:12}],12:[function(d,e,s){(function(e,t){var i=d("process/browser.js").nextTick,n=Function.prototype.apply,o=Array.prototype.slice,r={},a=0;function c(e,t){this._id=e,this._clearFn=t}s.setTimeout=function(){return new c(n.call(setTimeout,window,arguments),clearTimeout)},s.setInterval=function(){return new c(n.call(setInterval,window,arguments),clearInterval)},s.clearTimeout=s.clearInterval=function(e){e.close()},c.prototype.unref=c.prototype.ref=function(){},c.prototype.close=function(){this._clearFn.call(window,this._id)},s.enroll=function(e,t){clearTimeout(e._idleTimeoutId),e._idleTimeout=t},s.unenroll=function(e){clearTimeout(e._idleTimeoutId),e._idleTimeout=-1},s._unrefActive=s.active=function(e){clearTimeout(e._idleTimeoutId);var t=e._idleTimeout;0<=t&&(e._idleTimeoutId=setTimeout(function(){e._onTimeout&&e._onTimeout()},t))},s.setImmediate="function"==typeof e?e:function(e){var t=a++,n=!(arguments.length<2)&&o.call(arguments,1);return r[t]=!0,i(function(){r[t]&&(n?e.apply(null,n):e.call(null),s.clearImmediate(t))}),t},s.clearImmediate="function"==typeof t?t:function(e){delete r[e]}}).call(this,d("timers").setImmediate,d("timers").clearImmediate)},{"process/browser.js":10,timers:12}]},{},[1]);
