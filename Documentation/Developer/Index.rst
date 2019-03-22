.. include:: ../Includes.txt


.. _developer:

================
Developer Corner
================

Content Animations comes with an out of the box **bootstrap_package v10 v9 and v8**, **fluid_styled_content** and **higher_education_package v9** support. Just include the static typoscript of your used extension (for example Bootstrap Package) into the site template and you're good to go.
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

If you use your own Layouts and want to support content_animations please make sure that the following snippet is included in the outer html tag of your content elements.

.. code-block:: php

   {f:if(condition: data.tx_content_animations_animation, then: ' data-aos="{data.tx_content_animations_animation}" data-aos-duration="{data.tx_content_animations_duration}" data-aos-delay="{data.tx_content_animations_delay}" data-aos-once="{f:if(condition: aos-once, then: \'true\', else: \'false\')}" data-aos-easing="{aos-easing}" data-aos-mirror="{f:if(condition: aos-mirror, then: \'true\', else: \'false\')}"')}


LayoutRootPath
==============

Content Animations extends the layoutRootPaths with the key **100**.

If you don't want that please overwrite or delete it via ``lib.contentElement.layoutRootPaths.100 >`` in your template



Javascript
==========

Content Animations uses the AOS library by **Michał Sajnóg** which doesn't need jQuery or any other dependency.

It's included inline at the page bottom via ``page.jsFooterInline``.


Styling
=======

The css animations are included inline via ``page.cssInline``.
