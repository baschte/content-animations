# Content Animations
`content_animations` is a extension for the TYPO3 content management system.

### What does it do
It allows you to set frontend animations to your content if its scrolled into the browsers viewport.\
\
![example of content_animations](https://raw.githubusercontent.com/baschte/content-animations/master/Documentation/Images/Example.gif)

### Dependencies
The extension is developed and tested with TYPO3 8.7 and 9.5 LTS (not tested but maybe it's also working on TYPO3 7.6 LTS). It has an out of the box `bootstrap_package v8, v9 v10 and v11`, `fluid_styled_content` and `higher_education_package v9` support.

### Configuration
Include the static TypoScript for `Content Animations: bootstrap_package v8, v9, v10 or v11`, `Content Animations: fluid_styled_content` or `Content Animations: higher_education_package v9` to your template and you can start animating.

### Extending
`content_animations` comes with an extended `Default` fluid layout which adds the necessary markup to get the animations working. If you want to extend the layout just copy it to your extension, remove or update the content elements `layoutRootPaths` and you're good to go.

### Thanks
to **Michał Sajnóg** for his amazing [AOS](http://michalsnik.github.io/aos/) library which is included in `content_animations`.

## More Informations
See the [official documentation](https://docs.typo3.org/p/baschte/content-animations/main/en-us/) for more details how to implement content_animations
