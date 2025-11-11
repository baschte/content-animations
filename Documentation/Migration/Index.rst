.. include:: ../Includes.txt


.. _migration:

========================
Migration Guide (v2.6.0)
========================

This guide helps you migrate from version 2.5.x to 2.6.0 of the content_animations extension.

.. contents::
   :local:
   :depth: 2


What's New in 2.6.0
===================

Version 2.6.0 brings full TYPO3 13 compliance with modern best practices:

- ✅ Modern TCA syntax (associative arrays)
- ✅ PSR-14 EventListener for JavaScript loading
- ✅ AssetCollector API usage
- ✅ Proper Icon Registry
- ✅ Removed deprecated code and version checks
- ✅ TYPO3 12 support removed (TYPO3 13 only)


Breaking Changes Overview
=========================

1. **TYPO3 12 Support Removed**

   This version only supports TYPO3 13.4 LTS and higher.

2. **FILECONTENT Removed**

   The deprecated FILECONTENT ContentObject has been replaced with a modern EventListener.

3. **FileContentContentObject Class Removed**

   The class ``Baschte\ContentAnimations\ContentObject\FileContentContentObject`` no longer exists.

4. **TypoScript Changes**

   The JavaScript inclusion via TypoScript has been removed.

5. **ext_tables.php Restructured**

   TCA column definitions moved to ``Configuration/TCA/Overrides/tt_content.php``.


Migration Steps
===============

For Site Administrators
-----------------------

**Good News:** No manual migration required! 🎉

The extension automatically includes all necessary JavaScript via the new EventListener system.

**Optional Cleanup:**

If you have custom TypoScript that manually includes the AOS JavaScript, you can safely remove::

    page.jsFooterInline {
        161113 = FILECONTENT
        161113.file = EXT:content_animations/Resources/Public/JavaScript/Vendor/simple-aos/aos.4.2.0.min.js
        161114 = TEXT
        161114.value = AOS.init();
    }

This is now handled automatically by the ``AddAosJavaScriptEventListener``.


For Extension Developers
------------------------

**If you extended FileContentContentObject:**

The class no longer exists. If you extended or referenced this class:

1. Remove any class references to ``Baschte\ContentAnimations\ContentObject\FileContentContentObject``
2. Remove any custom FILECONTENT TypoScript objects that depend on this class
3. Consider using the TYPO3 AssetCollector API directly if you need similar functionality


**Custom JavaScript Loading:**

If you need to load additional JavaScript inline, use the AssetCollector::

    use TYPO3\CMS\Core\Page\AssetCollector;

    public function __construct(
        private readonly AssetCollector $assetCollector
    ) {}

    public function addCustomJavaScript(): void
    {
        $this->assetCollector->addInlineJavaScript(
            'my-identifier',
            'console.log("Hello World");',
            [],
            ['priority' => true] // Add to footer
        );
    }


Technical Changes
=================

TCA Modernization
-----------------

**Old Format (TYPO3 <13):**

.. code-block:: php

    'items' => [
        ['Label', 'value', 'icon.gif'],
        // ...
    ]

**New Format (TYPO3 13):**

.. code-block:: php

    'items' => [
        [
            'label' => 'Label',
            'value' => 'value',
            'icon' => 'icon.gif',
        ],
        // ...
    ]


Field Type Migration
--------------------

**Old Format:**

.. code-block:: php

    'config' => [
        'type' => 'input',
        'size' => 5,
        'eval' => 'trim,int',
        'range' => [
            'lower' => 0,
            'upper' => 3000,
        ],
    ]

**New Format:**

.. code-block:: php

    'config' => [
        'type' => 'number',
        'size' => 5,
        'range' => [
            'lower' => 0,
            'upper' => 3000,
        ],
    ]


JavaScript Loading via EventListener
-------------------------------------

**Old Approach (TypoScript):**

.. code-block:: typoscript

    page.jsFooterInline {
        161113 = FILECONTENT
        161113.file = EXT:content_animations/.../aos.4.2.0.min.js
        161114 = TEXT
        161114.value = AOS.init();
    }

**New Approach (EventListener):**

.. code-block:: php

    namespace Baschte\ContentAnimations\EventListener;

    use TYPO3\CMS\Core\Page\AssetCollector;

    final readonly class AddAosJavaScriptEventListener
    {
        public function __construct(
            private AssetCollector $assetCollector
        ) {}

        public function __invoke(): void
        {
            // Load JavaScript via AssetCollector
            $this->assetCollector->addInlineJavaScript(...);
        }
    }

Registration in ``Configuration/Services.yaml``::

    services:
      Baschte\ContentAnimations\EventListener\AddAosJavaScriptEventListener:
        tags:
          - name: event.listener
            identifier: 'content-animations/add-aos-javascript'
            event: TYPO3\CMS\Core\Page\Event\BeforeJavaScriptsRenderingEvent


Benefits of the New Approach
=============================

Modern TYPO3 13 Standards
--------------------------

- ✅ **PSR-14 Events**: Modern event system
- ✅ **Dependency Injection**: Proper DI container usage
- ✅ **AssetCollector**: Built-in asset management
- ✅ **Type Safety**: Readonly properties, proper types
- ✅ **Best Practices**: Following TYPO3 core conventions

Better Performance
------------------

- ⚡ **Efficient Loading**: Assets loaded only when needed
- ⚡ **Caching**: Better caching support
- ⚡ **No TypoScript Overhead**: Direct API usage

Improved Maintainability
-------------------------

- 🔧 **Cleaner Code**: Separation of concerns
- 🔧 **Testable**: EventListeners are easily testable
- 🔧 **Future-Proof**: Ready for TYPO3 14+


Troubleshooting
===============

JavaScript Not Loading
----------------------

**Symptoms:**
- Animations not working on frontend
- Console errors about AOS not defined

**Solution:**

1. Clear all caches::

    vendor/bin/typo3 cache:flush

2. Check browser console for errors


Animations Tab Missing
-----------------------

**Symptoms:**
- Animation tab not visible in content element backend form

**Solution:**

This should not happen with 2.6.0. If it does:

1. Clear all caches
2. Verify ``ext_tables.php`` exists
3. Check extension configuration (``disableAddAnimationsTab`` setting)


Need Help?
==========

- **GitHub Issues**: https://github.com/baschte/content-animations/issues

.. toctree::
   :maxdepth: 2
   :hidden:
