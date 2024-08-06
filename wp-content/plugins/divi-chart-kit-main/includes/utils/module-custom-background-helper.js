export default class ModuleCustomBackgroundHelper {
    /**
     * Parsed *_last_edited value and determine whether the passed string means it has responsive value or not
     * *_last_edited holds two values (responsive status and last opened tabs) in the following format:
     * status|last_opened_tab
     *
     * @since 1.0.0
     *
     * @param {string} lastEdited Last edited value for module
     *
     * @return {string[]} Responsive values for all devices
     */
    static get_responsive_device(lastEdited) {
        return typeof lastEdited === 'string' ? lastEdited.split('|') : ['off', 'desktop'];
    }

    /**
     * Parsed *_last_edited value and determine wheter the passed string means it has responsive value or not
     * *_last_edited holds two values (responsive status and last opened tabs) in the following format:
     * status|last_opened_tab
     *
     * @since 1.0.0
     *
     * @param {string} lastEdited
     *
     * @return {string} Pass is responsive is on or not
     */
    static get_responsive_status(lastEdited) {
        return !!this.get_responsive_device(lastEdited)[0] ? this.get_responsive_device(lastEdited)[0] : 'off';
    }

    /**
     * Parsed offset type value and pass the offset list for the type
     *
     * @since 1.0.0
     *
     * @param {string} type
     *
     * @return {Array} Pass is the offset array list
     */
    static get_offset_properties(type) {
        const backgroundOffset = {
            horizontal: ['center_left', 'center_right'],
            vertical: ['top_center', 'bottom_center'],
            both: ['top_left', 'top_right', 'bottom_left', 'bottom_right'],
        };

        if (undefined !== backgroundOffset[type]) {
            return backgroundOffset[type];
        }

        return [];
    }

    /**
     * Parsed *_position and *_horizontal_offset value and generate sting value with the passed string
     *
     * @since 1.0.0
     *
     * @param {string} position The position value for background image
     * @param {string} offset   The offset value for background image
     *
     * @return {string} Pass the actual value for horizontal offset
     */
    static get_horizontal_offset_only(position, offset) {
        return position.replace('_', `_${offset}_`).split('_').reverse().join(' ');
    }

    /**
     * Parsed *_position and *_vertical_offset value and generate sting value with the passed string
     *
     * @since 1.0.0
     *
     * @param {string} position The position value for background image
     * @param {string} offset   The offset value for background image
     *
     * @return {string} Pass the actual value for vertical offset
     */
    static get_vertical_offset_only(position, offset) {
        const backgroundOffsetValues = position.split('_').reverse();
        backgroundOffsetValues.push(offset);

        return backgroundOffsetValues.join(' ');
    }

    /**
     * Parsed *_position, *_horizontal_offset and *_vertical_offset value and generate sting value with the passed string
     *
     * @since 1.0.0
     *
     * @param {string} position The position value for background image
     * @param {string} hOffset  The horizontal offset value for background image
     * @param {string} vOffset  The vertical offset value for background image
     *
     * @return {string} Pass the actual value for vertical offset
     */
    static get_background_image_offset(position, hOffset, vOffset) {
        let backgroundOffsetValues = position.replace('_', `_${hOffset}_`);
        backgroundOffsetValues = backgroundOffsetValues.split('_').reverse();

        return backgroundOffsetValues.push(vOffset).join(' ');
    }

    /**
     * Set background color styles for current field with default, responsive and hover
     *
     * @since 1.0.0
     *
     * @param {Object} options All options which are provided by module
     *
     * @return {*} void
     */
    static generateStyles_backgroundColor(options = {}) {
        const baseProp = options.base_name;
        const _colorLastEdited = options.props[`${baseProp}_color_last_edited`];
        const _enableColorTablet = options.props[`${baseProp}_enable_color_tablet`];
        const _enableColorPhone = options.props[`${baseProp}_enable_color_phone`];
        const __hoverEnabled = options.props[`${baseProp}_color__hover_enabled`];
        const _enableColorHover = options.props[`${baseProp}_enable_color__hover`];

        // Additional properties
        const additionalProp = options.important ? '!important' : '';

        // [multiply, screen, overlay, darken, lighten, color-dodge, color-burn, hard-light, soft-light, difference, exclusion, hue, saturation, color, luminosity]
        // Collect current blend mode
        let _imageProp = '';
        let _backgroundColor = '';
        const _blendModeProp = `${options.base_name}_blend`;
        const _blendMode = !!options.props[_blendModeProp] ? options.props[_blendModeProp] : 'normal';

        // Working with default background color in default (Desktop) mode
        if (!!options.props[`${baseProp}_color`]) {
            // Update the background color depend on blend mode
            _imageProp = `${options.base_name}_image`;
            _backgroundColor = _blendMode !== 'normal' && !!options.props[_imageProp] ? 'initial' : options.props[`${baseProp}_color`];

            options.additionalCSS.push([{
                selector: options.selector,
                declaration: `background-color: ${_backgroundColor} ${additionalProp};`
            }]);
        }

        // Working with background color in tablet device mode
        if (this.get_responsive_status(_colorLastEdited) === 'on' && _enableColorTablet === 'on') {
            // Update the background color depend on blend mode
            _imageProp = `${options.base_name}_image_tablet`;
            _backgroundColor = _blendMode !== 'normal' && !!options.props[_imageProp] ? 'initial' : options.props[`${baseProp}_color_tablet`];

            options.additionalCSS.push([{
                selector: options.selector,
                declaration: `background-color: ${_backgroundColor} ${additionalProp};`,
                device: 'tablet', // tablet
            }]);
        }

        // Working with background color in phone device mode
        if (this.get_responsive_status(_colorLastEdited) === 'on' && _enableColorPhone === 'on') {
            // Update the background color depend on blend mode
            _imageProp = `${options.base_name}_image_phone`;
            _backgroundColor = _blendMode !== 'normal' && !!options.props[_imageProp] ? 'initial' : options.props[`${baseProp}_color_phone`];

            options.additionalCSS.push([{
                selector: options.selector,
                declaration: `background-color: ${_backgroundColor} ${additionalProp};`,
                device: 'phone', // phone
            }]);
        }

        // Working with hover background color
        if (options.props.hover_enabled && typeof options.props.hover_enabled === 'number' && __hoverEnabled === 'on|hover' && _enableColorHover === 'on') {
            // Update the background color depend on blend mode
            _imageProp = `${options.base_name}_image__hover`;
            _backgroundColor = _blendMode !== 'normal' && !!options.props[_imageProp] ? 'initial' : options.props[`${baseProp}_color__hover`];

            options.additionalCSS.push([{
                selector: !!options.hover ? options.hover : options.selector,
                declaration: `background-color: ${_backgroundColor} ${additionalProp};`
            }]);
        }
    }

    /**
     * Set background gradient color styles for the current field with default, responsive and hover
     *
     * @since 1.0.0
     *
     * @param {Object} options All options which are provided by module
     *
     * @return {*} void
     */
    static generateStyles_backgroundImage(options = {}) {
        // Initiate variables
        const _gradient = {
            type_property: '',
            parsed_value: '',
            declaration: '',
            type: 'linear',
            direction: '180deg',
            unit: '%',
            direction_radial: 'center',
            stops: '#2b87da 0%|#29c4a9 100%'
        };

        const baseProp = options.base_name;
        const _colorLastEdited = options.props[`${baseProp}_color_last_edited`];

        const _useColorGradientTablet = options.props[`${baseProp}_use_color_gradient_tablet`];
        const _enableImageTablet = options.props[`${baseProp}_enable_image_tablet`];

        const _useColorGradientPhone = options.props[`${baseProp}_use_color_gradient_phone`];
        const _enableImagePhone = options.props[`${baseProp}_enable_image_phone`];

        const __hoverEnabled = options.props[`${baseProp}_color__hover_enabled`];
        const _useColorGradientHover = options.props[`${baseProp}_use_color_gradient__hover`];
        const _enableImageHover = options.props[`${baseProp}_enable_image__hover`];

        // Working with default background gradient color and image
        this.process_gradient_properties(options, _gradient);
        this.process_background_image(options, _gradient);

        // Working with tablet background gradient color and image
        if (this.get_responsive_status(_colorLastEdited) === 'on' && (_useColorGradientTablet === 'on' || _enableImageTablet === 'on')) {
            // Working with tablet mode background gradient color and image
            this.process_gradient_properties(options, _gradient, 'tablet');
            this.process_background_image(options, _gradient, 'tablet');
        }

        // Working with phone background gradient color and image
        if (this.get_responsive_status(_colorLastEdited) === 'on' && (_useColorGradientPhone === 'on' || _enableImagePhone === 'on')) {
            // Working with mobile background gradient color and image
            this.process_gradient_properties(options, _gradient, 'phone');
            this.process_background_image(options, _gradient, 'phone');
        }

        // Working with hover background gradient color and image
        if (options.props.hover_enabled &&
            typeof options.props.hover_enabled === 'number' &&
            __hoverEnabled === 'on|hover' &&
            (_useColorGradientHover === 'on' || _enableImageHover === 'on')) {
            // Working with hover background gradient color and image
            this.process_gradient_properties(options, _gradient, '_hover');
            this.process_background_image(options, _gradient, '_hover');
        }
    }

    /**
     * Process the background gradient property for current background field
     *
     * @since 1.0.0
     *
     * @param {Object} options   All options which are provided by module
     * @param {Object} _gradient The property object for Gradient Color
     * @param {string} device    current device name, it will be empty when device is desktop
     *
     * @return {Object} The property object for Gradient Color
     */
    static process_gradient_properties(options = {}, _gradient = {}, device = '') {
        const _currentDevice = device !== '' ? `_${device}` : device;

        if (!!options.props[`${options.context}_gradient_stops${_currentDevice}`]) {
            _gradient.stops = options.props[`${options.context}_gradient_stops${_currentDevice}`];
        }

        if (!!options.props[`${options.context}_gradient_type${_currentDevice}`]) {
            _gradient.type = options.props[`${options.context}_gradient_type${_currentDevice}`];
        }

        if (!!options.props[`${options.context}_gradient_direction${_currentDevice}`]) {
            _gradient.direction = options.props[`${options.context}_gradient_direction${_currentDevice}`];
        }

        if (!!options.props[`${options.context}_gradient_direction_radial${_currentDevice}`]) {
            _gradient.direction_radial = options.props[`${options.context}_gradient_direction_radial${_currentDevice}`];
        }

        // download_referral_label_background_color_gradient_unit
        if (!!options.props[`${options.context}_gradient_unit${_currentDevice}`] && _gradient.type !== 'conic') {
            _gradient.unit = options.props[`${options.context}_gradient_unit${_currentDevice}`];
            _gradient.stops = _gradient.stops.replace(/%/ig, _gradient.unit);
        }

        _gradient.type_property_prefix = _gradient.type === 'circular' || _gradient.type === 'elliptical' ? 'radial' : _gradient.type;
        _gradient.type_property = `${_gradient.type_property_prefix}-gradient`;
        _gradient.parsed_value = _gradient.stops.split('|').join(', ');

        // background_color_gradient_repeat = on
        if (options.props[`${options.base_name}_color_gradient_repeat${_currentDevice}`] === 'on') {
            _gradient.type_property = `repeating-${_gradient.type_property}`;
        }

        return _gradient;
    }

    /**
     * Process the background gradient property and image for current background field
     *
     * @since 1.0.0
     *
     * @param {Object} options   All options which are provided by module
     * @param {Object} _gradient The property object for Gradient Color
     * @param {string} device    current device name, it will be empty when device is desktop
     *
     * @return {*} void
     */
    static process_background_image(options = {}, _gradient = {}, device = '') {
        let backgroundImage = '';
        let backgroundGradientImage = '';
        let generatedBackgroundImage = '';
        const _currentDevice = device !== '' ? `_${device}` : device;
        const additionalProp = options.important ? '!important' : '';

        // prevent default gradient color, when gradient color is turn off but image is enabled by default.
        if (options.props[`${options.base_name}_use_color_gradient`] === 'on') {
            // default linear gradient declaration
            if (_gradient.type === 'linear') {
                _gradient.declaration = `${_gradient.type_property}(${_gradient.direction}, ${_gradient.parsed_value})`;
            }

            // default conic gradient declaration
            if (_gradient.type === 'conic') {
                _gradient.declaration = `${_gradient.type_property}(from ${_gradient.direction} at ${_gradient.direction_radial}, ${_gradient.parsed_value})`;
            }

            // default circular gradient declaration
            if (_gradient.type === 'circular') {
                _gradient.declaration = `${_gradient.type_property}(circle at ${_gradient.direction_radial}, ${_gradient.parsed_value})`;
            }

            // default elliptical gradient declaration
            if (_gradient.type === 'elliptical') {
                _gradient.declaration = `${_gradient.type_property}(ellipse at ${_gradient.direction_radial}, ${_gradient.parsed_value})`;
            }

            backgroundGradientImage = _gradient.declaration;
        }

        // Set parallax effect for background image
        // download_referral_label_background_parallax : "off"
        if (options.props[`${options.base_name}_parallax`] !== 'on') {
            // Set image background size
            if (!!options.props[`${options.base_name}_size${_currentDevice}`]) {
                if (options.props[`${options.base_name}_size${_currentDevice}`] === 'custom') {
                    const _imageWidthProp = `${options.base_name}_image_width${_currentDevice}`;
                    const _imageHeightProp = `${options.base_name}_image_height${_currentDevice}`;

                    if (!!options.props[_imageWidthProp] || !!options.props[_imageHeightProp]) {
                        const _imageWidth = !!options.props[_imageWidthProp] ? options.props[_imageWidthProp] : 'auto';
                        const _imageHeight = !!options.props[_imageHeightProp] ? options.props[_imageHeightProp] : 'auto';

                        this.merge_additional_css(options, device, {
                            selector: options.selector,
                            declaration: `background-size: ${_imageWidth} ${_imageHeight} ${additionalProp};`,
                        });
                    } else {
                        this.merge_additional_css(options, device, {
                            selector: options.selector,
                            declaration: `background-size: initial ${additionalProp};`,
                        });
                    }
                } else {
                    this.merge_additional_css(options, device, {
                        selector: options.selector,
                        declaration: `background-size: ${options.props[`${options.base_name}_size${_currentDevice}`]} ${additionalProp};`,
                    });
                }
            }

            // Set image background position
            if (!!options.props[`${options.base_name}_position${_currentDevice}`]) {
                const _position = options.props[`${options.base_name}_position${_currentDevice}`];
                const _horizontalOffsetProp = `${options.base_name}_horizontal_offset${_currentDevice}`;
                const _verticalOffsetProp = `${options.base_name}_vertical_offset${_currentDevice}`;

                // Horizontal Offset only
                if (this.get_offset_properties('horizontal').includes(options.props[`${options.base_name}_position${_currentDevice}`])) {
                    if (!!options.props[_horizontalOffsetProp]) {
                        const _horizontalOffset = options.props[_horizontalOffsetProp];
                        const generatedValue = this.get_horizontal_offset_only(_position, _horizontalOffset);

                        this.merge_additional_css(options, device, {
                            selector: options.selector,
                            declaration: `background-position: ${generatedValue} ${additionalProp};`
                        });
                    }
                }

                // Vertical Offset only
                if (this.get_offset_properties('vertical').includes(options.props[`${options.base_name}_position${_currentDevice}`])) {
                    if (!!options.props[_verticalOffsetProp]) {
                        const _verticalOffset = options.props[_verticalOffsetProp];
                        const generatedValue = this.get_vertical_offset_only(_position, _verticalOffset);

                        this.merge_additional_css(options, device, {
                            selector: options.selector,
                            declaration: `background-position: ${generatedValue} ${additionalProp};`
                        });
                    }
                }

                // Horizontal and Vertical Offset both
                if (this.get_offset_properties('both').includes(options.props[`${options.base_name}_position${_currentDevice}`])) {
                    const _horizontalOffset = !!options.props[_horizontalOffsetProp] ? options.props[_horizontalOffsetProp] : '0px';
                    const _verticalOffset = !!options.props[_verticalOffsetProp] ? options.props[_verticalOffsetProp] : '0px';

                    const generatedValue = this.get_background_image_offset(_position, _horizontalOffset, _verticalOffset);
                    this.merge_additional_css(options, device, {
                        selector: options.selector,
                        declaration: `background-position: ${generatedValue} ${additionalProp};`
                    });
                }

                // set background position for default state
                if (_position === 'center') {
                    const backgroundPosition = options.props[`${options.base_name}_position${_currentDevice}`].split('_').reverse().join(' ');
                    this.merge_additional_css(options, device, {
                        selector: options.selector,
                        declaration: `background-position: ${backgroundPosition} ${additionalProp};`
                    });
                }
            }

            // Set background repeat option
            if (!!options.props[`${options.base_name}_repeat${_currentDevice}`]) {
                this.merge_additional_css(options, device, {
                    selector: options.selector,
                    declaration: `background-repeat: ${options.props[`${options.base_name}_repeat${_currentDevice}`]} ${additionalProp};`
                });
            }
        }

        // Set background blend option
        if (!!options.props[`${options.base_name}_blend${_currentDevice}`]) {
            this.merge_additional_css(options, device, {
                selector: options.selector,
                declaration: `background-blend-mode: ${options.props[`${options.base_name}_blend${_currentDevice}`]} ${additionalProp};`,
            });
        }

        // download_referral_label_background__image = undefined, url
        if (!!options.props[`${options.base_name}_image${_currentDevice}`]) {
            backgroundImage = `url(${options.props[`${options.base_name}_image${_currentDevice}`]})`;
        }

        // download_referral_label_background_color_gradient_overlays_image = undefined, off
        if (!!backgroundGradientImage && !!backgroundImage) {
            if (options.props[`${options.base_name}_color_gradient_overlays_image${_currentDevice}`] === 'on') {
                generatedBackgroundImage = `${backgroundGradientImage}, ${backgroundImage}`;
            } else {
                generatedBackgroundImage = `${backgroundImage}, ${backgroundGradientImage}`;
            }
        } else if (!!backgroundGradientImage) {
            generatedBackgroundImage = backgroundGradientImage;
        } else {
            generatedBackgroundImage = backgroundImage;
        }

        // Create default background image declaration
        if (!!generatedBackgroundImage) {
            this.merge_additional_css(options, device, {
                selector: options.selector,
                declaration: `background-image: ${generatedBackgroundImage} ${additionalProp};`,
            });
        }
    }

    /**
     * Merge the current custom style object into the Additional CSS object for Divi
     *
     * @since 1.0.0
     *
     * @param {Object} options     All options which are provided by module
     * @param {string} device      current device name, it will be empty when device is desktop
     * @param {Object} customStyle All options which are provided by module
     *
     * @return {*} void
     */
    static merge_additional_css(options, device = '', customStyle = {}) {
        // Add a device into a style object when a current device is tablet or phone
        if (device !== '' && device !== '_hover') {
            customStyle.device = device;
        }

        options.additionalCSS.push([customStyle]);
    }

    /**
     * Set background styles for a current element with default, responsive and hover
     *
     * @since 1.0.0
     *
     * @param {Object} options All options which are provided by module
     *
     * @return {*} void
     */
    static generateStyles(options) {
        // Working with background color
        this.generateStyles_backgroundColor(options);

        // Working with background gradient color and image
        this.generateStyles_backgroundImage(options);
    }
}