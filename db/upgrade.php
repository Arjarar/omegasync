<?php

function xmldb_local_omegasync_upgrade($oldversion) {
	global $CFG, $DB;

	$dbman = $DB->get_manager();
	
    if ($oldversion < 2015053107) {

        // Define field id_unidad to be added to local_omegasync.
        $table = new xmldb_table('local_omegasync');
        $field = new xmldb_field('id_unidad', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'termino_periodo');

        // Conditionally launch add field id_unidad.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Omegasync savepoint reached.
        upgrade_plugin_savepoint(true, 2015053107, 'local', 'omegasync');
    }
}