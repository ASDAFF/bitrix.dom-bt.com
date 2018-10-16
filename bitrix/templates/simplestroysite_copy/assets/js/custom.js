jQuery( document ).ready(function() {    
	
	/* управление кнопками и табами с комплектацией */
	
	jQuery('.price-karkas').click(function() {	
	
			console.log( "Выбрали таб0 каркас" );
			
			jQuery('#smt-tab-0').addClass('active in');
			jQuery('#smt-tab-0').removeClass('fade');			
			jQuery('#smt-tab-1').addClass('fade');
			jQuery('#smt-tab-1').removeClass('active in');
			
			jQuery('[aria-controls = "smt-tab-0"]').parent().addClass("active");
			jQuery('[aria-controls = "smt-tab-1"]').parent().removeClass("active");			
		
	});
	
	jQuery('.price-brus').click(function() {	
	
			console.log( "Выбрали таб1 брус" );
			
			jQuery('#smt-tab-1').addClass('active in');
			jQuery('#smt-tab-1').removeClass('fade');			
			jQuery('#smt-tab-0').addClass('fade');
			jQuery('#smt-tab-0').removeClass('active in');
			
			jQuery('[aria-controls = "smt-tab-1"]').parent().addClass("active");
			jQuery('[aria-controls = "smt-tab-0"]').parent().removeClass("active");						
		
	});
	
	/* прилипающая шапка таблицы комплектаций */
	var fixhead = jQuery('.f-thead');     
    var tablePos = jQuery('#kompl-karkas').offset();
	var tableHeight = jQuery('#kompl-karkas').height();
	
	jQuery(window).scroll(function () {
		//console.log(jQuery(this).scrollTop());
        /*if (jQuery(this).scrollTop() > 1800) {
            fixhead.fadeIn();
        } else {
            fixhead.fadeOut();
        }*/
        if(tablePos != undefined) {
            if (jQuery(this).scrollTop() - 200 > tablePos.top && jQuery(this).scrollTop() < (tablePos.top + tableHeight -200)) {
                fixhead.fadeIn();
            } else {
                fixhead.fadeOut();
            }
        }
    });
	
	
	//console.log( 'х таблицы = ' + tablePos.top );
	//console.log('высота таблицы = '+jQuery('#kompl-karkas').height());
	
	/* клонирование содержимого шапки таблицы */	
	
	jQuery('#klone-kk0').html(jQuery('#kk0').html());
	jQuery('#klone-kk1').html(jQuery('#kk1').html());
	jQuery('#klone-kk2').html(jQuery('#kk2').html());
	jQuery('#klone-kk3').html(jQuery('#kk3').html());	
	jQuery('#klone-kb0').html(jQuery('#kb0').html());
	jQuery('#klone-kb1').html(jQuery('#kb1').html());
	jQuery('#klone-kb2').html(jQuery('#kb2').html());
	
	/* выделение выбранных поп. категорий */
	
	//#rg_top_filter_wrapp .bx-filter-parameters-box-container .checkbox input[type="checkbox"]
	
	jQuery('#rg_top_filter_wrapp .bx-filter-parameters-box-container .checkbox label').click(function(){
		//console.log('нажали на поп. категорию');		
		jQuery(this).toggleClass("active");
		//jQuery(this).find('span').css({"background-color":"#1fa0da","color":"#fff"});

	});
    jQuery('#del_filter').click(function(){
    	var url = window.location.href;
    	var true_url = url.split('?');
        window.location.href = true_url[0];
    });
	
});