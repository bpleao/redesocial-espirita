<?php


elgg_gatekeeper();

//$page_type = elgg_extract('page_type', $vars);
$guid = elgg_extract('guid', $vars);
$comm = get_entity($guid);
$other_guid = elgg_extract('other_guid', $vars);

//Since relationship implies direction, creating both directions
$success = add_entity_relationship($guid, 'relates_to', $other_guid);
$other_success = add_entity_relationship($other_guid, 'relates_to', $guid);

//echo "$guid $other_guid $success $other_success";

if ($success & $other_success){
	system_message('Comunicação associada com sucesso');
} else {
	register_error('Não foi possível criar as associações');
}

forward($comm->getURL());