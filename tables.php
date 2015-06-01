<?php

class tables{
	
	public function __construct(){}
	
	public static function tableFilter(){
		
		global $DB, $OUTPUT, $PAGE;
		$selectData = $DB->get_records_sql('SELECT DISTINCT(facultad) FROM mdl_local_omegasync');

		$arregloFacultad = "";
		foreach($selectData as $arr) {
			$option = $arr->facultad;
			$arregloFacultad = $arregloFacultad."<option value=".$option.">".$option."</option>";
		}
		
		$facultad = "<select id='filter'><option value='all'>Todas</option>".$arregloFacultad."</select>";
		
		
		$table = new html_table();
		$table->head = array('Periodo Academico', 'Categoria Webcursos', 'Seleccione Facultad <br> '.$facultad,
							  'Sede', 'Fecha de creación', 'Fecha inicio periodo academico', 'Fecha termino periodo academico',
							  'Sincronización esta activa');
		
		$arrayPrueba = $DB->get_records('webc_omega');
		$deleteIcon = new pix_icon("t/delete", "Delete");
		$editIcon = new pix_icon("t/edit", "Edit");
		foreach($arrayPrueba as $array){
			$tableData = $DB->get_records('local_omegasync', array('id'=>$array->omegasync_id));
		
		foreach($tableData as $data){
			if($data->estado == '0'){
				$activeIcon = new pix_icon("i/marked", "Details");
			}else{
				$activeIcon = new pix_icon("i/marker", "Details");
			}
			
			$activeUrl = new moodle_url('/local/omegasync/index.php', array('action'=>'change_state', 'pAcademicoId'=>$array->omegasync_id, 'pAcademicoEstado'=>$data->estado,'pAcademicoName'=>$data->periodo_academico));
			$activeButton = $OUTPUT->action_icon($activeUrl,$activeIcon);
		
			$deletelUrl = new moodle_url("/local/omegasync/index.php", array('action'=>'state_delete', 'pAcademicoId'=>$array->omegasync_id, 'pAcademicoName'=>$data->periodo_academico));
			$deleteButton = $OUTPUT->action_icon($deletelUrl, $deleteIcon, new confirm_action("Esta seguro que quiere eliminar el Periodo Academico: ".$data->periodo_academico));
		
			$editUrl = new moodle_url("/local/omegasync/editar.php", array('pAcademicoId'=>$array->omegasync_id));
			$editButton = $OUTPUT->action_icon($editUrl, $editIcon);
			
			$table->data[]= array($data->periodo_academico, $data->categoria_webc, $data->facultad, $data->sede,date('l, F d Y', $data->fecha_creacion).' '.date('H:i',$data->fecha_creacion),
								  date('l, F d Y', $data->inicio_periodo).' '.date('H:i',$data->inicio_periodo),date('l, F d Y', $data->termino_periodo).' '.date('H:i',$data->termino_periodo),
							 	  $activeButton."&nbsp&nbsp&nbsp&nbsp&nbsp".$editButton."". $deleteButton);
		}
	}
		return $table;
}
}

		