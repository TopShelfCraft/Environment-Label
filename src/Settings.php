<?php
namespace TopShelfCraft\EnvironmentLabel;

use craft\base\Model;

class Settings extends Model
{

	public bool $showLabel = true;

	/**
	 * @deprecated
	 */
	public string $labelColor = "#cc5643";

	/**
	 * @deprecated
	 */
	public string $textColor = "#ffffff";

	/**
	 * @deprecated
	 */
	public ?string $prefixText = null;

	public ?string $labelText = null;

	/**
	 * @deprecated
	 */
	public ?string $suffixText = null;

	public string $targetSelector = "#global-header:before";

}
