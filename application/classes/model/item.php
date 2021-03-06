<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for Items
 *
 * PHP version 5
 * LICENSE: This source file is subject to GPLv3 license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/gpl.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.swiftly.org
 * @subpackage Models
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v3 (GPLv3) 
 */
class Model_Item extends ORM
{
	/**
	 * An item has and belongs to many links, places, stories and tags
	 * An has many attachments and discussions
	 *
	 * @var array Relationhips
	 */
	protected $_has_many = array(
		'attachments' => array(),
		'discussions' => array(),
		'places' => array(
			'model' => 'place',
			'through' => 'items_places'
			),
		'stories' => array(
			'model' => 'story',
			'through' => 'items_stories'
			),
		'tags' => array(
			'model' => 'tag',
			'through' => 'items_tags'
			),
		'links' => array(
			'model' => 'link',
			'through' => 'items_links'
			)			
		);
		
	/**
	 * An item belongs to a project, a feed, a source and a user
	 *
	 * @var array Relationhips
	 */
	protected $_belongs_to = array(
		'project' => array(),
		'feed' => array(),
		'source' => array(),
		'user' => array()
		);

	/**
	 * Overload saving to perform additional functions on the item
	 */
	public function save(Validation $validation = NULL)
	{
		// Ensure Service Goes In as Lower Case
		$this->service = strtolower($this->service);

		// Extract Links
		// Do this for first time items only
		if ($this->loaded() === FALSE)
		{
			// Save the date the item was first added
			$this->item_date_add = date("Y-m-d H:i:s", time());

			// Sweeper Plugin Hook -- execute before saving new item
			Event::run('sweeper.item.pre_save_new', $this);

			$item = parent::save();

			// Sweeper Plugin Hook -- post_save new item
			Event::run('sweeper.item.post_save_new', $item);
		}
		else
		{
			// Sweeper Plugin Hook -- pre_save existing item
			Event::run('sweeper.item.pre_save', $this);

			$item = parent::save();

			// Sweeper Plugin Hook -- post_save existing item
			Event::run('sweeper.item.post_save', $item);
		}

		return $item;
	}
}