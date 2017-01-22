<?php

/**
 * Save question entity
 *
 */

// start a new sticky form session in case of failure
elgg_make_sticky_form('question');

// save or preview
$save = (bool)get_input('save');

// store errors to pass along
$error = FALSE;
$error_forward_url = REFERER;
$user = elgg_get_logged_in_user_entity();

// edit or create a new entity
$guid = get_input('guid');

if ($guid) {
	$entity = get_entity($guid);
	if (elgg_instanceof($entity, 'object', 'question') && $entity->canEdit()) {
		$question = $entity;
	} else {
		register_error('Question not found');
		forward(get_input('forward', REFERER));
	}

} else {
	$question = new ElggObject();
	$question->subtype = 'question';
	$new_question = TRUE;
}

// set defaults and required values.
$values = array(
	'title' => '',
	'tags' => '',
	'date' => '',
	'access_id' => ACCESS_LOGGED_IN,
);

// fail if a required entity isn't set
$required = array('title');

// load from POST and do sanity and access checking
foreach ($values as $name => $default) {
	if ($name === 'title') {
		$value = htmlspecialchars(get_input('title', $default, false), ENT_QUOTES, 'UTF-8');
	} else {
		$value = get_input($name, $default);
	}

	if (in_array($name, $required) && empty($value)) {
		$error = "Field $name missing";
	}

	if ($error) {
		break;
	}

	switch ($name) {
		case 'tags':
			$values[$name] = string_to_tag_array($value);
			break;

		default:
			$values[$name] = $value;
			break;
	}
}

// assign values to the entity, stopping on error.
if (!$error) {
	foreach ($values as $name => $value) {
		$question->$name = $value;
	}
}

// only try to save base entity if no errors
if (!$error) {
	if ($question->save()) {
		// remove sticky form entries
		elgg_clear_sticky_form('question');

		system_message('Pergunta salva');

		forward($question->getURL());
		
	} else {
		register_error('Cannot save question');
		forward($error_forward_url);
	}
} else {
	register_error($error);
	forward($error_forward_url);
}
