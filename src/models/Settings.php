<?php
/**
 * Environment Label
 *
 * @author     Michael Rog <michael@michaelrog.com>, Tom Davies <tom@madebykind.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2017, Top Shelf Craft (Michael Rog)
 * @see        https://github.com/topshelfcraft/Environment-Label
 */

namespace topshelfcraft\environmentlabel\models;

use Craft;
use craft\base\Model;


/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  EnvironmentLabel
 * @since    3.0.0
 */
class Settings extends Model
{

    /*
     * Public properties
     */

	/**
	 * @var boolean
	 */
	public $showLabel = true;

    /**
     * @var string|null
     */
    public $labelColor = null;

	/**
	 * @var string|null
	 */
	public $textColor = null;

	/**
	 * @var string|null
	 */
	public $prefixText = null;

	/**
	 * @var string|null
	 */
	public $labelText = CRAFT_ENVIRONMENT;

	/**
	 * @var string|null
	 */
	public $suffixText = null;

	/**
	 * @var string|null
	 */
	public $targetSelector = null;

	/*
	 * Public functions
	 */

	public function init()
	{

		parent::init();

		if (empty($this->targetSelector))
		{
			$this->targetSelector = version_compare(Craft::$app->getInfo()->version, '3.4.0-beta', '>=') ? "#global-header:before" : "#main-container:before";
		}

	}

}
