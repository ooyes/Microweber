<?php //$rand = uniqid(); ?>
<?php $my_tree_id = crc32(url_string()); ?>
<?php $active_content_id = '';
if(isset($_REQUEST['edit_content']) and $_REQUEST['edit_content'] != 0){
	$active_content_id = $_REQUEST['edit_content'];
}

 ?>
<script type="text/javascript">






  if(typeof toggle_cats_and_pages === 'undefined'){
              toggle_cats_and_pages = function(){
                  mw.cookie.ui('ToggleCatsAndPages', this.value);
                  _toggle_cats_and_pages();
              }
              _toggle_cats_and_pages = function(callback){
                  var state =  mw.cookie.ui('ToggleCatsAndPages');
                  if(state == 'on'){
                       mw.$(".page_posts_list_tree").show();
                  }
                  else{
                      mw.$(".page_posts_list_tree").hide();
                  }
                  typeof callback === 'function' ? callback.call(state) : '';
              }
    }


              $(document).ready(function(){
                _toggle_cats_and_pages(function(){
                  if(this=='on'){
                    mw.switcher.on(mwd.getElementById('toggle_cats_and_pages'));
                  }
                  else{
                    mw.switcher.off(mwd.getElementById('toggle_cats_and_pages'));
                  }
                });
              });
              $(document.body).ajaxStop(function(){
                _toggle_cats_and_pages(function(){
                  if(this=='on'){
                    mw.switcher.on(mwd.getElementById('toggle_cats_and_pages'));
                  }
                  else{
                    mw.switcher.off(mwd.getElementById('toggle_cats_and_pages'));
                  }
                });
              });


            </script>
<script type="text/javascript">



<?php   include_once( INCLUDES_DIR . 'api/treerenderer.php');
 ?>



$(document).ready(function(){






    mw.treeRenderer.appendUI();

 mw.treeRenderer.appendUI('.page_posts_list_tree');
    mw.on.hashParam("page-posts", function(){
        mw_set_edit_posts(this);
    });


	if(mw.url.windowHashParam ("action") === undefined){
		}




    mw.on.moduleReload("pages_tree_toolbar", function(e){

        mw.treeRenderer.appendUI();

    });

    mw.on.moduleReload("pages_edit_container", function(){
        mw.treeRenderer.appendUI("#pages_edit_container .page_posts_list_tree");

    });




   $(mwd.body).ajaxStop(function(){
      $(this).removeClass("loading");
  });




});







function mw_delete_content($p_id){
	 mw.$('#pages_edit_container').attr('data-content-id',$p_id);
  	 mw.load_module('content/edit_post','#pages_edit_container');
}





function mw_select_page_for_editing($p_id){



 

  	 var  active_item = $('#pages_tree_container_<?php print $my_tree_id; ?> .active-bg').first();




  //  var active_item_is_page = active_item.attr('data-page-id');
       var active_item_is_page  = $p_id;
     var  active_item_is_parent = mw.url.windowHashParam("parent-page");

	  var active_item_is_category = active_item.attr('data-category-id');
	 if(active_item_is_category != undefined){
			  mw.$('#pages_edit_container').attr('data-parent-category-id',active_item_is_category);
			  var  active_item_parent_page = $('#pages_tree_container_<?php print $my_tree_id; ?> .active-bg').parents('.have_category').first();
			   if(active_item_parent_page != undefined){
					var active_item_is_page = active_item_parent_page.attr('data-page-id');

			   } else {
				  var  active_item_parent_page = $('#pages_tree_container_<?php print $my_tree_id; ?> .active-bg').parents('.is_page').first();
				   if(active_item_parent_page != undefined){
						var active_item_is_page = active_item_parent_page.attr('data-page-id');

				   }

			   }


	 } else {
	    mw.$('#pages_edit_container').removeAttr('data-parent-category-id');

	 }

	  if(active_item_is_parent != undefined){
	       mw.$(".pages_tree_item.active-bg").children().first().removeClass('active-bg') ;
	     mw.$(".pages_tree_item.active-bg").removeClass('active-bg');


	   // d(".pages_tree_item.item_"+active_item_is_parent)  ;
	    mw.$(".pages_tree_item.item_"+active_item_is_parent).addClass('active-bg')
         mw.$(".pages_tree_item.item_"+active_item_is_parent).children().first().addClass('active')
            //mw.$(".pages_tree_item.item_"+active_item_is_parent).parents("li").addClass('active-bg');

		 	 mw.$('#pages_edit_container').attr('data-parent-page-id',active_item_is_parent);

	 } else {
		mw.$('#pages_edit_container').removeAttr('data-parent-page-id');

	 }

    mw.$('#pages_edit_container').attr('data-page-id',$p_id);
    mw.$('#pages_edit_container').attr('data-type','content/edit_page');
    mw.$('#pages_edit_container').removeAttr('data-subtype');
    mw.$('#pages_edit_container').removeAttr('data-content-id');

    mw.$(".mw_edit_page_right").css("overflow", "hidden");

    edit_load('content/edit_page')



}

