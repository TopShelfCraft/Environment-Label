# Environment Label Changelog

_A plugin for Craft CMS 3.x to help distinguish your Craft environments ...so you don't forget where you are._

The format of this file is based on ["Keep a Changelog"](http://keepachangelog.com/). This project adheres to [Semantic Versioning](http://semver.org/). Version numbers follow the pattern: `MAJOR.FEATURE.BUILD`


## 3.2.0 - 2019-01-06

### Added
  
- Added compatibility with new (Craft 3.4+) control panel layout. ([#8](https://github.com/TopShelfCraft/Environment-Label/issues/8))
- Added the `targetSelector` setting, which optionally overrides the CSS selector for the label banner.


## 3.1.5 - 2018-11-02

### Fixed
  
- Fixed order-of-loading conflicts that could generate an error when Environment Label tried to add a Twig global. ([#6](https://github.com/TopShelfCraft/Environment-Label/issues/6))
- Add `craftcms/cms` 3.0 as a requirement. (Required by plugin store)


## 3.1.4 - 2018-06-05

### Fixed

- Replaced broken URL to docs.


## 3.1.3 - 2018-03-22

### Fixed

- Updated the docs and example config file to reference the correct settings handles for `prefixText` and `suffixText`.


## 3.1.2 - 2018-03-08

### Fixed

- Removed a slightly overzealous typehint that causes an error in PHP 7.0 (since the `void` return type wasn't added until 7.1).


## 3.1.1 - 2017-12-31

### Added

- The `environmentLabel` Twig global now provides access directly to the `Label` service.

### Fixed

- The label text is now rendered later in the request (in response to the View's `BEFORE_RENDER_PAGE_TEMPLATE` event, rather than during the plugin initialization). This allows other plugins to register Twig extensions before we first use Twig to render the label text.

### Removed

- Removed the `EnvironmentLabelTwigExtension` in favor of a global pass-through to the Label service.


## 3.0.0 - 2017-12-25

### Added

- Environment Label is ready for Craft 3!
