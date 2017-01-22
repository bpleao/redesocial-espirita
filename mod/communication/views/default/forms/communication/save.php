<?php

/**
 * Edit communication form
 *
 */
///*
$comm = get_entity($vars['guid']);
$vars['entity'] = $comm;

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

$title_label = 'Esp&iacute;rito';
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'id' => 'comm_title',
	'value' => $vars['title']
));

$body_label = 'Comunica&ccedil;&atilde;o';
$body_input = elgg_view('input/longtext', array(
	'name' => 'description',
	'id' => 'comm_description',
	'value' => $vars['description']
));

$tags_label = elgg_echo('tags');
$tags_input = elgg_view('input/tags', array(
	'name' => 'tags',
	'id' => 'comm_tags',
	'value' => $vars['tags']
));

$date_label = 'Data';
$date_input = elgg_view('input/date', array(
	'name' => 'date',
	'id' => 'comm_date',
	'value' => $vars['date']
));

$place_label = 'Local';
$place_input = elgg_view('input/text', array(
	'name' => 'place',
	'id' => 'comm_place',
	'value' => $vars['place']
));

$medium_label = 'M&eacute;dium';
$medium_input = elgg_view('input/text', array(
	'name' => 'medium',
	'id' => 'comm_medium',
	'value' => $vars['medium']
));

// hidden inputs
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));


echo <<<___HTML

<div>
	<label for="comm_title">$title_label</label>
	$title_input
</div>

<div>
	<label for="comm_description">$body_label</label>
	$body_input
</div>

<div>
	<label for="comm_tags">$tags_label</label>
	$tags_input
</div>

<div>
	<label for="comm_date">$date_label</label>
	$date_input
</div>

<div>
	<label for="comm_place">$place_label</label>
	$place_input
</div>

<div>
	<label for="comm_medium">$medium_label</label>
	$medium_input
</div>

<div class="elgg-foot">
	$guid_input

	$action_buttons
</div>

___HTML;
//*/

/*
$comm = get_entity($vars['guid']);

$title_label = elgg_echo("Esp&iacute;rito");
$title_input = elgg_view('input/text', array(
	'name' => 'title', 
	'id' => 'title',
	'value' => $vars['title'],
));

$body_label = elgg_echo("Comunica&ccedil;&atilde;o");
$body_input = elgg_view('input/longtext', array(
	'name' => 'body', 
	'id' => 'body',
	'value' => $vars['description'],
));

$tags_label = elgg_echo("tags");
$tags_input = elgg_view('input/tags', array(
	'name' => 'tags', 
	'id' => 'tags',
	'value' => $vars['tags'],
));

$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));

$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));

echo <<<___HTML
<div>
    <label for="title">$title_label</label><br />
    $title_input
</div>

<div>
    <label for="body">$body_label</label><br />
    $body_input
</div>

<div>
    <label for="tags">$tags_label</label><br />
    $tags_input
</div>

<div class="elgg-foot">
	
	$guid_input

	$save_button
</div>

___HTML;
//*/