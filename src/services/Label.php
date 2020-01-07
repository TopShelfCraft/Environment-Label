<?php
/**
 * Environment Label
 *
 * @author     Michael Rog <michael@michaelrog.com>, Tom Davies <tom@madebykind.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2017, Top Shelf Craft (Michael Rog)
 * @see        https://github.com/topshelfcraft/Environment-Label
 */

namespace topshelfcraft\environmentlabel\services;

use topshelfcraft\environmentlabel\EnvironmentLabel;

use Craft;
use craft\base\Component;


/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  EnvironmentLabel
 * @since    3.0.0
 */
class Label extends Component
{


    /*
     * Public methods
     */

	/**
	 * @return string
	 */
	public function getPrefixText(): string
	{
		return (string) EnvironmentLabel::$plugin->getSettings()->prefixText;
	}

	/**
	 * @return string
	 */
	public function getSuffixText(): string
	{
		return (string) EnvironmentLabel::$plugin->getSettings()->suffixText;
	}

	/**
	 * @return string
	 */
	public function getLabelText(): string
	{
		return (string) EnvironmentLabel::$plugin->getSettings()->labelText;
	}

	/**
	 * @return string
	 */
	public function getRenderedText(): string
	{

		$prefix = $this->getPrefixText();
		$suffix = $this->getSuffixText();
		$label = $this->getLabelText();
		$fullText = $prefix . $label . $suffix;

		$view = Craft::$app->getView();
		return $view->renderString($fullText);

	}

	/**
	 * @return string
	 */
	public function getLabelColor(): string
	{
		return (string) EnvironmentLabel::$plugin->getSettings()->labelColor;
	}

	/**
	 * @return string
	 */
	public function getTextColor(): string
	{
		return (string) EnvironmentLabel::$plugin->getSettings()->textColor;
	}

	/**
	 * @return string
	 */
	public function getTargetSelector(): string
	{
		return (string) EnvironmentLabel::$plugin->getSettings()->targetSelector;
	}

	/**
	 * @return string
	 */
	public function getCss(): string
	{

		$selector = $this->getTargetSelector();
		$labelColor = $this->getLabelColor();
		$textColor = $this->getTextColor();

		// TODO: Make the base CSS customizable/overridable via Settings (?)
		$css = "
			{$selector}
			{
					display: block;
					background-color: #cc5643;
					background-image: linear-gradient(#dc5643, #cc5643);
					color: #ffffff;
					border-bottom: 1px solid rgba(255, 255, 255, 0.1);
					text-align: right;
					padding: 14px 24px;
					font-size: 15px;
					font-weight: 700;
					z-index: 9;
			}
		";

		// Optionally override the label color
		if (!empty($labelColor))
		{
			$css .= "
				html {$selector} { background-image: none; background-color: {$labelColor}; }
			";
		}

		// Optionally override the label text color
		if (!empty($textColor))
		{
			$css .= "
				html {$selector} { color: {$textColor}; }
			";
		}

		return $css;

	}

	/**
	 * @return string
	 */
	public function getJs(): string
	{

		$js = "window.CRAFT_ENVIRONMENT = " . json_encode(CRAFT_ENVIRONMENT) . ";";

		$props = EnvironmentLabel::$plugin->getSettings()->getAttributes();
		$props['renderedText'] = $this->getRenderedText();
		$js .= "window.CRAFT_ENVIRONMENT_LABEL = " . json_encode($props) . ";";

		return $js;

	}

    /**
     * If we're in an authenticated CP request, the label is added to the CP,
	 * and some JS variables are injected for convenience debugging things in the console.
     */
    public function doItBaby()
    {

        if (
        	EnvironmentLabel::$plugin->getSettings()->showLabel
			&& Craft::$app->getRequest()->isCpRequest
			&& Craft::$app->getUser()->getIdentity()
		) {
			$view = Craft::$app->getView();
			$view->registerCss($this->getCss());
			$view->registerCss("{$this->getTargetSelector()} { content: '{$this->getRenderedText()}'; }");
			$view->registerJs($this->getJs());
        }

    }


}
