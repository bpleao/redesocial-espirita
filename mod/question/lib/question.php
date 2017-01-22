<?php

/**
 * Get page components to edit/create a question.
 *
 * @param string  $page     'edit' or 'add'
 * @param int     $guid     GUID of question
  * @return array
 */
function question_get_page_content_edit($page, $guid = 0) {

	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'question-post-edit';
	$vars['class'] = 'elgg-form-alt';

	$sidebar = '';
	if ($page == 'edit') {
		$question = get_entity((int)$guid);

		$title = "Edite a Pergunta";

		if (elgg_instanceof($question, 'object', 'question')) {
			$vars['entity'] = $question;

			$body_vars = question_prepare_form_vars($question);

			$content = elgg_view_form('question/save', $vars, $body_vars);
			$sidebar = '';
		} else {
			$content = 'Erro';
		}
	} else {
		$body_vars = question_prepare_form_vars(null);

		$title = "Faça uma Pergunta";
		$content = elgg_view_form('question/save', $vars, $body_vars);
	}

	$return['title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;
}


/**
 * Pull together question variables for the save form
 *
 * @param ElggObject $question
 * @return array
 */
function question_prepare_form_vars($question = NULL) {

	// input names => defaults
	$values = array(
		'title' => NULL,
		'tags' => NULL,
		'date' => NULL,
		'guid' => NULL,
	);

	if ($question) {
		foreach (array_keys($values) as $field) {
			if (isset($question->$field)) {
				$values[$field] = $question->$field;
			}
		}
	}

	if (elgg_is_sticky_form('question')) {
		$sticky_values = elgg_get_sticky_values('question');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}
	
	elgg_clear_sticky_form('question');

	return $values;
}
