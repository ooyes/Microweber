<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<?php /*<script src="<?php   print( INCLUDES_URL);  ?>js/jquery.js" type="text/javascript"></script>*/ ?>

<script src="<?php   print( SITE_URL);  ?>apijs" type="text/javascript"></script>
<script src="<?php   print( INCLUDES_URL);  ?>js/jquery-ui-1.8.20.custom.js" type="text/javascript"></script>
<?php /* <script src="http://code.jquery.com/ui/jquery-ui-git.js" type="text/javascript"></script> */ ?>
<script src="<?php   print( INCLUDES_URL);  ?>js/edit_libs.js" type="text/javascript"></script>

<link href="<?php   print( INCLUDES_URL);  ?>api/api.css" rel="stylesheet" type="text/css" />
<link href="<?php   print( INCLUDES_URL);  ?>css/mw_framework.css" rel="stylesheet" type="text/css" />
<link href="<?php   print( INCLUDES_URL);  ?>css/toolbar.css" rel="stylesheet" type="text/css" />


 <script src="<?php   print( INCLUDES_URL);  ?>js/sortable.js?v=<?php echo uniqid(); ?>" type="text/javascript"></script>
<?php /* <script src="http://c9.io/ooyes/mw/workspace/sortable.js" type="text/javascript"></script>  */ ?>
<script src="<?php   print( INCLUDES_URL);  ?>js/toolbar.js?v=<?php echo uniqid(); ?>" type="text/javascript"></script>
<script type="text/javascript">



        $(document).ready(function () {

           mw.drag.create();


            mw.history.init();
            mw.tools.module_slider.init();
            mw.tools.dropdown();
            mw.tools.toolbar_tabs.init();
            mw.tools.toolbar_slider.init();



        });

		



		    $(document).ready(function () {


 $(".mw_option_field").live("change blur", function () {
                var refresh_modules11 = $(this).attr('data-refresh');
				
				if(refresh_modules11 == undefined){
				    var refresh_modules11 = $(this).attr('data-reload');
				}

				if(refresh_modules11 == undefined){
				    var refresh_modules11 = $(this).parents('.mw_modal_container:first').attr('data-settings-for-module');
 refresh_modules11 = '#'+refresh_modules11;
				}
				

				og = $(this).attr('data-module-id');
				if(og == undefined){
					og = $(this).parents('.mw_modal_container:first').attr('data-settings-for-module') 
				}
                $.ajax({

                    type: "POST",
                    url: "<? print site_url('api/save_option') ?>",
                    data: ({

                        option_key: $(this).attr('name'),
                        option_group: og,
                        option_value: $(this).val()


                    }),
                    success: function () {
                        if (refresh_modules11 != undefined && refresh_modules11 != '') {
                            refresh_modules11 = refresh_modules11.toString()

                            if (window.mw != undefined) {
                                if (window.mw.reload_module != undefined) {
                                    window.mw.reload_module(refresh_modules11);
                                }
                            }
  
                        }

                        //  $(this).addClass("done");
                    }
                });
            });
		
		    });

    </script>

    <span id="show_hide_sub_panel" onclick="mw.toggle_subpanel();"><span id="show_hide_sub_panel_slider"></span><span id="show_hide_sub_panel_info">Hide</span></span>



<div class="mw" id="live_edit_toolbar_holder">
  <div class="mw" id="live_edit_toolbar">
    <div id="mw_toolbar_nav"> <a href="<?php print site_url(); ?>" id="mw_toolbar_logo">Microweber - Live Edit</a>
    



    <?php /* <a href="javascript:;" style="position: absolute;top: 10px;right: 10px;" onclick="mw.extras.fullscreen(document.body);">Fullscreen</a> */  ?>


      <ul id="mw_tabs">
        <li> <a href="#mw_tab_modules"><? _e('Modules'); ?></a> </li>
        <li> <a href="#mw_tab_layouts"><? _e('Layouts'); ?></a> </li>
       

         <li> <a href="#tab_pages"><? _e('Pages'); ?></a> </li>
        <li> <a href="#mw_tab_help"><? _e('Help'); ?></a> </li>
       </ul>

       <a href="#design_bnav" class="mw_ex_tools">Design</a>

    </div>


    <div id="tab_modules" class="mw_toolbar_tab">
        <microweber module="admin/modules/categories_dropdown" />
      <div class="modules_bar_slider bar_slider">
        <div class="modules_bar">
          <microweber module="admin/modules/list" />
        </div>
        <span class="modules_bar_slide_left">&nbsp;</span> <span class="modules_bar_slide_right">&nbsp;</span> </div>
      <div class="mw_clear">&nbsp;</div>
    </div>
    <div id="tab_layouts" class="mw_toolbar_tab">
       
      <microweber module="admin/modules/categories_dropdown" data-for="elements" />
      <div class="modules_bar_slider bar_slider">
        <div class="modules_bar">
          <microweber module="admin/modules/list_elements" />
        </div>
        <span class="modules_bar_slide_left">&nbsp;</span> <span class="modules_bar_slide_right">&nbsp;</span> </div>
    </div>


     <div id="tab_pages" class="mw_toolbar_tab"> 
      <? include(INCLUDES_DIR.'admin'.DS.'content.php') ?>
     </div>

    
    <div id="tab_help" class="mw_toolbar_tab">Help <a href="<?php print site_url('admin'); ?>">Admin</a></div>
    <div id="tab_style_editor" class="mw_toolbar_tab">
      <? //include( 'toolbar_tag_editor.php') ; ?>
    </div>


    <?php include INCLUDES_DIR.'toolbar'.DS.'wysiwyg.php'; ?>


     <span class="mw_editor_btnz ed_btn" onclick="mw.drag.save()"
        style="position: fixed;top: 133px;right:30px; z-index: 2000;">Save</span>

        <span class="mw_editor_btnz ed_btn" onclick="$('.edit:first').html('<div class=\'element\' style=\'height:50px;background:#ffffb9\'>Emptiness</div>')"
        style="position: fixed;top: 133px;right:130px; z-index: 2000;">Empty</span>


    <?php include INCLUDES_DIR.'toolbar'.DS.'wysiwyg_tiny.php'; ?>


    <div id="mw-history-panel"></div>
    <div id="mw-saving-loader"></div>
  </div>


  <!-- /end .mw -->
</div>
<!-- /end mw_holder -->
<span class="mw_editor_btnz" onclick="$('.mw_modal iframe').each(function(){var src = this.src;this.src = '#';this.src =src});"
        style="color:#fff;cursor:pointer;display: inline-block;padding: 5px 10px;background: #6D7983;box-shadow:0 0 5px #ccc;position: fixed;top: 130px;right:130px; z-index: 92000;">Refresh iframes &reg;</span>


      <?php include "design.php"; ?>
