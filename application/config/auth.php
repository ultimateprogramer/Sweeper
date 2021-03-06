<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Config for Sweeper Auth
 *
 * PHP version 5
 * LICENSE: This source file is subject to GPLv3 license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/gpl.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.swiftly.org
 * @subpackage Auth config
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v3 (GPLv3) 
 */

return array(
	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => '#&wicm`(wT6m&0f}UT*o9*V01@:?fF#D', // replace with random string
	'lifetime'     => 1209600,
	'session_key'  => 'auth_user',
	'users' => array(),
);
