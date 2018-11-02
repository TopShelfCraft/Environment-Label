<?php
/**
 * Environment Label
 *
 * @author     Michael Rog <michael@michaelrog.com>, Tom Davies <tom@madebykind.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2017, Top Shelf Craft (Michael Rog)
 * @see        https://github.com/topshelfcraft/Environment-Label
 */

namespace topshelfcraft\environmentlabel;

use Craft;
use craft\base\Plugin;
use craft\web\View;
use topshelfcraft\environmentlabel\models\Settings;
use topshelfcraft\environmentlabel\services\Label;
use topshelfcraft\environmentlabel\twigextensions\EnvironmentLabelTwigExtension;
use yii\base\Event;


/**
 * @author   Michael Rog <michael@michaelrog.com>
 * @package  EnvironmentLabel
 * @since    3.0.0
 *
 * @property  Label $label
 * @property  Settings $settings
 *
 * @method    Settings getSettings()
 */
class EnvironmentLabel extends Plugin
{


	/*
	 * Static properties
	 */


    /**
     * @var EnvironmentLabel $plugin
     */
    public static $plugin;


    /*
     * Public methods
     */


    /**
     * Initializes the plugin, sets its static self-reference, registers the Twig extension,
	 * and adds the environment label as appropriate.
     */
    public function init()
    {

		parent::init();
		self::$plugin = $this;

		Craft::$app->getView()->registerTwigExtension(new EnvironmentLabelTwigExtension());

		Event::on(
			View::class,
			View::EVENT_BEFORE_RENDER_PAGE_TEMPLATE,
			function (Event $event) {
				EnvironmentLabel::$plugin->label->doItBaby();
			}
		);

    }


    /*
     * Protected methods
     */


    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return \topshelfcraft\environmentlabel\models\Settings|null
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }


	/**
	 * Returns the rendered settings HTML, which will be inserted into the content
	 * block on the settings page.
	 *
	 * @return string The rendered settings HTML
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \yii\base\Exception
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
