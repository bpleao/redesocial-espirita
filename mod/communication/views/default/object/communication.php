<?php

$MAX_SHORT_DESCRIPTION_LEN = 100;

$full = elgg_extract('full_view', $vars, FALSE);
$comm = $vars['entity'];
$owner = $comm->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$metadata = elgg_view_menu('entity', array(
	'entity' => $comm,
	'handler' => 'communication',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$body = $comm->description;

$date = '<p><label>Data: </label>';
$date .= elgg_view('output/text', array('value' => $comm->date)) . '</p>';

$place = '<p><label>Local: </label>';
$place .= elgg_view('output/text', array('value' => $comm->place)) . '</p>';

$medium = '<p><label>M&eacute;dium: </label>';
$medium .= elgg_view('output/text', array('value' => $comm->medium)) . '</p>';

// hidden inputs
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));


if ($full) {

	$params = array(
		'entity' => $comm,
		'title' => false,
		'metadata' => $metadata,
		//'subtitle' => $comm->title,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'summary' => $summary,
		'icon' => $owner_icon,
		'body' => $body . $date . $place . $medium,
	));

} else {
	
	$params = array(
		'entity' => $comm,
		'metadata' => $metadata,
		//'subtitle' => 'Esp&iacute;rito: ' . $comm->title,
		'content' => elgg_get_excerpt($body, $MAX_SHORT_DESCRIPTION_LEN),
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($owner_icon, $list_body);
}