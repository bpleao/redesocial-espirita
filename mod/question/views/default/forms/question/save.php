<?php

/**
 * Edit question form
 *
 */
///*
$question = get_entity($vars['guid']);
$vars['entity'] = $question;

$action_buttons = '';
$delete_link = '';

if ($vars['guid']) {
	// add a delete button if editing
	$delete_url = "action/entity/delete?guid={$vars['guid']}";
	$delete_link = elgg_view('output/url', array(
		'href' => $delete_url,
		'text' => elgg_echo('delete'),
		'class' => 'elgg-button elgg-button-delete float-alt',
		'confirm' => true,
	));
}

$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));
$action_buttons = $save_button . $delete_link;

$title_label = 'Pergunta';
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'id' => 'question_title',
	'value' => $vars['title']
));

$tags_label = elgg_echo('tags');
$tags_input = elgg_view('input/tags', array(
	'name' => 'tags',
	'id' => 'question_tags',
	'value' => $vars['tags']
));

$date_label = 'Data';
$date_input = elgg_view('input/date', array(
	'name' => 'date',
	'id' => 'question_date',
	'value' => $vars['date']
));

// hidden inputs
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));


echo <<<___HTML

<div>
	<label for="question_title">$title_label</label>
	$title_input
</div>

<div>
	<label for="question_tags">$tags_label</label>
	$tags_input
</div>

<div>
	<label for="question_date">$date_label</label>
	$date_input
</div>

<div class="elgg-foot">
	$guid_input

	$action_buttons
</div>

___HTML;
//*/
