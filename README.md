# Content Animations
`content_animations` is a extension for the TYPO3 content management system.

### What does it do
It allows you to set frontend animations to your content if its scrolled into the browsers viewport.\
\
![example of content_animations](https://raw.githubusercontent.com/baschte/content-animations/master/Documentation/Images/Example.gif)

### Dependencies
The extension is developed and tested with 13.4 LTS. It has an out of the box support for:
- **Bootstrap Package v15**
- **Fluid Styled Content**
- **Content Blocks**

### Configuration
Include the static TypoScript for your rendering engine:
- `Content Animations: bootstrap_package v15`
- `Content Animations: fluid_styled_content`
- `Content Animations: content_blocks`

Then start animating your content elements!

### Extending
`content_animations` comes with an extended `Default` fluid layout which adds the necessary markup to get the animations working. If you want to extend the layout just copy it to your extension, remove or update the content elements `layoutRootPaths` and you're good to go.

### Thanks
to **Michał Sajnóg** for his amazing [AOS](http://michalsnik.github.io/aos/) library which is forked and updated by **Benjamin Ammann** as [Simple-AOS](https://ammannbe.github.io/simple-aos/) which is included in `content_animations`.

## More Informations
See the [official documentation](https://docs.typo3.org/p/baschte/content-animations/main/en-us/) for more details how to implement content_animations
