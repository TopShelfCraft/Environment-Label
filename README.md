# Environment Label

_...so you don't forget where you are._

**A [Top Shelf Craft](https://topshelfcraft.com) creation**  
in collaboration with [Kind](https://madebykind.com/)

&mdash; Based on the original [LabelEnvironment](https://github.com/madebykind/craft.labelenvironment) plugin by [Tom Davies](https://github.com/tomdavies)


### TL;DR.

The _Environment Label_ plugin adds a nice coloured banner to your CraftCMS control panel so you'll never forget what environment you're using.

The colors and text of the environment label are configurable via the plugin config file.

![Screenshot](docs/dev.jpg)

* * *


## Installation

Visit the _Plugin Store_ in your Craft control panel, search for **Environment Label**, and click to _Install_ the plugin.


## Configuration

By default, the environment label will pull in the value of Craft's `CRAFT_ENVIRONMENT` constant, which is set to the current hostname unless you override it.

_(In other words, out of the box, you get a red banner with white text that alerts you to the current hostname.)_

You can use a plugin config file to tweak the appearance and text of the environment label for each installation.

Simply add an `environment-label.php` file to your `config` directory.

(There is a sample plugin config included in the plugin files - `config/environment-label.php` - which you can copy and use as a starter.

```php
<?php

return [
	
    'showLabel' => true,
    'labelText' => CRAFT_ENVIRONMENT,
    'prefixText' => null,
    'suffixText' => null,
    'labelColor' => '#cc5643',
    'textColor' => '#ffffff',
    'targetSelector' => '#global-header:before',
	
];
```

I suggest referencing [PHP environment variables](http://php.net/manual/en/function.getenv.php), rather than using hard-coded values, to make your configuration more consistently maintainable.

I also _highly recommend_ using the [PHP dot-env](https://github.com/vlucas/phpdotenv) package to easily set and deploy environment variables across your installations. (The [Craft starter project](https://github.com/craftcms/craft)) ships with dot-env included.)

For example, your `environment-label.php` config file might use environment variables set by the server:

```php
<?php

return [
	
    'showLabel' => getenv('CRAFT_ENV_SHOW_LABEL'),
    'labelText' => getenv('CRAFT_ENV_LABEL_TEXT'),
	
);
```

For added flexibility, the full text of the label will be rendered as a Twig template, so you can also include template variables if you want:

```php
<?php

return [
	
    'suffixText' => " // {{ currentUser }}",
    
);
```


## Changing Settings in the Control Panel

You can also make basic changes to the text and appearance of the environment label via the plugin Settings page.

![Settings](docs/settings.jpg)

</div>

This is provided as a convenience for easily testing out the plugin, but for full customizability, you should use a plugin config file as described above.

(Settings specified in the plugin config file will override any changes made via the Settings page in the control panel.)


## Twig template globals

_Environment Label_ makes its properties available via a Twig template global variable, so you can create your own
environment label rendering in your public templates:

```twig
{{ environmentLabel.renderedText }}
{{ environmentLabel.labelColor }}
{{ environmentLabel.textColor }}
```

## JavaScript globals

_Environment Label_ also makes its properties available as JS globals on each authenticated CP page.

```js
window.CRAFT_ENVIRONMENT
window.CRAFT_ENVIRONMENT_LABEL
```

## What are the system requirements?

Craft 3.0+ and PHP 7.0+


## I've found a bug.

No you haven't.


## Yes, I believe I have.

Well, alright. Please open a [GitHub Issue](https://github.com/topshelfcraft/Environment-Label/issues), and if you're feeling ambitious, submit a PR to the `3.x.dev` branch.


* * *

### Contributors:

  - Plugin development: [Michael Rog](http://michaelrog.com) / @michaelrog
  - Craft 2 plugin development: [Tom Davies](https://github.com/tomdavies) / @metadaptive
  - Icon: [NAS](http://nasztu.com/), via [The Noun Project](https://thenounproject.com/search/?q=label&i=28588)
