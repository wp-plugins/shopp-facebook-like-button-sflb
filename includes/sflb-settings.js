	jQuery( document ).ready(function($){
    $('#sflb_width').change(function(){
      var width = $(this).val();
      if ( ! $.isNumeric(width) ) {
        $(this).val(this.defaultValue);
      }
      var layout = $('#sflb_layout').val();
      switch(layout){
        case 'standard':
          if(width < 450) $(this).val('450');
          break;
        case 'button_count':
          if(width < 90) $(this).val('90');
          break;
        case 'box_count':
          if(width < 55) $(this).val('55');
          break;
        case 'button':
          if(width < 47) $(this).val('47');
          break;
      }
    });

    $('#sflb_layout').change(function(){
      var layout = $(this).val();
      var width = $('#sflb_width').val();
      switch(layout){
        case 'standard':
          if(width < 450) $('#sflb_width').val('450');
          break;
        case 'button_count':
          if(width < 90) $('#sflb_width').val('90');
          break;
        case 'box_count':
          if(width < 55) $('#sflb_width').val('55');
          break;
        case 'button':
          if(width < 47) $('#sflb_width').val('47');
          break;
      }
    });

    $('#sflb_share').change(function(){
      if ( 'share' != $(this).val() ) {
        $('#sflb_layout option[value=standard]').removeAttr('disabled').attr('selected', 'selected').siblings().removeAttr('selected');
        $('#sflb_layout option[value=link]').attr('disabled', 'disabled');
        $('#sflb_layout option[value=icon_link]').attr('disabled', 'disabled');
        $('#sflb_layout option[value=icon]').attr('disabled', 'disabled');
      }
      if ( 'share' == $(this).val() ) {
        $('#sflb_layout option[value=standard]').attr('disabled', 'disabled');
        $('#sflb_layout option[value=link]').removeAttr('disabled');
        $('#sflb_layout option[value=icon_link]').removeAttr('disabled').attr('selected', 'selected').siblings().removeAttr('selected');
        $('#sflb_layout option[value=icon]').removeAttr('disabled');

      }
    });

    $('#sflb_og_image_size').change(function(){
      size = $(this).val();
      if ( ! $.isNumeric(size) ) {
        $(this).val(this.defaultValue);
      }
      if (size < 50) $(this).val('50');
      if (size > 96) $(this).val('96');
    }); 
	}); (jQuery); 