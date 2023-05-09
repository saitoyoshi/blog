'use strict';

function confirmSubmit(message) {
  return function (e) {
    if (!confirm(message)) {
      e.preventDefault();
    }
  }
}
