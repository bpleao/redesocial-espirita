<?php


elgg_gatekeeper();

//$page_type = elgg_extract('page_type', $vars);
$guid = elgg_extract('guid', $vars);
$question = get_entity($guid);
$answer_guid = elgg_extract('answer_guid', $vars);

$success = add_entity_relationship($answer_guid, 'answers', $guid);

if ($success){
	system_message('Resposta associada com sucesso');
} else {
	register_error('Não foi possível criar a associação');
}
/*
$params = [
	'filter' => '',
	'title' => $question->title
];

$params['content'] = elgg_view_entity($question, array('full_view' => true));

$body = elgg_view_layout('content', $params);

echo elgg_view_page($question->title, $body);
*/

forward($question->getURL());
