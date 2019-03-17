# Content animations
`content_animations` is a extension for the TYPO3 content management system.

### What does it do
It allows you to set frontend animations to your content if its scrolled into the browser viewport.\
\
![example of content_animations](https://raw.githubusercontent.com/baschte/content-animations/master/Documentation/Images/Example.gif)

### Configuration
Include the static TypoScript to your template and you can start animating.

### Dependencies
The extension is developed and tested with TYPO3 8.7 and 9.5 LTS (not tested but maybe it's also working on TYPO3 7.6 LTS). It has an out of the box `fluid_styled_content` and `higher_education_package` support.

### Extending
`content_animations` comes with an extended `Default` fluid layout which adds the necessary markup to get the animations working. If you want to extend the layout just copy it to your extension, remove or update the content elements `layoutRootPaths` and you're good to go.

### Thanks
to **Michał Sajnóg** for his amazing [AOS](http://michalsnik.github.io/aos/) library which is included in `content_animations`.
