/**
 * 
 */

$("#filter").on('change', function(){
	var filter = $(this).val();
	if(filter == 'all'){
		$(".c0").each(function(){
			$(this).parent().css('display', 'table-row');
		});
	}else{
		$(".c2:not(:contains("+filter+"))").each(function(){
			$(this).parent().css('display', 'none');
		});
		$(".c2:contains("+filter+")").each(function(){
			$(this).parent().css('display', 'table-row');
		});
	}
})