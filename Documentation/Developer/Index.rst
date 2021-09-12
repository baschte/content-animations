.. include:: ../Includes.txt


.. _developer:

================
Developer Corner
================

Content Animations comes with an out of the box **bootstrap_package v12, v11, v10, v9 and v8**, **fluid_styled_content** and **higher_education_package v10** support. Just include the static typoscript of your used extension (for example Bootstrap Package) into the site template and you're good to go.
This extension extends the **Default Fluid Layout** for the necessary data-attributes to get the animation stuff working in the frontend.


Constants
=========

The following global typoscript constants are available:

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

Here is an example of what the rendered HTML should look like

.. code-block:: html

  <div id="c21563" class="frame frame-default frame-type-textpic ..." data-aos="fade-up" data-aos-duration="800" data-aos-delay="0" data-aos-once="true" data-aos-easing="ease" data-aos-mirror="false">
      ...
  </div>


Extending
=========

If you use your own Layouts and want to support content_animations please make sure that the `Content Animations: Basic Configuration` is included in your TS-Template and that the snippet is included in the outer html tag of your content elements. This will add all the necessary attributes and settings to the html tag.

.. code-block:: php

   {f:if(condition: animationSettings, then: '{animationSettings -> f:format.raw()}')}


LayoutRootPath
==============

Content Animations extends the layoutRootPaths with the key **100** in all typoscript includes except `Content Animations: Basic Configuration`.

If you don't want that please overwrite or delete it via ``lib.contentElement.layoutRootPaths.100 >`` in your template



Javascript
==========

Content Animations uses the AOS library by **Michał Sajnóg** which doesn't need jQuery or any other dependency.

It's included inline at the page bottom via ``page.jsFooterInline``.


Styling
=======

The css animations are included inline via ``page.cssInline``.
