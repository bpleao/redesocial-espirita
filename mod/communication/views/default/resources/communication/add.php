<?php

elgg_gatekeeper();

//$page_type = elgg_extract('page_type', $vars);
//$guid = elgg_extract('guid', $vars);

$params = communication_get_page_content_edit('add');

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);