mw.on.hashParam("parent-page", function(){
    var act = mw.url.windowHashParam("action");
    if(act == 'new:page'){
       mw_select_page_for_editing(0);
 
    }
});


mw.on.hashParam("action", function(){



  mw.$("#pages_edit_container").stop();


  mw.$('#pages_edit_container').removeAttr('mw_select_trash');




  //mw.$("#pages_edit_container #pages_edit_container").remove();
  mw.$(".mw_edit_page_right").css("overflow", "hidden");

  if(this==false) {
    //mw.load_module('content/manage','#pages_edit_container');
    mw.$(".mw_edit_page_right").css("overflow", "hidden");
    edit_load('content/manage');
    return false;
  }

  var arr = this.split(":");

  $(mwd.body).removeClass("action-Array");





   // mw.$('#pages_edit_container').removeAttr('data-page-number');
	//mw.$('#pages_edit_container').removeAttr('data-paging-param');

   //





 var cat_id = mw.url.windowHashParam("category_id");
 if(typeof cat_id != 'undefined'){
     mw.$('#pages_edit_container').attr('category_id',cat_id);
 }
 else{
     mw.$('#pages_edit_container').removeAttr('data-active-item');
 }



  if(arr[0]==='new'){

      if(arr[1]==='page'){
        //$(mwd.body).addClass("loading");
        mw_select_page_for_editing(0);
      }
      else if(arr[1]==='post'){
        //$(mwd.body).addClass("loading");
        mw_select_post_for_editing(0);
      }
      else if(arr[1]==='category'){
       // $(mwd.body).addClass("loading");
        mw_select_category_for_editing(0);
      }
      else if(arr[1]==='product'){
       // $(mwd.body).addClass("loading");
        mw_add_product(0);
      }

     mw.$(".mw_action_nav").addClass("not-active");
     mw.$(".mw_action_"+arr[1]).removeClass("not-active");
  }
  else{
        //mw.url.windowHashParam("pg", 1);
      mw.$(".active-bg").removeClass('active-bg');
      mw.$(".mw_action_nav").removeClass("not-active");


      var active_item = mw.$(".item_"+arr[1]);



      if(arr[0] == 'showposts'){
            var active_item =  mw.$(".pages_tree_item.item_"+arr[1]);
      }
      else if(arr[0] == 'showpostscat'){
           var active_item =  mw.$(".category_element.item_"+arr[1]);
      }


      active_item.addClass('active-bg');
      active_item.parents("li").addClass('active');
      if(arr[0]==='editpage'){
        mw_select_page_for_editing(arr[1])
      }


     if(arr[0]==='trash'){
        mw_select_trash(arr[0])
      }


      else if(arr[0]==='showposts'){
        mw_set_edit_posts(arr[1])
      }
      else if(arr[0]==='showpostscat'){
        mw_set_edit_posts(arr[1], true)
      }
      else if(arr[0]==='editcategory'){
        mw_select_category_for_editing(arr[1])
      }
      else if(arr[0]==='editpost'){
          mw_select_post_for_editing(arr[1]);
      }
  }








});












edit_load = function(module){

var n = mw.url.getHashParams(window.location.hash)['new_content'];


if(n=='true'){
  var slide = false;
  mw.url.windowDeleteHashParam('new_content');
}
else{
 var slide = true;
}




  if(slide){
      mw.loadModuleData(module,'#pages_edit_container', function(data){
          var div = document.createElement('div');
          div.id = 'pages_edit_container';
          div.style.left = '200px';
          div.innerHTML = data;
          $(this).animate({"left": -800}, 320, function(){
               $(this).replaceWith(div);
               $(div).animate({"left": 0}, 220, function(){
                     mw.$(".mw_edit_page_right").css("overflow", "visible");
                     $(mwd.body).removeClass("loading")
               });
          });
      });
  }
  else{
    mw.load_module(module,'#pages_edit_container');
  }

}









function mw_select_category_for_editing($p_id){


					  var  active_cat = $('#pages_tree_container_<?php print $my_tree_id; ?> li.category_element.active-bg').first();
				   if(active_cat != undefined){
						var active_cat = active_cat.attr('data-category-id');
					   	 mw.$('#pages_edit_container').attr('data-selected-category-id',active_cat);
				   } else {
					   	   mw.$('#pages_edit_container').removeAttr('data-selected-category-id');

				   }




	 mw.$('#pages_edit_container').attr('data-category-id',$p_id);
  	// mw.load_module('categories/edit_category','#pages_edit_container');


    mw.$(".mw_edit_page_right").css("overflow", "hidden");

    edit_load('categories/edit_category');



}




