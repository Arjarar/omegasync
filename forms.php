<?php
require_once(dirname(__FILE__) . '/../../config.php');
require_once("$CFG->libdir/formslib.php");


class form extends moodleform{
	public function definition(){
		
		global $PAGE, $CFG, $OUTPUT, $DB;
		
		$mform =& $this->_form;
		$selectData = $DB->get_records('unidad_academica');
		$selectDato = $DB->get_records('local_omegasync');
		
		$uAcademica = array('Todas');
		$pAcademico = array('');
		$facultad = array('');
		
		foreach($selectData as $data){
			$uAcademica = $uAcademica + array($data->id => $data->unidad_academica);
		}
		foreach($selectDato as $dato){
			$pAcademico = $pAcademico + array($dato->id => $dato->periodo_academico);
			$facultad = $facultad + array($dato->facultad => $dato->facultad);
		}
		
		$mform->addElement('select', 'uAcademica', 'Unidad Academica:', $uAcademica);
		$mform->setType('uAcademica', PARAM_TEXT);
		$mform->addElement('select', 'pAcademico', 'Periodo Academico:', $pAcademico);
		$mform->addElement('select', 'facultad', 'Facultad:', $facultad);
		$mform->addElement('select', 'estado', 'Activo:', array('Activar', 'Desactivar'));
		
		$mform->addElement('submit', 'submitbutton', 'Crear');
		
	}
}

class editform extends moodleform{
	public function definition(){

		global $PAGE, $CFG, $OUTPUT, $DB;

		$mform =& $this->_form;
		$selectData = $DB->get_records('unidad_academica');
		$selectDato = $DB->get_records('local_omegasync');

		$uAcademica = array('Todas');
		$pAcademico = array('');
		$facultad = array('');

		foreach($selectData as $data){
			$uAcademica = $uAcademica + array($data->id => $data->unidad_academica);
		}
		foreach($selectDato as $dato){
			$pAcademico = $pAcademico + array($dato->id => $dato->periodo_academico);
			$facultad = $facultad + array($dato->facultad => $dato->facultad);
		}

		$mform->addElement('select', 'uAcademica', 'Unidad Academica:', $uAcademica);
		$mform->setType('uAcademica', PARAM_TEXT);
		$mform->addElement('select', 'pAcademico', 'Periodo Academico:', $pAcademico);
		$mform->addElement('select', 'facultad', 'Facultad:', $facultad);
		$mform->addElement('select', 'estado', 'Activo:', array('Activar', 'Desactivar'));

		$mform->addElement('submit', 'submitbutton', 'Editar');

	}
}


?>





