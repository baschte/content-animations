.. include:: ../Includes.txt


.. _introduction:

============
Introduction
============


.. _what-it-does:

What does it do?
================

This extension allows you to set frontend animations to your content elements if
they're scrolled into the browsers viewport.

The extension integrates seamlessly with popular TYPO3 rendering engines:

- **Bootstrap Package** (v15.x)
- **Fluid Styled Content**
- **Content Blocks**

Features
========

- ✅ Easy-to-use backend interface for selecting animations
- ✅ 30+ pre-configured animations (fade, slide, zoom, flip)
- ✅ Visual animation preview in TYPO3 backend
- ✅ Timing controls (duration, delay)
- ✅ Advanced settings for fine-tuning (offset, anchor placement, easing)
- ✅ Performance-optimized with AOS (Animate On Scroll) library
- ✅ Mobile-friendly and responsive
- ✅ TYPO3 13 LTS compatible
- ✅ Content Blocks support


.. _screenshots:

Screenshot
==========

.. figure:: ../Images/Example.gif
   :width: 900px
   :alt: Preview of animation in TYPO3 Backend

   The animations TYPO3 backend preview just after installation


Technical Details
=================

The extension uses the modern **Simple-AOS** library (maintained fork of AOS - Animate On Scroll) which provides:

- Lightweight and performant animations
- CSS3 transitions and transforms
- Intersection Observer API for efficient scroll detection
- No jQuery dependency
- Mobile-optimized performance