function mw_set_edit_posts($in_page, $is_cat){
       mw.$('#pages_edit_container').removeAttr('data-content-id');
	 mw.$('#pages_edit_container').removeAttr('data-page-id');
      mw.$('#pages_edit_container').removeAttr('data-category-id');
	   mw.$('#pages_edit_container').removeAttr('data-selected-category-id');

if($in_page != undefined && $is_cat == undefined){
 mw.$('#pages_edit_container').attr('data-page-id',$in_page);
}

if($in_page != undefined && $is_cat != undefined){
 mw.$('#pages_edit_container').attr('data-category-id',$in_page);
 mw.$('#pages_edit_container').attr('data-selected-category-id',$in_page);
}

	 mw.load_module('content/manage','#pages_edit_container', function(){




	 });












}


function mw_select_trash(){
  mw.$('#pages_edit_container').removeAttr('data-content-id');
   mw.$('#pages_edit_container').removeAttr('data-page-id');
      mw.$('#pages_edit_container').removeAttr('data-category-id');
     mw.$('#pages_edit_container').removeAttr('data-selected-category-id');
          mw.$('#pages_edit_container').removeAttr('data-keyword');

   mw.load_module('content/trash','#pages_edit_container', function(){




   });
}

function mw_select_post_for_editing($p_id, $subtype){

	 var  active_item = $('#pages_tree_container_<?php print $my_tree_id; ?> .active-bg').first();
	 var active_item_is_page = active_item.attr('data-page-id');

        mw.$('#pages_edit_container').removeAttr('data-parent-category-id');
        mw.$('#pages_edit_container').removeAttr('data-category-id');
        mw.$('#pages_edit_container').removeAttr('category_id');



	  var active_item_is_category = active_item.attr('data-category-id');

	 if(active_item_is_category != undefined){
			  mw.$('#pages_edit_container').attr('data-parent-category-id',active_item_is_category);
			  var  active_item_parent_page = $('#pages_tree_container_<?php print $my_tree_id; ?> .active-bg').parents('.have_category').first();
			   if(active_item_parent_page != undefined){
					var active_item_is_page = active_item_parent_page.attr('data-page-id');

			   } else {
				  var  active_item_parent_page = $('#pages_tree_container_<?php print $my_tree_id; ?> .active-bg').parents('.is_page').first();
				   if(active_item_parent_page != undefined){
						var active_item_is_page = active_item_parent_page.attr('data-page-id');

				   }

			   }


	 } else {
	    mw.$('#pages_edit_container').removeAttr('data-parent-category-id');

	 }

	  if(active_item_is_page != undefined){
		 	 mw.$('#pages_edit_container').attr('data-parent-page-id',active_item_is_page);

	 } else {
		mw.$('#pages_edit_container').removeAttr('data-parent-page-id');

	 }



	 mw.$('#pages_edit_container').removeAttr('data-subtype');
	 mw.$('#pages_edit_container').removeAttr('is_shop');
	 mw.$('#pages_edit_container').attr('data-content-id',$p_id);
	 if($subtype != undefined){
		 if($subtype == 'product'){
			  mw.$('#pages_edit_container').attr('is_shop', 'y');
		 }


	 mw.$('#pages_edit_container').attr('data-subtype', $subtype);
	 } else {
		mw.$('#pages_edit_container').attr('data-subtype', 'post');
	 }




    mw.$(".mw_edit_page_right").css("overflow", "hidden");

    edit_load('content/edit_post');






  	// mw.load_module('content/edit_post','#pages_edit_container');
}

function mw_add_product(){

	 mw_select_post_for_editing(0,   'product')



}








</script>

<div id="mw_edit_pages">
  <div id="mw_edit_pages_content">   
    <div class="mw_edit_page_left" id="mw_edit_page_left">










      <div class="mw_edit_pages_nav">
        <?php
            $view = url_param('view');
            if($view=='shop'){
        ?>
        <a href="<?php print admin_url(); ?>view:shop" class="mw_tree_title mw_tree_title_shop">
        <?php _e("My Online Shop"); ?>
        </a>




        <?php } else { ?>
        <a href="<?php print admin_url(); ?>view:content" class="mw_tree_title">
        <?php _e("Website  Navigation"); ?>
        </a>
        <?php } ?>










        <a href="#action=new:page" class="mw_action_nav mw_action_page" id="action_new_page" onclick="mw.url.windowHashParam('action','new:page');mw.url.windowDeleteHashParam('parent-page');return false;">
          <label><?php _e("Page"); ?></label>
          <button></button>
        </a>

        <a href="#action=new:page" class="mw_action_nav mw_action_sub_page"  id="action_new_sub_page" onclick="mw.url.windowHashParam('action','new:page');return false;">
          <label><?php _e("Sub Page"); ?></label>
          <button></button>
        </a>


        <?php if((isset($params['is_shop']) and $params['is_shop'] == 'y') or isset($is_shop)): ?>

  <?php else :  ?>
   <a href="#action=new:post" class="mw_action_nav mw_action_post" onclick="mw.url.windowHashParam('action','new:post');return false;">
 <label><?php _e("Post"); ?></label>
        <button>&nbsp;</button>
        </a>
