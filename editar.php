<?php
require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->dirroot.'/local/omegasync/tables.php');
require_once($CFG->dirroot.'/local/omegasync/forms.php');

global $PAGE, $CFG, $OUTPUT, $DB;
require_login();
$url = new moodle_url('/local/omegasync/editar.php');
$context = context_system::instance();//context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('standard');

//breadcrumbs
$PAGE->navbar->add('Administración del sitio');
$PAGE->navbar->add('UAI');
$PAGE->navbar->add('Sincronización con omega');
$PAGE->navbar->add('Editar');

$pAcademicoIdTable = required_param('pAcademicoId', PARAM_INT);
$urlBack = new moodle_url('/local/omegasync/index.php');
$urlForm = new moodle_url('/local/omegasync/editar.php', array('pAcademicoId'=>$pAcademicoIdTable));

$mform = new editform($urlForm);

	$title = "Editar";
	$title2 = "Plugin OmegaSync";
	$PAGE->set_title($title);
	$PAGE->set_heading($title2);
	echo $OUTPUT->header();
	echo $OUTPUT->heading($title);
	
	
	if($fromform = $mform->get_data()){
		$edit = '';
		$paId = $fromform->pAcademico;
		$staticId = $DB->get_record('webc_omega', array('omegasync_id'=>$pAcademicoIdTable));
		$checkDuplicity = $DB->record_exists('webc_omega', array('omegasync_id'=>$paId));
		
		if($checkDuplicity == FALSE){
			$edit = $DB->update_record('webc_omega', array('id'=>$staticId->id, 'omegasync_id'=>$paId));
		}else{
			echo '<div class="alert alert-danger">El periodo que desea agregar ya esta</div>';
			echo $OUTPUT->single_button($urlBack, 'Volver');
		}
		if($edit == TRUE){
			echo '<div class="alert alert-success">El periodo ha sido editado con éxito</div>';
			echo $OUTPUT->single_button($urlBack, 'Volver');
		}
	}else{
		$mform->set_data($mform);
		$mform->display();
		echo $OUTPUT->single_button($urlBack, 'Volver');
	}

echo $OUTPUT->footer();
?>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/ajax_filter.js"></script>