(function ($, Drupal, drupalSettings) {

  /**
   * Display Drupal status messages as toastr messages.
   *
   * @type {{attach: Drupal.behaviors.toastrMessages.attach}}
   */
  Drupal.behaviors.toastrMessages = {
    attach: function attach(context, settings) {
      if (typeof settings.toastr !== 'undefined') {
        Object.keys(settings.toastr.messages).forEach(function (type) {
          settings.toastr.messages[type].forEach(function (item) {
            toastr.options = {
              "closeButton": settings.toastr.settings.toastr_close_button,
              "newestOnTop": settings.toastr.settings.toastr_newest,
              "progressBar": settings.toastr.settings.toastr_progress_bar,
              "positionClass": settings.toastr.settings.toastr_toast_position,
              "preventDuplicates": settings.toastr.settings.toastr_prevent_duplicate,
              "showDuration": settings.toastr.settings.toastr_show_duration,
              "hideDuration": settings.toastr.settings.toastr_hide_duration,
              "timeOut": settings.toastr.settings.toastr_leave_errors ? type !== 'status' ? "0" : settings.toastr.settings.toastr_timeout : settings.toastr.settings.toastr_timeout,
              "extendedTimeOut": settings.toastr.settings.toastr_leave_errors ? type !== 'status' ? "0" : settings.toastr.settings.toastr_extended_timeout : settings.toastr.settings.toastr_extended_timeout,
              "showEasing": settings.toastr.settings.toastr_show_easing,
              "hideEasing": settings.toastr.settings.toastr_hide_easing,
              "showMethod": settings.toastr.settings.toastr_show_method,
              "hideMethod": settings.toastr.settings.toastr_hide_method,
              "tapToDismiss": settings.toastr.settings.toastr_tap_to_dismiss
            };
            var toastr_message_type = type;
            if (type === 'status') {
              toastr_message_type = 'success';
            }
            toastr[toastr_message_type](item);
          });
        });
      }
    }
  };

})(jQuery, Drupal, drupalSettings);
