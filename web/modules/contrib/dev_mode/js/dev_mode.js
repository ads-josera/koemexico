(function () {
  "use strict";
  Drupal.behaviors.devMode = {
    attach(context, settings) {
      this.called || console.warn(Drupal.t('Developer mode is enabled. Uninstall the dev_mode module to turn off.'));
      this.called = true;
    },
    // Let's just call the behaviour once.
    called: false,
  }
})();
