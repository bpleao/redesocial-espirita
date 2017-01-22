<?php

elgg_gatekeeper();

//$page_type = elgg_extract('page_type', $vars);
$guid = elgg_extract('guid', $vars);

$params = question_get_page_content_edit('edit', $guid);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);