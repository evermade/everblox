import '../scss/editor.scss';

(function() {
  // Let's add our custom buttons to the editor
  window.tinymce.PluginManager.add('custom_mce_em_buttons', function(
    editor,
    url,
  ) {
    // Let's add our button shortcode
    editor.addButton('custom_mce_em_button', {
      icon: false,
      text: 'Button',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Button',
          body: [
            {
              type: 'textbox',
              name: 'buttonText',
              label: 'Text',
              value: '',
            },
            {
              type: 'textbox',
              name: 'buttonUrl',
              label: 'Link URL',
              value: '',
            },
            {
              type: 'textbox',
              name: 'ariaLabel',
              label: 'ARIA Label',
              value: '',
            },
            {
              type: 'listbox',
              name: 'style',
              label: 'Style',
              values: [
                {
                  text: 'Primary',
                  value: 'Primary',
                },
                {
                  text: 'Secondary',
                  value: 'Secondary',
                },
                {
                  text: 'Text Button',
                  value: 'Text Button',
                },
              ],
            },
          ],
          onsubmit: function(e) {
            editor.insertContent(
              `[button style=&quot;${e.data.style}&quot; text=&quot;${
                e.data.buttonText
              }&quot; url=&quot;${e.data.buttonUrl}&quot; ariaLabel=&quot;${
                e.data.ariaLabel
              }&quot;] ${editor.selection.getContent()}`,
            );
          },
        });
      },
    });

    // Let's add a lorem generator for primary dev use to spin ourselves some content
    editor.addButton('custom_mce_em_lorem', {
      icon: false,
      text: 'Lorem',
      onclick: function() {
        editor.insertContent(
          '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit. Sed augue orci, lacinia eu tincidunt et eleifend nec lacus. Donec ultricies nisl ut felis, suspendisse potenti. Lorem ipsum ligula ut hendrerit mollis, ipsum erat vehicula risus, eu suscipit sem libero nec erat. Aliquam erat volutpat. Sed congue augue vitae neque. Nulla consectetuer porttitor pede. Fusce purus morbi tortor magna condimentum vel, placerat id blandit sit amet tortor.</p>',
        );
      },
    });
  });
})();
