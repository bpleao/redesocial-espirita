<?php

gatekeeper();

//echo remove_subtype	('object', 'communication');
		
///*

$add_button = elgg_view('output/url', array(
		'href' => 'communication/add',
		'text' => 'Criar Nova Comunica&ccedil;&atilde;o',
		'class' => 'elgg-button elgg-button-action float-alt',
		'confirm' => false,
	));
	
$body = elgg_list_entities(array(
    'type' => 'object',
    'subtype' => 'communication',
	//'full_view' => true,
));

//elgg_register_title_button();

$body = elgg_view_layout('one_column', array('content' => $add_button . $body));
//$body = elgg_view_layout('content', array('content' => $body));

echo elgg_view_page("Todas as Comunicações", $body);
//*/