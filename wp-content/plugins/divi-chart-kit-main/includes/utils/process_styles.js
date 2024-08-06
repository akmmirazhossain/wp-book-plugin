const process_styles = {
    active_child: {},
    extend: function (defaults, options) {
        var extended = {};
        var prop;
        for (prop in defaults) {
            if (Object.prototype.hasOwnProperty.call(defaults, prop)) {
                extended[prop] = defaults[prop];
            }
        }
        for (prop in options) {
            if (Object.prototype.hasOwnProperty.call(options, prop)) {
                extended[prop] = options[prop];
            }
        }
        return extended;
    },
    process_icon_font_style: function (options = {}) {
        const defaults = {
            'props': {},
            'key': '',
            'additionalCss': '',
            'selector': ''
        };
        const settings = this.extend(defaults, options);
        var {props, key, additionalCss, selector} = settings;

        if (!props[key]) return;

        const utils = window.ET_Builder.API.Utils;
        if (!utils.processIconFontData) return;
        const iconData = utils.processIconFontData(props[key]);

        if (!iconData) return;

        if (iconData.iconFontFamily !== "ETmodules") {
            additionalCss.push([{
                selector: selector,
                declaration: `font-family: ${iconData.iconFontFamily} !important;`,
            }]);
        }
        additionalCss.push([{
            selector: selector,
            declaration: `font-weight: ${iconData.iconFontWeight} !important;`,
        }]);
    },

    process_margin_padding: function (options = {}) {
        // props, key, additionalCss, eleSelector, attr
        const defaults = {
            'props': {},
            'key': '',
            'additionalCss': '',
            'selector': '',
            'type': '',
            'important': true
        };
        const settings = this.extend(defaults, options);
        var {props, key, additionalCss, selector, type, important} = settings;
        var imText = important ? '!important' : '';

        const desktop = props[key];
        const tablet = props[key + '_tablet'];
        const mobile = props[key + '_phone'];

        if (desktop && '' !== desktop) {
            const desktopValue = desktop.split('|');
            additionalCss.push([{
                selector: selector,
                declaration: `${type}-top: ${desktopValue[0]}${imText};
                ${type}-right: ${desktopValue[1]}${imText};
                ${type}-bottom: ${desktopValue[2]}${imText};
                ${type}-left: ${desktopValue[3]}${imText};`,
            }]);
        }
        if (tablet && '' !== tablet) {
            const tabletValue = tablet.split('|');
            additionalCss.push([{
                selector: selector,
                declaration: `${type}-top: ${tabletValue[0]}${imText};
                ${type}-right: ${tabletValue[1]}${imText};
                ${type}-bottom: ${tabletValue[2]}${imText};
                ${type}-left: ${tabletValue[3]}${imText};`,
                'device': 'tablet',
            }]);
        }
        if (mobile && '' !== mobile) {
            const mobileValue = mobile.split('|');
            additionalCss.push([{
                selector: selector,
                declaration: `${type}-top: ${mobileValue[0]}${imText};
                ${type}-right: ${mobileValue[1]}${imText};
                ${type}-bottom: ${mobileValue[2]}${imText};
                ${type}-left: ${mobileValue[3]}${imText};`,
                'device': 'phone'
            }]);
        }
        if (props[key + '__hover_enabled']) {
            if (props['hover_enabled'] && props['hover_enabled'] === 1) {
                if (props[key + '__hover']) {
                    const hover = props[key + '__hover'];
                    const hoverValue = hover.split('|');
                    additionalCss.push([{
                        selector: selector,
                        declaration: `${type}-top: ${hoverValue[0]}${imText};
                        ${type}-right: ${hoverValue[1]}${imText};
                        ${type}-bottom: ${hoverValue[2]}${imText};
                        ${type}-left: ${hoverValue[3]}${imText};`,
                    }]);
                }
            }
        }
    },

    _renderDynamicContent: function (propValue, key, textContent = true) {
        const field = propValue.dynamic[key];
        if (key === 'content') {
            return field.render('full');
        }
        let fieldContent = textContent ? field.render() : field;

        if (field.loading) {
            // Let Divi render the loading placeholder.
            return textContent ? fieldContent : fieldContent.render();
        }
        return textContent ? fieldContent : fieldContent.value;
    },
};

export default process_styles;