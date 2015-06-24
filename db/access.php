 <?php
$capabilities = array(

    'local/omegasync:adminview' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
        		'student'=>CAP_PROHIBIT,
        		'teacher' => CAP_PROHIBIT,
        		'editingteacher' => CAP_PROHIBIT,
        		'manager' => CAP_ALLOW
)));
 ?>
