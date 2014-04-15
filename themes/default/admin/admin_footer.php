

		</div> <!-- end: Container Wrapper -->

	</div> <!-- end: container -->

		<div id="footer">
			<div class="wrapper">
				&copy; Copyright 2014 - <?php echo date('Y');?>
			</div> <!-- end: wrapper -->
		</div>  <!-- #footer -->
 		<?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/jquery-1.10.1.min.js.pagespeed.jm.hJPIhFzu5k.js')); ?>
 		<?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/toastmessage/javascript/jquery.toastmessage.js')); ?>

		 <script>

		 	(function(){

		 		$(".control_menu > li").hover(function(){
		 			$(this).children('a').addClass('active');
		 			$(this).children('ul').stop(true,true).show();
		 		},
		 		function(){
		 			$(this).children('ul').stop(true,true).hide();
		 			$(this).children('a').removeClass('active');
		 		})


        	    $('.btn-delete').click(function() {
    	            return window.confirm("Are you sure?");
	            });

        	    //Kategori Ekleme fromunu göster.
        	    $('.add_cate_button').on('click',function(e){
        	    	$("#addCategoryForm").slideDown();
                    $(this).slideUp();
        	    	e.preventDefault();
        	    });

        	    //Kategori Formunu kapat
        	    $('.cancel_category').on('click', function(e){
        	    	$("#addCategoryForm").slideUp();
                    $(".add_cate_button").slideDown();
        	    	e.preventDefault();
        	    });

        	    //Ekle buttonuna basıldığı zaman
        	    $('.add_category_submit').on('click',function(e){

        	    	var input 			= $('input[name="categoryName"]');
        	    	var inputVal		= jQuery.trim( input.val() );
        	    	var loadding		= $(".loadding");
        	    	var submitButton	= $(this);


        	    	//Boş mu?
        	    	if(inputVal == '')
        	    	{
        	    		alert('Boş alan bıraktın');
        	    	}

        	    	else {
        	    		submitButton.hide();
        	    		loadding.show();
        	    		$.post('<?php echo BASEPATH?>/Category/Add',{'categoryName':inputVal},function(response){


        	    			var response = jQuery.parseJSON(response);
                            console.log(response.categoryId);
        	    			$().toastmessage('showToast', {
                                text     : response.message,
                                sticky   : false,
                                type     : response.type
                            });

                            if(response.type == 'success')
                            {
                                $("#categoriesList").append('<li style="list-style: none" > <a href="<?php echo BASEPATH?>Category/Delete/'+response.categoryId+'" style="text-decoration: none"><img style="width: 15px; margin-right: 7px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAMAAABhEH5lAAAAwFBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC9vb1fX1/Hx8fNzc3IyMjExMSvr6/JycmwsLChoaG2trbQ0NC+vr7Q0NDOzs7Ozs7MzMzGxsbQ0NDLy8vKysrR0dHLy8vR0dHOzs7R0dHQ0NDR0dHQ0NDR0dHR0dHS0tLS0tJDS1ZOVmBiaXJka3TS0tLT09PX2dvZ2dna2trc3d/m5ubr6+vs7Ozw8PHy8vL29vb39/f4+Pj5+fn8/Pz9/f3+/v7///+QUUwjAAAAKXRSTlMAAQIDBAUGCQoUJigpLS8vMjM0T1aOkJOUlZWYmbi9zdPW19nd8fT5/M/kqJoAAADKSURBVBjTZZDpFsEwEEa/tmpfS1Fb7ZQgiKC08/5vJeHY75/MueebnJkBNDnXn899N4cnaZeLUxyfBHfTD1Pt7iO6E+27VW3y6yO9OK6zgNES9IFoGShtY1XtJJHcqSLmBTR0aLNgUrLFRsfqGIXqlcuAsWCpohQOMNN9JFkQMG3oOvlT0RTjy8OoxrsLh2gffr5vwvkZYusg2Tl8jdpJwip/L1S0YNi13nvtXs02ANPOeFycic6Cexnb1KcwE6mK11+t+l4llVDmBk+RNsdw2BgZAAAAAElFTkSuQmCC" alt=""></a><a href=""> '+inputVal+'</li>');
                                $("#category").append('<option value="'+response.categoryId+'">'+inputVal+'</option>');
                            }

        	    			submitButton.show();
        	    			loadding.hide();
        	    			input.val('');
        	    		});
        	    	}

        	    	e.preventDefault();
        	    });

		 	}());

		 </script>

		<?php error::displayNotice(); ?>


</body>
</html>