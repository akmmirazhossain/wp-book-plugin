// External Dependencies
import $ from 'jquery';

$(window).on('et_builder_api_ready', () => {

    if (window.ETBuilderBackend && window.ETBuilderBackend.defaults && window.DICK_Chart_Data) {
 
        if (window.DICK_Chart_Data.lineChartDefault) {
            window.ETBuilderBackend.defaults.dick_line_chart = window.DICK_Chart_Data.lineChartDefault;
        }

        if (window.DICK_Chart_Data.lineChartChildDefault) {
            window.ETBuilderBackend.defaults.dick_line_chart_child = window.DICK_Chart_Data.lineChartChildDefault;
        }

    }
});