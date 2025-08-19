# Content Animations
`content_animations` is a extension for the TYPO3 content management system.

### What does it do
It allows you to set frontend animations to your content if its scrolled into the browsers viewport.\
\
![example of content_animations](https://raw.githubusercontent.com/baschte/content-animations/master/Documentation/Images/Example.gif)

### Dependencies
The extension is developed and tested with TYPO3 12.4 until 13.4 LTS. It has an out of the box `bootstrap_package v13, v14 and v15` and `fluid_styled_content` support.

### Configuration
For **TYPO3 13 with Site Configuration**: Include the appropriate Site Set for `Content Animations: bootstrap_package v13, v14 or v15` or `Content Animations: fluid_styled_content` in your site configuration.

For **TYPO3 12 and earlier** or **classic template setup**: Include the static TypoScript for `Content Animations: bootstrap_package v13, v14 or v15` or `Content Animations: fluid_styled_content` to your template and you can start animating.

### Extending
`content_animations` comes with an extended `Default` fluid layout which adds the necessary markup to get the animations working. If you want to extend the layout just copy it to your extension, remove or update the content elements `layoutRootPaths` and you're good to go.

### Thanks
to **Michał Sajnóg** for his amazing [AOS](http://michalsnik.github.io/aos/) library which is forked and updated by **Benjamin Ammann** as [Simple-AOS](https://ammannbe.github.io/simple-aos/) which is included in `content_animations`.

## More Informations
See the [official documentation](https://docs.typo3.org/p/baschte/content-animations/main/en-us/) for more details how to implement content_animations
