.. include:: ../Includes.txt


.. _changelog:

=========
ChangeLog
=========

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

2.2.0 - 2021-09-12
===================

Features
^^^^^^^^
- [FEATURE] adding support for TYPO3 11.*
- [FEATURE] adding support for Bootstrap Package v12.0.*

2.1.0 - 2020-04-13
===================

Features
^^^^^^^^
- [FEATURE] adding support for TYPO3 10.4.*

2.0.1 - 2020-02-21
===================

Features
^^^^^^^^
- [FEATURE] add typoscript include for basic configuration without fluid layout overwrite for custom packages

2.0.0 - 2020-02-20
===================

Features
^^^^^^^^
- [!!!][FEATURE] introducing `AnimationSettingsProcessor` to get and render given animation settings into the html
- [FEATURE] updating to latest AOS library
- [FEATURE] possibility to enable advanced animation settings
- [FEATURE] global switch to disable the animation tab for all CTypes


1.2.1 - 2019-07-14
==================

Features
^^^^^^^^
- [FEATURE] add support for version 11 of `bootstrap_package`

1.2.0 - 2019-04-11
==================

Features
^^^^^^^^
- [FEATURE] adding a new and simple fade animation
- [!!!][FEATURE] using the same library in the backend for the animation preview as in the frontend to animate the elements
- [FEATURE] render the animation value as a label to the preview of any content element => can be deactivated via the extension setting
- [FEATURE] option to deactivate the behaviour where the animation tab is appending to all CTypes => can be also deactivated via the extension setting

Bugfixes
^^^^^^^^
- [BUGFIX] fixing the support for the higher_eductaion_package

1.1.0 - 2019-03-21
==================

Tasks
^^^^^
- [!!!][TASK] restructured internal paths of typoscript and fluid layouts

Features
^^^^^^^^
- [!!!][FEATURE] adding build in support for bootstrap_package, fluid_styled_content and higher_eductaion_package

1.0.5 - 2019-03-20
==================

Bugfixes
^^^^^^^^
- [BUGFIX] fixing problem where animations in backend are not shown as in the frontend

1.0.4 - 2019-03-18
==================

Bugfixes
^^^^^^^^
- [BUGFIX] fixing support for TYPO3 8 LTS

1.0.3 - 2019-03-18
==================

Features
^^^^^^^^
- [FEATURE] remove the ``ext:form`` dependency from AnimationPreview - thx to @jmverges

1.0.2 - 2019-03-13
==================

Features
^^^^^^^^
- [FEATURE] adding new animation preview in TYPO3 backend for better orientation.

1.0.1 - 2019-03-04
==================

Bugfixes
^^^^^^^^
- [BUGFIX] fixing default css classes in Default layout for `fluid_styled_content`.

1.0.0 - 2019-03-04
==================

- first release of `content_animations`.
