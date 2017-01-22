<?php

gatekeeper();

$guid = elgg_extract('guid', $vars);

$comm = get_entity($guid);

$params = [
	'filter' => '',
	'title' => $comm->title
];

$params['content'] = elgg_view_entity($comm, array('full_view' => true));

$body = elgg_view_layout('content', $params);

/*
 *  Presenting list of associated questions
 */

$question_list = elgg_list_entities_from_relationship(array(
	'type' => 'object',
	'subtype' => 'question',
	'relationship' => 'answers',
	'relationship_guid' => $guid,
	'full_view' => false,
));

$params = [
	'filter' => '',
	'content' => $question_list,
	'title' => 'Perguntas Relacionadas',
];

$body .= '<div>' . elgg_view_layout('one_column', $params) . '</div>';

/*
 *  Presenting list of associated communications
 */

$comm_list = elgg_list_entities_from_relationship(array(
	'type' => 'object',
	'subtype' => 'communication',
	'relationship' => 'relates_to',
	'relationship_guid' => $guid,
	'full_view' => false,
));

$params = [
	'filter' => '',
	'content' => $comm_list,
	'title' => 'Comunicações Relacionadas',
];

$body .= '<div>' . elgg_view_layout('one_column', $params) . '</div>';

echo elgg_view_page($comm->title, $body);



