.. include:: ../Includes.txt



.. _installation:

============
Installation
============

The extension needs to be installed as any extension of TYPO3 CMS.

If you use composer you can simply get this extension via ``composer req baschte/content-animations``.

Setup
=====

If installed and activated just include the **static typoscript** to your site template and you're good to go.

.. note::

  You have to choose between these static includes from ``content_animations``.
   - Content Animations: Bootstrap Package v15.x
   - Content Animations: Fluid Styled Content
   - Content Animations: Content Blocks

.. hint::

  Please note that the version info in the include itself isn't based on the TYPO3 version. It's the major version of, for example, the Bootstrap Package itself. You can get that info in the composer.json or the extension manager.

  **Example:** If you use the Bootstrap Package in version 15.0.x in your project you have to include ``Content Animations: Bootstrap Package v15.x``. If it's in version 14 the ``Content Animations: Bootstrap Package v14.x`` and so on.

Content Blocks Support
=======================

If you're using the Content Blocks extension (EXT:content_blocks), you can use the dedicated static include:

- **Content Animations: Content Blocks** - Provides animation support for content blocks

This include is specifically tailored for projects using Content Blocks and ensures proper integration with the Content Blocks rendering pipeline.

Supported Rendering Engines
============================

The extension provides out-of-the-box support for the following rendering engines:

Bootstrap Package
-----------------
Full support for Bootstrap Package versions 11.x through 15.x with optimized templates and layouts.

Fluid Styled Content
--------------------
Native support for TYPO3's default Fluid Styled Content rendering.

Content Blocks
--------------
Dedicated support for the modern Content Blocks extension, enabling animations for all content blocks.

.. tip::

  If you're using a custom rendering solution, you can extend the extension's layouts and templates. See the :ref:`developer` section for details on customization.
