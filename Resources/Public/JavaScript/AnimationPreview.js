define([ 'jquery' ], function ($) {
    /**
     * @exports TYPO3/CMS/ContentAnimations/AnimationPreview
     */
    var AnimationPreview = {
        $previewLabel: $('#preview-content-animation .preview-label'),
        $previewElement: $('#preview-content-animation .ce-preview'),
        $animationSelectField: $('[name*="[tx_content_animations_animation]"]'),
        $durationInputField: $('[data-formengine-input-name*="[tx_content_animations_duration]"]'),
        $durationValueInputField: $('[name*="[tx_content_animations_duration]"]'),
        defaultClasses: 'aos-initialized aos-animate',
        defaultPreviewDuration: 800,
        defaultPreviewDelay: 1000,
    };

    /**
     * change the preview animation
     * @private
     */
    AnimationPreview.changeAnimation = function (duration, delay, removeAnimation) {
        if (removeAnimation) {
            AnimationPreview.$previewElement.removeClass(AnimationPreview.defaultClasses).css({ 'transition-duration': '0s' });
        } else {
            AnimationPreview.$previewElement.removeAttr('style').addClass(AnimationPreview.defaultClasses);
        }
        AnimationPreview.defaultPreviewDuration = parseInt(duration);
        AnimationPreview.defaultPreviewDelay = parseInt(delay);
    };

    /**
     * resets the preview animation
     * @private
     */
    AnimationPreview.restartAnimation = function () {
        AnimationPreview.$previewElement.removeClass(AnimationPreview.defaultClasses).css({ 'transition-duration': '0s' });
        AnimationPreview.defaultPreviewDuration = 250;
        AnimationPreview.defaultPreviewDelay = 0;

        clearInterval(AnimationPreview.defaultInterval);
        AnimationPreview.playAnimationLoop();
    };

    /**
     * start the animation preview
     * @private
     */
    AnimationPreview.playAnimationLoop = function () {
        AnimationPreview.defaultInterval = setInterval(function () {
            if (AnimationPreview.$previewElement.hasClass(AnimationPreview.defaultClasses)) {
                // remove animationPreview
                AnimationPreview.changeAnimation(250, 0, true);
            } else {
                // add animationPreview
                AnimationPreview.changeAnimation(parseInt(AnimationPreview.$durationValueInputField.val()), 1000, false);
            }
            // clearInterval and restart previewLoop
            clearInterval(AnimationPreview.defaultInterval);
            AnimationPreview.playAnimationLoop();
        }, AnimationPreview.defaultPreviewDuration + AnimationPreview.defaultPreviewDelay);
    };

    /**
     * set attribute values to preview Element
     * @private
     * @param attrValueObject
     */
    AnimationPreview.setAttr = function (attrValueObject) {
        if (!attrValueObject) return;
        AnimationPreview.$previewElement.attr(attrValueObject);
    };

    /**
     * handle if animation changed
     * @private
     * @param event
     */
    AnimationPreview.handleAnimationChange = function (event) {
        if (!event) return;
        AnimationPreview.$previewLabel.attr('data-show-preview', 'true');
        AnimationPreview.setAttr({ 'data-aos': event.target.value });
        AnimationPreview.restartAnimation();
    };

    /**
     * handle if duration changed
     * @private
     * @param event
     */
    AnimationPreview.handleDurationChange = function (event) {
        if (!event) return;
        AnimationPreview.defaultPreviewDuration = parseInt(event.target.value);
        AnimationPreview.setAttr({ 'data-aos-duration': AnimationPreview.defaultPreviewDuration });
        AnimationPreview.restartAnimation();
    };

    /**
     * Initialize AnimationPreview
     */
    AnimationPreview.initialize = function () {
        // if animationField is found in this form
        if (AnimationPreview.$animationSelectField.index() > -1) {
            AnimationPreview.$animationSelectField.on('change', AnimationPreview.handleAnimationChange);

            // set duration on initialization
            AnimationPreview.setAttr({ 'data-aos': AnimationPreview.$animationSelectField.val() });
        }

        // if durationField is found in this form
        if (AnimationPreview.$durationInputField.index() > -1 && AnimationPreview.$durationValueInputField.index() > -1) {
            AnimationPreview.$durationInputField.on('change', AnimationPreview.handleDurationChange);
            AnimationPreview.defaultPreviewDuration = parseInt(AnimationPreview.$durationValueInputField.val());

            // set duration on initialization
            AnimationPreview.setAttr({ 'data-aos-duration': parseInt(AnimationPreview.$durationValueInputField.val()) });
        }

        // initialize preview and start previewLoop
        AnimationPreview.$previewElement.addClass(AnimationPreview.defaultClasses);
        AnimationPreview.playAnimationLoop();
    };

    // call init
    AnimationPreview.initialize();

    return AnimationPreview;
});
