<?php include('settings_header.php'); ?>


 <div class="custom-field-col-left">

  <div class="mw-custom-field-group ">
  <label class="mw-ui-label" for="input_field_label<?php print $rand; ?>">
    <?php _e('Title'); ?>
  </label>

    <input type="text" class="mw-ui-field" value="<?php print ($data['custom_field_name']) ?>" name="custom_field_name" id="input_field_label<?php print $rand; ?>">

</div>
</div>



   <div class="custom-field-col-right">

      <label class="mw-ui-label" for="custom_field_value<?php print $rand; ?>"><?php _e("Value"); ?></label>

        <input type="text" class="mw-ui-field"  name="custom_field_value"  value="<?php print ($data['custom_field_value']) ?>" id="custom_field_value<?php print $rand; ?>">

        <label class="mw-ui-check"><input type="checkbox"  class="mw-custom-field-option" name="options[required]"  <?php if(isset($data['options']) == true and isset($data['options']["required"]) == true): ?> checked="checked" <?php endif; ?> value="1"><span></span><span><?php _e("Required"); ?>?</span></label>
    <?php print $savebtn; ?>
    </div>

    <?php include('settings_footer.php'); ?>
