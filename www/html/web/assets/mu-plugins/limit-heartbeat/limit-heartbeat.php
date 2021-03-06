<?php
/*
Plugin Name: Limit Heartbeat
Description: Limits the Heartbeat API in WordPress to certain areas of the site (and a longer pulse interval) to reduce AJAX queries and improve resource usage.
Version: 1.1.0
Author: Fenix
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
PBP Version: 1.1.0
WC requires at least: 3.3
WC tested up to: 3.5
Prefix: LMTHRT
*/

// Plugin namespace
namespace RISE\LimitHeartbeat;

// Plugin constants
const FILE = __FILE__;
const PREFIX = 'lmthrt';
const VERSION = '1.1.0';

// Boot
require_once dirname(FILE).'/helpers/boot.php';
Helpers\Boot::instance(FILE);