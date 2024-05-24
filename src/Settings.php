<?php
namespace TopShelfCraft\EnvironmentLabel;

use craft\config\BaseConfig;

class Settings extends BaseConfig
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

	public string $targetSelector = "#page-container:before";

}
