<?php
function add_amazon_affiliate(&$output, &$message)
{
	global $modSettings;

	if (!empty($modSettings['amazon_affiliate_id']))
		$output['body'] = preg_replace(
			'/href="http:\/\/[^>]*?amazon.([^\/]*)\/([^>]*?ASIN|gp\/product|exec\/obidos\/tg\/detail\/-|[^>]*?dp)\/([0-9a-zA-Z]{10})[a-zA-Z0-9#\/\*\-\?\&\%\=\,\._;]*/i',
			'href="http://www.amazon.$1/dp/$3/?tag='. $modSettings['amazon_affiliate_id'],
			$output['body']
		);
}

function add_amazon_affiliate_setting(&$config_vars)
{
	loadLanguage('AmazonAffiliate');
	
	$config_vars = array_merge($config_vars, array(
		'',
		array('text', 'amazon_affiliate_id'),

	));
}

function add_amazon_css()
{
	if (empty($_REQUEST['name']) || $_REQUEST['name'] !== 'packages')
		loadCSSFile('amazon.css');
}