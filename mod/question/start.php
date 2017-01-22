<?php

elgg_register_event_handler('init', 'system', 'question_init');

function question_init() {
	elgg_register_library('question', __DIR__ . '/lib/question.php');
	
	$item = new ElggMenuItem('question', 'Perguntas', 'question/all');
	elgg_register_menu_item('site', $item);
	
	elgg_register_action("question/save", __DIR__ . "/actions/question/save.php");

	elgg_register_page_handler('question', 'question_page_handler');
	
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'question_menu_handler');
	
	elgg_register_plugin_hook_handler('entity:url', 'object', 'question_set_url');
}

function question_page_handler($segments) {
	
	elgg_load_library('question');
	
	$page_type = elgg_extract(0, $segments, 'all');
	$resource_vars = [
		'page_type' => $page_type,
	];
	
    switch ($page_type) {
        case 'add':
			echo elgg_view_resource('question/add');
			break;
		
		case 'view':
		//case 'answer':
			$resource_vars['guid'] = elgg_extract(1, $segments);
			echo elgg_view_resource('question/view',$resource_vars);
			break;
		   
		case 'edit':
			$resource_vars['guid'] = elgg_extract(1, $segments);
			echo elgg_view_resource('question/edit',$resource_vars);
			break;
		
		case 'answer':
			$resource_vars['guid'] = elgg_extract(1, $segments);
			$resource_vars['answer_guid'] = elgg_extract(2, $segments);
			echo elgg_view_resource('question/answer',$resource_vars);
			break;

        case 'all':
        default:
			echo elgg_view_resource('question/all');
			break;
		
    }

    return true;
}

function question_menu_handler($hook, $type, $menu, $params) {
	return $menu;
}

function question_set_url($hook, $type, $url, $params) {
	$entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', 'question')) {
		return "question/view/{$entity->guid}";
	}
}
