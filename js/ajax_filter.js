/**
 * 
 */

$('#id_uAcademica').on('change', function(){
	
	var filter = $(this).val();
	if(filter == 0){
		filter = "";
	}
	$.ajax({
		url: "filter.php",
		data: {
			filter: filter
		},
		dataType: 'json'
	})
	.done(function( data ) {
		$('#id_pAcademico').html('');
		$('#id_facultad').html('');
		for(key in data){
			$('#id_pAcademico').append('<option value="'+data[key]['id']+'">'+data[key]['periodo_academico']+'</option>');
			$('#id_facultad').append('<option value="'+data[key]['facultad']+'">'+data[key]['facultad']+'</option>');
		}
		
	});

});


