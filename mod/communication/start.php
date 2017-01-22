<?php

elgg_register_event_handler('init', 'system', 'communication_init');

function communication_init() {
	elgg_register_library('communication', __DIR__ . '/lib/communication.php');
	
	$item = new ElggMenuItem('communication', 'Comunica&ccedil;&otilde;es', 'communication/all');
	elgg_register_menu_item('site', $item);
	
	elgg_register_action("communication/save", __DIR__ . "/actions/communication/save.php");

	elgg_register_page_handler('communication', 'communication_page_handler');
	
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'communication_menu_handler');
	
	elgg_register_plugin_hook_handler('entity:url', 'object', 'communication_set_url');
}

function communication_page_handler($segments) {
	
	elgg_load_library('communication');
	
	$page_type = elgg_extract(0, $segments, 'all');
	$resource_vars = [
		'page_type' => $page_type,
	];
	
    switch ($page_type) {
        case 'add':
			echo elgg_view_resource('communication/add');
			break;
		
		case 'view':
			$resource_vars['guid'] = elgg_extract(1, $segments);
			echo elgg_view_resource('communication/view',$resource_vars);
			break;
		   
		case 'edit':
			$resource_vars['guid'] = elgg_extract(1, $segments);
			echo elgg_view_resource('communication/edit',$resource_vars);
			break;
		
		case 'associate':
			$resource_vars['guid'] = elgg_extract(1, $segments);
			$resource_vars['other_guid'] = elgg_extract(2, $segments);
			echo elgg_view_resource('communication/associate',$resource_vars);
			break;
		
        case 'all':
        default:
           echo elgg_view_resource('communication/all');
           break;
    }

    return true;
}

function communication_menu_handler($hook, $type, $menu, $params) {
	return $menu;
}

function communication_set_url($hook, $type, $url, $params) {
	$entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', 'communication')) {
		return "communication/view/{$entity->guid}";
	}
}
