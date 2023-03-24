// window.onload = function() {
//     document.addEventListener("keydown", function(e) {
//         //document.onkeydown = function(e) {
//         // "I" key
//         if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
//             disabledEvent(e);
//         }
//         // "J" key
//         if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
//             disabledEvent(e);
//         }
//         // "S" key + macOS
//         if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
//             disabledEvent(e);
//         }
//         // "U" key
//         if (e.ctrlKey && e.keyCode == 85) {
//             disabledEvent(e);
//         }
//         // "F12" key
//         if (e.keyCode == 123) {
//             disabledEvent(e);
//         }
//     }, false);
//
//     function disabledEvent(e) {
//         if (e.stopPropagation) {
//             e.stopPropagation();
//         } else if (window.event) {
//             window.event.cancelBubble = true;
//         }
//         e.preventDefault();
//         return false;
//     }
// };
const strongPassword = function() {
    return {
        validate: function(input) {
            const value = input.value;
            if (value === '') {
                return {
                    valid: true,
                };
            }

            if (value.length < 8) {
                return {
                    valid: false,
                };
            }

            if (value === value.toLowerCase()) {
                return {
                    valid: false,
                };
            }

            if (value === value.toUpperCase()) {
                return {
                    valid: false,
                };
            }

            if (value.search(/[0-9]/) < 0) {
                return {
                    valid: false,
                };
            }

            return {
                valid: true,
            };
        },
    };
};
