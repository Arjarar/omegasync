<?php
require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->dirroot.'/local/omegasync/tables.php');
require_once($CFG->dirroot.'/local/omegasync/forms.php');

global $PAGE, $CFG, $OUTPUT, $DB;
require_login();
$url = new moodle_url('/local/omegasync/crear.php');
$context = context_system::instance();//context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('standard');

//breadcrumbs
$PAGE->navbar->add('Administración del sitio');
$PAGE->navbar->add('UAI');
$PAGE->navbar->add('Sincronización con omega');
$PAGE->navbar->add('Crear');

$urlBack = new moodle_url('/local/omegasync/index.php');
$urlForm = new moodle_url('/local/omegasync/crear.php');

$title = "OmegaSync";
$title2 = "Plugin OmegaSync";
$PAGE->set_title($title);
$PAGE->set_heading($title2);
echo $OUTPUT->header();
echo $OUTPUT->heading($title);

$mform = new form();

if($fromform = $mform->get_data()){
	$addRecords = '';
	$pAcademicoId = $fromform->pAcademico;
	$pAcademicoName = $DB->get_record('local_omegasync', array('id'=>$pAcademicoId));
	$checkDuplicity = $DB->record_exists('webc_omega', array('omegasync_id'=>$pAcademicoId));	
	if(!$checkDuplicity){
		if($pAcademicoId != 0){
			if($fromform->facultad != '0'){
				$addRecords = $DB->insert_record('webc_omega', array('omegasync_id'=>$pAcademicoId));
				if($addRecords){
					echo '<div class="alert alert-success">Se ha creado exitosamente el Periodo Academico: '.$pAcademicoName->periodo_academico.'</div>';
					echo $OUTPUT->single_button($urlForm, 'Volver');
				}else{
					echo '<div class="alert alert-danger">Ha ocurrido un error en el sistema, por favor contacte a un Administrador</div>';
					echo $OUTPUT->single_button($urlForm, 'Volver');
				}
			}else{
				echo '<div class="alert alert-danger">Error: Se debe seleccionar una Facultad</div>';
				echo $OUTPUT->single_button($urlForm, 'Volver');
			}
		}else{
			echo '<div class="alert alert-danger">Error: Se debe seleccionar un Período Academico</div>';
			echo $OUTPUT->single_button($urlForm, 'Volver');
		}
	}else{
		echo '<div class="alert alert-danger">Error: Registro ya existe en la base de datos</div>';
		echo $OUTPUT->single_button($urlForm, 'Volver');
		
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


  