.. include:: ../Includes.txt


.. _developer:

================
Developer Corner
================

Content Animations comes with out-of-the-box support for popular TYPO3 rendering engines. Just include the static TypoScript for your rendering engine and you're ready to animate your content elements.

Supported Rendering Engines
============================

Bootstrap Package
-----------------
Full support for Bootstrap Package versions:

- v15.x (latest)

**Static Include:** ``Content Animations: Bootstrap Package v15.x`` (adjust version number accordingly)

Fluid Styled Content
--------------------
Native support for TYPO3's default Fluid Styled Content.

**Static Include:** ``Content Animations: Fluid Styled Content``

Content Blocks
--------------
Dedicated support for the modern Content Blocks extension (EXT:content_blocks).

**Static Include:** ``Content Animations: Content Blocks``

This include extends the Default Fluid Layout with the necessary data-attributes to get animations working in the frontend.


Constants
=========

The following global TypoScript constants are available:

+-------------------------------------------+---------------+-------------------------------------------------------------------+---------------+
| Parameter                                 | Data type     | Description                                                       | Default       |
+===========================================+===============+===================================================================+===============+
| plugin.tx_content_animations.aos-easing   | option        | set the global easing of all animations                           | ease          |
+-------------------------------------------+---------------+-------------------------------------------------------------------+---------------+
| plugin.tx_content_animations.aos-once     | boolean       | should the animation only happen once                             | true          |
+-------------------------------------------+---------------+-------------------------------------------------------------------+---------------+
| plugin.tx_content_animations.aos-mirror   | boolean       | should the element animate out while scrolling past them          | false         |
+-------------------------------------------+---------------+-------------------------------------------------------------------+---------------+


Example
=======

Here is an example of what the rendered HTML should look like:

.. code-block:: html

  <div id="c21563" class="frame frame-default frame-type-textpic ..."
       data-aos="fade-up"
       data-aos-duration="800"
       data-aos-delay="0"
       data-aos-once="true"
       data-aos-easing="ease"
       data-aos-mirror="false">
      ...
  </div>


Extending for Custom Rendering
===============================

If you use your own layouts or a custom rendering engine and want to support content_animations:

1. Include the static TypoScript: ``Content Animations: Basic Configuration``
2. Add the animation snippet to the outer HTML tag of your content elements:

.. code-block:: html

   {f:if(condition: animationSettings, then: '{animationSettings -> f:format.raw()}')}

This will add all necessary data-attributes to the HTML tag.

Custom Content Blocks Integration
==================================

For Content Blocks, the extension provides a dedicated integration that works seamlessly with the Content Blocks rendering pipeline. The animation settings are automatically available in your Content Block templates via the ``animationSettings`` variable.

**Example Content Block Template:**

.. code-block:: html

   <div class="my-content-block" {animationSettings -> f:format.raw()}>
       <!-- Your content block markup -->
   </div>


LayoutRootPath
==============

Content Animations extends the ``layoutRootPaths`` with the key **100** in all TypoScript includes except ``Content Animations: Basic Configuration``.

Available includes with extended layouts:

- Bootstrap Package (all versions)
- Fluid Styled Content
- Content Blocks

If you don't want the extended layout, you can remove it via:

.. code-block:: typoscript

   lib.contentElement.layoutRootPaths.100 >


JavaScript Loading
==================

Modern EventListener Approach
------------------------------

As of version 2.6.0, Content Animations uses a modern PSR-14 EventListener to load JavaScript assets via TYPO3's AssetCollector API.

**Key Benefits:**

- ✅ Automatic JavaScript loading (no TypoScript configuration needed)
- ✅ Proper dependency injection
- ✅ Better performance through AssetCollector
- ✅ TYPO3 13+ best practices

**Technical Implementation:**

The ``AddAosJavaScriptEventListener`` class automatically:

1. Loads the AOS library inline
2. Initializes AOS with ``AOS.init()``
3. Adds assets to the page footer

**No manual configuration required!**

AOS Library
-----------

Content Animations uses the **Simple-AOS** library by **Benjamin Ammann** (maintained fork of AOS by **Michał Sajnóg**):

- No jQuery or other dependencies required
- Lightweight and performant
- Uses modern Intersection Observer API
- Mobile-optimized


Advanced Customization
=======================

Custom Animation Library
------------------------

If you need to use a different animation library or customize the AOS initialization:

1. Disable the default EventListener in your ``Services.yaml``
2. Implement your own EventListener
3. Register it for the ``BeforeJavaScriptsRenderingEvent``

**Example:**

.. code-block:: yaml

   services:
     # Disable default listener (if needed)
     Baschte\ContentAnimations\EventListener\AddAosJavaScriptEventListener:
       public: false

     # Add your custom listener
     MyVendor\MyExtension\EventListener\CustomAnimationListener:
       tags:
         - name: event.listener
           identifier: 'my-custom-animation-loader'
           event: TYPO3\CMS\Core\Page\Event\BeforeJavaScriptsRenderingEvent


API Reference
=============

DataProcessor
-------------

The ``AnimationSettingsProcessor`` processes animation settings and makes them available in Fluid templates:

.. code-block:: typoscript

   tt_content {
       dataProcessing {
           78911002 = Baschte\ContentAnimations\DataProcessing\AnimationSettingsProcessor
       }
   }

This processor is automatically registered when including any static TypoScript template.


EventListener
-------------

``AddAosJavaScriptEventListener``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**Event:** ``TYPO3\CMS\Core\Page\Event\BeforeJavaScriptsRenderingEvent``

**Purpose:** Automatically loads AOS JavaScript library and initialization code.

**Configuration:** No configuration needed - works automatically when extension is installed.
