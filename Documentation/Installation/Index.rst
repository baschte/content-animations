.. include:: ../Includes.txt



.. _installation:

============
Installation
============

The extension needs to be installed as any extension of TYPO3 CMS.

If you use composer you can simply get this extension via ``composer req baschte/content-animations``.

Setup
=====

TYPO3 13 Site Configuration
---------------------------

For TYPO3 13 with Site Configuration, include the appropriate **Site Set** in your site configuration.

.. note::

  You have to choose between these Site Sets from ``content_animations``.
   - Content Animations: Basic Configuration
   - Content Animations: Bootstrap Package v15.x
   - Content Animations: Bootstrap Package v14.x
   - Content Animations: Bootstrap Package v13.x
   - Content Animations: Bootstrap Package v12.x
   - Content Animations: Bootstrap Package v11.x
   - Content Animations: Fluid Styled Content

Classic Template Setup (TYPO3 12 and earlier)
----------------------------------------------

For TYPO3 12 and earlier, or if you're still using classic template setup, include the **static TypoScript** to your site template.

.. note::

  You have to choose between these static includes from ``content_animations``.
   - Content Animations: Bootstrap Package v15.x
   - Content Animations: Bootstrap Package v14.x
   - Content Animations: Bootstrap Package v13.x
   - Content Animations: Bootstrap Package v12.x
   - Content Animations: Bootstrap Package v11.x
   - Content Animations: Fluid Styled Content

.. hint::

  Please note that the version info in the inlcude itself isn't based on the TYPO3 version. It's the major version of, for example, the Bootstrap Package itself. You can get that info in the composer.json or the extension manager.

  **Example:** If you use the Bootstrap Package in version 15.0.x in your project you have to include ``Content Animations: Bootstrap Package v15.x``. If it's in version 14 the ``Content Animations: Bootstrap Package v14.x`` and so on.
