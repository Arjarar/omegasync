<?php
require_once(dirname(__FILE__) . '/../../config.php'); //obligatorio
require_once($CFG->dirroot.'/local/omegasync/tables.php');
require_once($CFG->dirroot.'/local/omegasync/forms.php');

global $PAGE, $CFG, $OUTPUT, $DB;
require_login();
$url = new moodle_url('/local/omegasync/index.php');
$context = context_system::instance();//context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('standard');

//breadcrumbs
$PAGE->navbar->add('Administración del sitio');
$PAGE->navbar->add('UAI');
$PAGE->navbar->add('Sincronización con omega');

$action = optional_param('action', 'view_table', PARAM_TEXT);
$urlCrearEvento = new moodle_url('/local/omegasync/crear.php');

echo $OUTPUT->header();

$title = "UAI";
$title2 = "Plugin OmegaSync";
$PAGE->set_title($title);
$PAGE->set_heading($title2);
echo $OUTPUT->heading($title);

if($action == 'change_state'){
	$pAcademicoEstado = required_param('pAcademicoEstado', PARAM_INT);
	$pAcademicoId = required_param('pAcademicoId', PARAM_INT);
	$pAcademicoName = required_param('pAcademicoName', PARAM_TEXT);
	$changeState = $DB->update_record('local_omegasync', array('id'=>$pAcademicoId, 'estado'=>!$pAcademicoEstado));
	if(!$pAcademicoEstado == 0){
		$estado = 'Activo';
	}else{
		$estado = 'Inactivo';
	}
	$action = 'view_table';
	echo '<div class="alert alert-info">Se ha cambiado exitosamente el estado a '.$estado.' al Periodo Académico: '.$pAcademicoName.'</div>';
}

if($action == 'state_delete'){
	$pAcademicoToDelete = required_param('pAcademicoId', PARAM_INT);
	$pAcademicoName = required_param('pAcademicoName', PARAM_TEXT);
	$deletepAcademico = $DB->delete_records('webc_omega', array('omegasync_id'=>$pAcademicoToDelete));
	if($deletepAcademico == TRUE){
		$action = 'view_table';
		echo '<div class="alert alert-danger">Se ha eliminado exitosamente el Periodo Académico: '.$pAcademicoName.'</div>';
	}
}
if($action == 'view_table'){
$table = tables::tableFilter();
echo html_writer::table($table);
echo $OUTPUT->single_button($urlCrearEvento, 'Crear Evento');
}

echo $OUTPUT->footer();
?>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/table_filter.js"></script>