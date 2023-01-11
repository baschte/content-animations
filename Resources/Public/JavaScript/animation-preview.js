import $ from"jquery";

class AnimationPreview {
    constructor() {
        this.previewLabel = $('#preview-content-animation .preview-label');
        this.previewElement = $('#preview-content-animation .ce-preview'),
        this.animationSelectField = $('[name*="[tx_content_animations_animation]"]');
        this.durationInputField = $('[data-formengine-input-name*="[tx_content_animations_duration]"]');
        this.durationValueInputField = $('[name*="[tx_content_animations_duration]"]');
        this.defaultClasses = 'aos-initialized aos-animate';
        this.defaultPreviewDuration = 800;
        this.defaultPreviewDelay = 0;
    }

    /**
     * change the preview animation
     * @private
     */
    changeAnimation = (duration, delay, removeAnimation) => {
        if (removeAnimation) {
            this.previewElement.removeClass(this.defaultClasses).css({ 'transition-duration': '0s' });
        } else {
            this.previewElement.removeAttr('style').addClass(this.defaultClasses);
        }
        this.defaultPreviewDuration = parseInt(duration);
        this.defaultPreviewDelay = parseInt(delay);
    };

    /**
     * resets the preview animation
     * @private
     */
    restartAnimation = () => {
        this.previewElement.removeClass(this.defaultClasses).css({ 'transition-duration': '0s' });
        this.defaultPreviewDuration = 250;
        this.defaultPreviewDelay = 0;

        clearInterval(this.defaultInterval);
        this.playAnimationLoop();
    };

    /**
     * start the animation preview
     * @private
     */
    playAnimationLoop = () => {
        this.defaultInterval = setInterval(() => {
            if (this.previewElement.hasClass(this.defaultClasses)) {
                // remove animationPreview
                this.changeAnimation(250, 0, true);
            } else {
                // add animationPreview
                this.changeAnimation(parseInt(this.durationValueInputField.val()), 1000, false);
            }
            // clearInterval and restart previewLoop
            clearInterval(this.defaultInterval);
            this.playAnimationLoop();
        }, this.defaultPreviewDuration + this.defaultPreviewDelay);
    };

    /**
     * set attribute values to preview Element
     * @private
     * @param attrValueObject
     */
    setAttr = (attrValueObject) => {
        if (!attrValueObject) return;
        this.previewElement.attr(attrValueObject);
    };

    /**
     * handle if animation changed
     * @private
     * @param event
     */
    handleAnimationChange = (event) => {
        if (!event) return;
        this.previewLabel.attr('data-show-preview', 'true');
        this.setAttr({ 'data-aos': event.target.value });
        this.restartAnimation();
    };

    /**
     * handle if duration changed
     * @private
     * @param event
     */
    handleDurationChange = (event) => {
        if (!event) return;
        this.defaultPreviewDuration = parseInt(event.target.value);
        this.setAttr({ 'data-aos-duration': this.defaultPreviewDuration });
        this.restartAnimation();
    };

    initialize = () => {
        // if animationField is found in this form
        if (this.animationSelectField.index() > -1) {
            this.animationSelectField.on('change', this.handleAnimationChange);

            // set duration on initialization
            this.setAttr({ 'data-aos': this.animationSelectField.val() });
        }

        // if durationField is found in this form
        if (this.durationInputField.index() > -1 && this.durationValueInputField.index() > -1) {
            this.durationInputField.on('change', this.handleDurationChange);
            this.defaultPreviewDuration = parseInt(this.durationValueInputField.val());

            // set duration on initialization
            this.setAttr({ 'data-aos-duration': parseInt(this.durationValueInputField.val()) });
        }

        // initialize preview and start previewLoop
        this.previewElement.addClass(this.defaultClasses);
        this.playAnimationLoop();
    }
}

let animationPreview = new AnimationPreview;
animationPreview.initialize();

export default animationPreview;
