import '../scss/admin.scss';

(function($) {
  function init() {
    var blocks = document.querySelectorAll('.layout:not(.acf-clone)');

    for (var i = 0; i < blocks.length; i++) {
      collapse(blocks[i]);
      appendBlockTitle(blocks[i]);
    }
  }

  function collapse(el) {
    el.classList.add('-collapsed');
  }

  function readTextInputs(el) {
    var selectors = ['input[name*="_headline"]', 'input[name*="_title"]'];
    var textInput = el.querySelector(selectors.join(','));

    return textInput ? textInput.value : '';
  }

  function readTextareas(el) {
    var selectors = ['textarea[name*="_content"], textarea[name*="_text"]'];
    var textarea = el.querySelector(selectors.join(','));

    return textarea
      ? jQuery('<div>' + textarea.value + '</div>')
        .find('h1,h2,h3')
        .text()
      : '';
  }

  function readSummaryField(el) {
    var selectedLayout = el.querySelector(
      '[data-name="layout"] label.selected',
    );

    var selectedContent = el.querySelector(
      '[data-name="content"] label.selected',
    );

    var layoutText = selectedLayout !== null ? selectedLayout.textContent : '';
    var contentText =
      selectedContent !== null ? selectedContent.textContent : '';

    return layoutText + ' | ' + contentText;
  }

  /**
   * @todo this can be achieved with PHP/ACF Javascript API
   */

  function appendBlockTitle(el) {
    var handle = el.querySelector('.acf-fc-layout-handle');

    if (!handle) return false;

    var blockName = handle.parentNode.getAttribute('data-layout');
    var blockTitle = '';

    if (blockName === 'Summary') {
      blockTitle = readSummaryField(el);
    } else {
      blockTitle = readTextInputs(el) || readTextareas(el);
    }

    handle.setAttribute('data-block-title', blockTitle);
  }

  window.addEventListener('DOMContentLoaded', () => {
    init();
  });
})(jQuery);
