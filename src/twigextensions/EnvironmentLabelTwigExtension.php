<?php
/**
 * Environment Label
 *
 * @author     Michael Rog <michael@michaelrog.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2018, Top Shelf Craft (Michael Rog)
 * @see        https://github.com/topshelfcraft/Environment-Label
 */

namespace topshelfcraft\environmentlabel\twigextensions;

use topshelfcraft\environmentlabel\EnvironmentLabel;

/**
 * @author Michael Rog <michael@michaelrog.com>
 * @package EnvironmentLabel
 * @since 3.1.5
 */
class EnvironmentLabelTwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{

	/*
	 * Public methods
	 * ===========================================================================
	 */

	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName()
	{
		return 'Environment Label';
	}

	/**
	 * @inheritdoc
	 */
	public function getGlobals()
	{
		return ['environmentLabel' => EnvironmentLabel::$plugin->label];
	}

}
