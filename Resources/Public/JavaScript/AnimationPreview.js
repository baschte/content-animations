define([ 'jquery' ], function ($) {
    /**
     * @exports TYPO3/CMS/ContentAnimations/AnimationPreview
     */
    var AnimationPreview = {
        $previewLabel: $('#preview-content-animation .preview-label'),
        $previewElement: $('#preview-content-animation .ce-preview'),
        $animationElement: $('[name*="[tx_content_animations_animation]"]'),
        $durationElement: $('[data-formengine-input-name*="[tx_content_animations_duration]"]'),
        $durationValueElement: $('[name*="[tx_content_animations_duration]"]'),
    };

    /**
     * Initialize AnimationPreview
     */
    AnimationPreview.initialize = function () {
        if (AnimationPreview.$animationElement.index() > -1) {
            AnimationPreview.$animationElement.on('change', AnimationPreview.handleAnimationChange);

            // set duration on initialization
            AnimationPreview.setCss({ animationName: AnimationPreview.$animationElement.val() });
        }

        if (AnimationPreview.$durationElement.index() > -1 && AnimationPreview.$durationValueElement.index() > -1) {
            AnimationPreview.$durationElement.on('change', AnimationPreview.handleDurationChange);

            // set duration on initialization
            AnimationPreview.setCss({ animationDuration: (AnimationPreview.$durationValueElement.val() / 1000) * 3.33 + 's' });
        }

    };

    /**
     * set css values to preview Element
     * @private
     * @param cssValueObject
     */
    AnimationPreview.setCss = function (cssValueObject) {
        if(!cssValueObject) return;
        AnimationPreview.$previewElement.css(cssValueObject);
    };

    /**
     * handle if animation changed
     * @private
     * @param event
     */
    AnimationPreview.handleAnimationChange = function (event) {
        if(!event) return;
        AnimationPreview.setCss({ animationName: event.target.value });
        AnimationPreview.$previewLabel.attr('data-show-preview', 'true');
    };

    /**
     * handle if duration changed
     * @private
     * @param event
     */
    AnimationPreview.handleDurationChange = function (event) {
        if(!event) return;
        AnimationPreview.setCss({ animationDuration: (event.target.value / 1000) * 3.33 + 's' });
    };

    AnimationPreview.initialize();

    return AnimationPreview;
});
