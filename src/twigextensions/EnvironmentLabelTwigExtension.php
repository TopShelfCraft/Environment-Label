<?php
/**
 * Environment Label
 *
 * @author     Michael Rog <michael@michaelrog.com>, Tom Davies <tom@madebykind.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2017, Top Shelf Craft (Michael Rog)
 * @see        https://github.com/topshelfcraft/Environment-Label
 */

namespace topshelfcraft\environmentlabel\twigextensions;

use topshelfcraft\environmentlabel\EnvironmentLabel;

/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  EnvironmentLabel
 * @since    3.0.0
 */
class EnvironmentLabelTwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{

	/*
	 * Protected properties
	 */

	protected $initializing = false;

    /*
     * Public methods
     */

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'EnvironmentLabel';
    }

	/**
	 * Returns a list of global variables to add to the existing list.
	 *
	 * @return array An array of global variables
	 */
	public function getGlobals(): array
	{

		$props = EnvironmentLabel::$plugin->getSettings()->getAttributes();

		if (!$this->initializing)
		{
			$this->initializing = true;
			$props['renderedText'] = EnvironmentLabel::$plugin->label->getRenderedText();
			$this->initializing = false;
		}

		return [
			'environmentLabel' => $props
		];

	}

}
