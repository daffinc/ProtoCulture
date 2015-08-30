jQuery(document).ready(function($) {
  $('#option-tree-logo').find('a').attr('href', function(index, old) {
    return old.replace('http://wordpress.org/extend/plugins/option-tree/', '$deSiteURL');
  });

  $('#setting_den_advanced .format-setting-inner').change(function() {
    $('#tab_den_advanced_settings').toggle('800');
  });

  if ($('#setting_den_advanced .format-setting-inner input[type=checkbox]:checked').val() !== undefined) {
    $('#tab_den_advanced_settings').show();
  }

  $('#setting_den_active_slider .format-setting-inner').change(function() {
    $('#setting_den_slider').toggle('800');
  });

  if ($('#setting_den_active_slider .format-setting-inner input[type=checkbox]:checked').val() !== undefined) {
    $('#setting_den_slider').show();
  }


  $('#setting_den_easing .format-setting-inner').change(function() {
    $('#setting_den_easingver').toggle('800');
  });

  if ($('#setting_den_easing .format-setting-inner input[type=checkbox]:checked').val() !== undefined) {
    $('#setting_den_easingver').show();
  }

  $('#setting_den_mousewheel .format-setting-inner').change(function() {
    $('#setting_den_mousewheelver').toggle('800');
  });

  if ($('#setting_den_mousewheel .format-setting-inner input[type=checkbox]:checked').val() !== undefined) {
    $('#setting_den_mousewheelver').show();
  }

  $('#setting_den_jquery-ui-core .format-setting-inner').change(function() {
    $('#setting_den_jqueryuiver').toggle('800');
    $('#setting_den_jquery-ui-css').toggle('800');

  });

  if ($('#setting_den_jquery-ui-core .format-setting-inner input[type=checkbox]:checked').val() !== undefined) {
    $('#setting_den_jqueryuiver').show();
    $('#setting_den_jquery-ui-css').show();

  }

  $('#setting_den_jquery-ui-css .format-setting-inner').change(function() {
    $('#setting_den_jqueryuicssver').toggle('800');

  });

  if ($('#setting_den_jquery-ui-css .format-setting-inner input[type=checkbox]:checked').val() !== undefined) {
    $('#setting_den_jqueryuicssver').show();

  }

});