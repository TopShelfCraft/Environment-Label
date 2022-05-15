<?php
namespace TopShelfCraft\EnvironmentLabel;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class TwigExtension extends AbstractExtension implements GlobalsInterface
{

	/**
	 * Returns the name of the extension.
	 */
	public function getName(): string
	{
		return 'Environment Label';
	}

	public function getGlobals(): array
	{
		return [
			'environmentLabel' => EnvironmentLabel::getInstance()->label,
		];
	}

}
