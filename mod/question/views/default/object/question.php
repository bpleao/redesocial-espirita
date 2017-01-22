<?php

$MAX_SHORT_DESCRIPTION_LEN = 100;

$full = elgg_extract('full_view', $vars, FALSE);
$question = $vars['entity'];
$owner = $question->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$metadata = elgg_view_menu('entity', array(
	'entity' => $question,
	'handler' => 'question',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$body = $question->description;

$date = '<p><label>Data: </label>';
$date .= elgg_view('output/text', array('value' => $question->date)) . '</p>';

// hidden inputs
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));


if ($full) {

	$params = array(
		'entity' => $question,
		'title' => false,
		'metadata' => $metadata,
		//'subtitle' => $question->title,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'summary' => $summary,
		'icon' => $owner_icon,
		'body' => $body . $date,
	));

} else {
	
	$params = array(
		'entity' => $question,
		'metadata' => $metadata,
		//'subtitle' => 'Esp&iacute;rito: ' . $question->title,
		'content' => elgg_get_excerpt($body, $MAX_SHORT_DESCRIPTION_LEN),
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($owner_icon, $list_body);
}