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
		return (string) EnvironmentLabel::getInstance()->getSettings()->labelText;
	}

	public function getRenderedText(): string
	{
		$fullText = $this->getPrefixText() . $this->getLabelText() . $this->getSuffixText();
		return addslashes(Craft::$app->getView()->renderString($fullText));
	}

	public function getLabelColor(): string
	{
		return $this->_normalizeCssColor(EnvironmentLabel::getInstance()->getSettings()->labelColor);
	}

	/**
	 * @return string
	 */
	public function getTextColor(): string
	{
		return $this->_normalizeCssColor(EnvironmentLabel::getInstance()->getSettings()->textColor);
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
				display: flex;
				justify-content: end;
				align-items: center;
				min-height: var(--header-height);
				padding: calc(var(--padding)/2) var(--padding);
				border-bottom: 1px solid rgba(255, 255, 255, 0.1);
				background-color: {$labelColor};
				background-image: linear-gradient(rgba(0,0,0,0), rbga(0,0,0,0.1));
				color: {$textColor};
				text-align: right;
				font-weight: 700;
				z-index: 9;
			}
		";

	}

	/**
	 * If we're in an authenticated CP request, the label is added to the CP.
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
		}

	}

	private function _normalizeCssColor(string $color)
	{
		if (preg_match('/^[0-9a-f]{3,6}$/i', $color) === 1)
		{
			return '#' . $color;
		}
		return $color;
	}

}