<?php endif; ?>



<a href="#action=new:category" class="mw_action_nav mw_action_category" onclick="mw.url.windowHashParam('action','new:category');return false;">
        <label><?php _e("Category"); ?></label>
        <button>&nbsp;</button>
        </a> <a href="#action=new:product" class="mw_action_nav mw_action_product" onclick="mw.url.windowHashParam('action','new:product');">
        <label><?php _e("Product"); ?></label>
        <button>&nbsp;</button>
        </a>
        <?php /*  <button onclick="mw_set_edit_categories()">mw_set_edit_categories</button>
        <button onclick="mw_set_edit_posts()">mw_set_edit_posts</button>
 */ ?>






      </div>








      <div class="mw_pages_posts_tree mw-tree"  id="pages_tree_container_<?php print $my_tree_id; ?>">
        <?php
	  $is_shop_str = '';
	   if(isset($is_shop)){
		 $is_shop_str = " is_shop='{$is_shop}' "   ;
	   }
	   ?>
        <module data-type="pages" template="admin" active_ids="<?php print $active_content_id; ?>" active_class="active-bg"  include_categories="true" include_global_categories="true" id="pages_tree_toolbar" <?php print $is_shop_str ?>  view="admin_tree"   />
        <div class="mw-clear"></div>
      </div>
      <div class="tree-show-hide-nav"> <a href="javascript:;" class="mw-ui-btn" onclick="mw.tools.tree.openAll(mwd.getElementById('pages_tree_container_<?php print $my_tree_id; ?>'));">Open All</a> <a class="mw-ui-btn" href="javascript:;" onclick="mw.tools.tree.closeAll(mwd.getElementById('pages_tree_container_<?php print $my_tree_id; ?>'));">Close All</a> </div>
    </div>
    <div class="mw_edit_page_right">
      <script>

  /*  $(document).ready(function(){

        var def = '<?php _e("Search for posts"); ?>';
        var field = mw.$("#mw-search-field");
        field.bind('keyup focus blur', function(event){
           mw.form.dstatic(event, def);
           if(event.type=='keyup'){
              mw.on.stopWriting(this, function(){
                 this.value !== def ? mw.url.windowHashParam('search',this.value) : '';
              });
           }
        });



    });
*/



    </script>
      <div style="padding-left: 0;">
        <div class="top_label">

        <?php if(is_module('help')): ?>
        <a href="<?php print admin_url(); ?>view:help"><?php _e("See the tutorials here"); ?></a>
        <?php endif; ?>
       </div>
        <div class="vSpace"></div>
      </div>
      <?php
$ed_content = false;
 $content_id = '';

		if(isset($_GET['edit_content'])){
			 $content_id = ' data-content-id='.intval($_GET['edit_content']).' ';
			 $ed_content = true;
		} else {

				if(defined('CONTENT_ID')== true and CONTENT_ID != false and CONTENT_ID != 0){
					 $ed_content = true;
				 $content_id = ' data-content-id='.intval(CONTENT_ID).' ';

			  } else   if(defined('POST_ID')== true and POST_ID != false and POST_ID != 0){
				   $ed_content = true;
				 $content_id = ' data-content-id='.intval(POST_ID).' ';

			  } else if(defined('PAGE_ID') == true and PAGE_ID != false and PAGE_ID != 0 ){
				   $ed_content = true;
				  $content_id = ' data-content-id='.intval(PAGE_ID).' ';

			  }
		}

	   ?>
      <div id="pages_edit_container"  <?php print $is_shop_str ?>>
        <?php if( $ed_content=== false): ?>
        <module data-type="content/manage" page-id="global" id="edit_content_admin" <?php print  $content_id ?> <?php print $is_shop_str ?> />
        <?php else: ?>
        <div id="edit_content_admin"   <?php print  $content_id ?> /></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>







        <?php $view = url_param('view'); ?>

        <?php if( $view == 'content'){  ?>


          <?php  show_help('content');  ?>


         <?php } else if($view == 'shop'){  ?>

              <?php  show_help('shop');  ?>

         <?php  } ?>







