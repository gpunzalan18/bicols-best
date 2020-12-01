/**
 * Slim select js.
 * Custom js file to init the slim select in customizeru
 *
 * @see https://slimselectjs.com/
 * @version 1.26.0
 * @license MIT
 */
(function (api) {

    api.controlConstructor['cuisine_palace_slim_select'] = api.Control.extend({

        ready: function () {
            var control = this;
            var dropDownID = document.getElementById(`slim-select-${control.id}`);
            var dataLimit = null !== dropDownID.getAttribute('data-limit') ? parseInt(dropDownID.getAttribute('data-limit')) : 0;

            /**
             * Initialize the slim select.
             */
            var select = new SlimSelect({
                select: dropDownID,
                searchHighlight: true,
                limit: dataLimit,
                closeOnSelect: (dataLimit > 1) ? false : true,
                allowDeselectOption: true,
                beforeOpen: function () {
                    this.slim.content.style.position = 'relative';
                },
            });

            var getSelectedItem = control.setting.get();
            if ('undefined' !== typeof getSelectedItem) {
                select.set(getSelectedItem);
            }

            this.container.on('change', dropDownID, function () {
                var selectedItem = select.selected();
                control.setting.set(selectedItem);
            });

        }

    });

})(wp.customize);