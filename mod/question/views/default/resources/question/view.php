<?php

gatekeeper();

$guid = elgg_extract('guid', $vars);

$question = get_entity($guid);

$params = [
	'filter' => '',
	'title' => $question->title
];

$params['content'] = elgg_view_entity($question, array('full_view' => true));

$body = elgg_view_layout('content', $params);

/*
 *  Presenting list of associated answers
 */

/*
$comm_list = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'communication',
	'full_view' => false,
));
*/

$comm_list = elgg_list_entities_from_relationship(array(
	'type' => 'object',
	'subtype' => 'communication',
	'relationship' => 'answers',
	'relationship_guid' => $guid,
	'inverse_relationship' => true,
	'full_view' => false,
));

$params = [
	'filter' => '',
	'content' => $comm_list,
	'title' => 'Respostas',
];

$body .= '<div>' . elgg_view_layout('one_column', $params) . '</div>';

echo elgg_view_page($question->title, $body);


