<?php
/**
 * @package Amazon Affiliate Addon for Elkarte
 * @author Thorsten Eurich
 * @copyright (c) 2014 Thorsten Eurich
 * @license This Source Code is subject to the terms of the Mozilla Public License
 * version 1.1 (the "License"). You can obtain a copy of the License at
 * http://mozilla.org/MPL/1.1/.
 *
 * @version 1.0
 *
 */

/**
 * This function is used to replace links in messages. It adds add your 
 * affiliate id or replaces an existing id with your own.
 *
 * @global $modSettings
 * @param array $output
 * @param array $message
 */
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

/**
 * This function adds the related field under post settings.
 *
 * @param array $config_vars
 */
function add_amazon_affiliate_setting(&$config_vars)
{
	loadLanguage('AmazonAffiliate');
	
	$config_vars = array_merge($config_vars, array(
		'',
		array('text', 'amazon_affiliate_id'),
	));
}

/**
 * Loads the css file with the amazon icon.
 */
function add_amazon_css()
{
	if (empty($_REQUEST['name']) || $_REQUEST['name'] !== 'packages')
		loadCSSFile('amazon.css');
}