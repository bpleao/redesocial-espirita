<?php

/**
 * Get page components to edit/create a communication.
 *
 * @param string  $page     'edit' or 'add'
 * @param int     $guid     GUID of communication
  * @return array
 */
function communication_get_page_content_edit($page, $guid = 0) {

	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'communication-post-edit';
	$vars['class'] = 'elgg-form-alt';

	$sidebar = '';
	if ($page == 'edit') {
		$comm = get_entity((int)$guid);

		$title = "Edite a Comunica&ccedil;&atilde;o";

		if (elgg_instanceof($comm, 'object', 'communication')) {
			$vars['entity'] = $comm;

			$body_vars = communication_prepare_form_vars($comm);

			$content = elgg_view_form('communication/save', $vars, $body_vars);
			$sidebar = '';
		} else {
			$content = 'Erro';
		}
	} else {
		$body_vars = communication_prepare_form_vars(null);

		$title = "Registre uma Comunica&ccedil;&atilde;o";
		$content = elgg_view_form('communication/save', $vars, $body_vars);
	}

	$return['title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;
}


/**
 * Pull together communication variables for the save form
 *
 * @param ElggObject $comm
 * @return array
 */
function communication_prepare_form_vars($comm = NULL) {

	// input names => defaults
	$values = array(
		'title' => NULL,
		'description' => NULL,
		'tags' => NULL,
		'date' => NULL,
		'place' => NULL,
		'medium' => NULL,
		'guid' => NULL,
	);

	if ($comm) {
		foreach (array_keys($values) as $field) {
			if (isset($comm->$field)) {
				$values[$field] = $comm->$field;
			}
		}
	}

	if (elgg_is_sticky_form('communication')) {
		$sticky_values = elgg_get_sticky_values('communication');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}
	
	elgg_clear_sticky_form('communication');

	return $values;
}
