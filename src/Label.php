<?php
namespace TopShelfCraft\EnvironmentLabel;

use Craft;

class Label
{

	/**
	 * @deprecated
	 */
	public function getPrefixText(): string
	{
		return (string) EnvironmentLabel::getInstance()->getSettings()->prefixText;
	}

	/**
	 * @deprecated
	 */
	public function getSuffixText(): string
	{
		return (string) EnvironmentLabel::getInstance()->getSettings()->suffixText;
	}

	public function getLabelText(): string
	{
		// We support using `CRAFT_ENVIRONMENT` as the default label text, for backwards compatibility from 3.x.
		// TODO: Remove the default text in 5.x.
		$CRAFT_ENVIRONMENT = defined('CRAFT_ENVIRONMENT') ? CRAFT_ENVIRONMENT : null;
		return (string) (EnvironmentLabel::getInstance()->getSettings()->labelText ?? $CRAFT_ENVIRONMENT);
	}

	public function getRenderedText(): string
	{
		$fullText = $this->getPrefixText() . $this->getLabelText() . $this->getSuffixText();
		return Craft::$app->getView()->renderString($fullText);
	}

	public function getLabelColor(): string
	{
		return EnvironmentLabel::getInstance()->getSettings()->labelColor;
	}

	/**
	 * @return string
	 */
	public function getTextColor(): string
	{
		return EnvironmentLabel::getInstance()->getSettings()->textColor;
	}

	/**
	 * @return string
	 */
	public function getTargetSelector(): string
	{
		return EnvironmentLabel::getInstance()->getSettings()->targetSelector;
	}

	/**
	 * @return string
	 */
	public function getCss(): string
	{

		$selector = $this->getTargetSelector();
		$labelColor = $this->getLabelColor();
		$textColor = $this->getTextColor();
		$renderedText = $this->getRenderedText();

		// TODO: Make the base CSS customizable/overridable via Settings (?)
		return "
			{$selector}
			{
				content: '{$renderedText}';
				display: block;
				background-color: {$labelColor};
				background-image: linear-gradient(rgba(0,0,0,0), rbga(0,0,0,0.1));
				color: {$textColor};
				border-bottom: 1px solid rgba(255, 255, 255, 0.1);
				text-align: right;
				padding: 14px 24px;
				font-size: 15px;
				font-weight: 700;
				z-index: 9;
			}
		";

	}

	/**
	 * @return string
	 *
	 * @deprecated JS features are slated for removal in 5.x. Please open an Issue if you're using these features!
	 * @todo Remove in 5.x
	 */
	public function getJs(): string
	{

		/*
		 * We include `CRAFT_ENVIRONMENT` for backwards compatibility from 3.x, but that constant is no longer
		 * set by default in the Craft starter project, so we'll eventually remove references to it.
		 */
		$CRAFT_ENVIRONMENT = defined('CRAFT_ENVIRONMENT') ? CRAFT_ENVIRONMENT : null;
		$js = "window.CRAFT_ENVIRONMENT = " . json_encode($CRAFT_ENVIRONMENT) . ";";

		$props = get_object_vars(EnvironmentLabel::getInstance()->getSettings());
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
			EnvironmentLabel::getInstance()->getSettings()->showLabel
			&& Craft::$app->getRequest()->isCpRequest
			&& Craft::$app->getUser()->getIdentity()
		) {
			$view = Craft::$app->getView();
			$view->registerCss($this->getCss());
			// TODO: Remove in 5.x 👇
			$view->registerJs($this->getJs());
		}

	}

}
