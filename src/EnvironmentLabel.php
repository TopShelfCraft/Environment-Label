<?php
namespace TopShelfCraft\EnvironmentLabel;

use Craft;
use craft\web\View;
use TopShelfCraft\base\Plugin;
use yii\base\Event;

/**
 * @author Michael Rog <michael@michaelrog.com>, Tom Davies <tom@madebykind.com>
 * @link https://topshelfcraft.com
 * @copyright Copyright 2022, Top Shelf Craft (Michael Rog)
 *
 * @property Label $label
 *
 * @method Settings getSettings()
 */
class EnvironmentLabel extends Plugin
{

	public bool $hasCpSection = false;
	public bool $hasCpSettings = true;
	public string $schemaVersion = "1.0.0";
	public ?string $changelogUrl = "https://raw.githubusercontent.com/TopShelfCraft/Environment-Label/master/CHANGELOG.md";

	/**
	 * Initializes the plugin, registers the Twig extension, and adds the environment label as appropriate.
	 */
	public function init()
	{

		$this->setComponents([
			'label' => Label::class
		]);

		parent::init();

		Craft::$app->getView()->registerTwigExtension(new TwigExtension());

		Event::on(
			View::class,
			View::EVENT_BEFORE_RENDER_PAGE_TEMPLATE,
			function (Event $event) {
				EnvironmentLabel::getInstance()->label->doItBaby();
			}
		);

	}

	/**
	 * Creates and returns the model used to store the plugin’s settings.
	 */
	protected function createSettingsModel(): Settings
	{
		return new Settings();
	}

	/**
	 * Returns the rendered settings HTML, which will be inserted into the content
	 * block on the settings page.
	 *
	 * @return string The rendered settings HTML
	 */
	protected function settingsHtml(): string
	{
		return Craft::$app->view->renderTemplate(
			'environment-label/settings',
			[
				'settings' => $this->getSettings()
			]
		);
	}

}
