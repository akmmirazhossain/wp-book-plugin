(function ($) {
    document.addEventListener( 'DOMContentLoaded', function() {
        var dick_line_chart = document.querySelectorAll('.dick_line_chart');
        
        dick_line_chart.forEach(function(ele, index) {

          var lineSelector = ele.querySelector('.dick-line-chart-container');

          const categories = lineSelector.dataset.categories;
          const settings = JSON.parse(lineSelector.dataset.settings);
          const series =JSON.parse(lineSelector.dataset.series);

          // var ele_class = ele.classList.value.split(" ").filter(function (class_name) {
          //     return class_name.indexOf('dick_line_chart_') !== -1;
          // });
          var mainDiv = lineSelector.querySelector('.dick-line-chart');
          // Create a unique ID for each chart
          var uniqueID = 'dick-line-chart-' + index;
          mainDiv.setAttribute('id', uniqueID);


          const categoriesArray = categories.split(',').map(item => {
              const num = Number(item);
              return isNaN(num) ? item : num;
          });
   
          const seriesArray = Object.values(series).map(item => {
      
              return {
                  ...item,
                  data: item.data.split(',').map(Number),
                  ...(item.item_line_color !== '' && { color: item.item_line_color }),
                  ...(item.item_line_width !== 0 && { width: parseInt(item.item_line_width) })
              };
          });

          // Extracting item_line_width values into a new array
          const lineWidths = seriesArray.map(item => item.width).filter(width => width !== undefined);

      
          var options = {
            chart: {
              type: 'line',
              height: settings.chart_height ? parseInt(settings.chart_height, 10) : 'auto',
              width: settings.chart_width ? settings.chart_width: '100%',
          
              animations: settings.enable_animation ? {
                  enabled: true,
                  easing: settings.timing_function_type !== '' ? Number(settings.timing_function_type) : "easeinout",
                  speed:  settings.animation_speed !== '' ? Number(settings.animation_speed) : 800, 
                  animateGradually: settings.enable_gradually_animation  ? 
                    {
                      enabled: true,
                      speed: settings.gradually_animation_delay !== '' ? Number(settings.gradually_animation_delay) : 150,
                    } :
                    { 
                      enabled: false
                    },
                 
                  dynamicAnimation: settings.enable_dynamic_animation  ? 
                    {
                      enabled: true,
                      speed: settings.dynamic_animation_speed !== '' ? Number(settings.dynamic_animation_speed) : 350,
                    } :
                    { 
                      enabled: false
                    },
              } : {
              enabled: false,
              },
              zoom: settings.use_zoom  ? {
                enabled: true,
                type: 'x',
                autoScaleYaxis: false,
                zoomedArea: {
                  fill: {
                    color: '#90CAF9',
                    opacity: 0.4
                  },
                  stroke: {
                    color: '#0D47A1',
                    opacity: 0.4,
                    width: 1
                  }
                }
              } : { 
                enabled: false 
              },
  
              toolbar: settings.use_toolbar  ? {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                  download: settings.toolbar_download  ? true: false,
                  selection: settings.toolbar_selection  ? true: false,
                  zoom: settings.toolbar_zoom  ? true: false,
                  zoomin: settings.toolbar_zoom_in  ? true: false,
                  zoomout: settings.toolbar_zoom_out  ? true: false,
                  pan: settings.toolbar_pen ? true: false,
                  reset: settings.toolbar_reset  ? true: false | '<img src="/static/icons/reset.png" width="20">',
                  customIcons: []
                },
                export: {
                  csv: {
                    filename: undefined,
                    columnDelimiter: ',',
                    headerCategory: 'category',
                    headerValue: 'value',
                    dateFormatter(timestamp) {
                      return new Date(timestamp).toDateString()
                    }
                  },
                  svg: {
                    filename: undefined,
                  },
                  png: {
                    filename: undefined,
                  }
                },
                autoSelected: 'zoom' 
              } : {
                show: false,
              },
           
            },
            stroke: {
              show_stroke: settings.show_stroke ? true: false,
              curve: settings.show_stroke && settings.stroke_curve_type !== '' ? settings.stroke_curve_type :  'smooth',
              lineCap: settings.show_stroke && settings.stroke_line_cap_type !== '' ? settings.stroke_line_cap_type :'butt',
              colors: settings.show_stroke && settings.stroke_color !== '' ? [settings.stroke_color] : undefined,
              width: lineWidths,//settings.show_stroke && settings.stroke_width !== '' ? Number(settings.stroke_width) : 2,
            },
            series: seriesArray,
            xaxis:
              {
                categories: categoriesArray
              },

            // yaxis: {
            //   opposite: true,
            // },

            noData: {
              text: 'Loading...'
            },

            zoom: settings.use_zoom ===true ? {
              enabled: true,
              type: 'x',
              autoScaleYaxis: false,
              zoomedArea: {
                fill: {
                  color: '#90CAF9',
                  opacity: 0.4
                },
                stroke: {
                  color: '#0D47A1',
                  opacity: 0.4,
                  width: 1
                }
              }
            } : { enabled: false },
  

            legend: 
              settings.enable_legend ? {
              show: true,
              showForSingleSeries: false,
              showForNullSeries: true,
              showForZeroSeries: true,
              position: settings.legend_position ?  settings.legend_position : 'top',
              horizontalAlign: settings.legend_horizontal_align ?  settings.legend_horizontal_align : 'center', 
              floating: true,
              fontSize: settings.legend_font_size ?  settings.legend_font_size : '14px',
              fontFamily: 'Helvetica, Arial',
              fontWeight: 400,
              formatter: undefined,
              inverseOrder: settings.legend_inverse_order ?  settings.legend_inverse_order : false,
              width: undefined,
              height: undefined,
              tooltipHoverFormatter: undefined,
              customLegendItems: [],
              offsetX: 0,
              offsetY: 0,
              labels: {
                  colors: settings.legend_level_color && settings.legend_level_color !== '' ? [settings.legend_level_color] : undefined,
                  useSeriesColors: settings.use_series_color_for_legend ?  settings.use_series_color_for_legend : false, 
              },
              markers: {
                  size: settings.legend_markar_size ?  settings.legend_markar_size : 6,
                  shape:  settings.legend_marker_shape ?  settings.legend_marker_shape : 'square', // circle, square, line, plus, cross
                  strokeWidth: 10,
                  fillColors: undefined,
                  radius: 2,
                  customHTML: undefined,
                  onClick: undefined,
                  offsetX: 0,
                  offsetY: 0
              },
              itemMargin: {
                  horizontal: 10,
                  vertical: 0
              },
              onItemClick: {
                  toggleDataSeries: true
              },
              onItemHover: {
                  highlightDataSeries: true
              },
              
            }
            :
            {
            show: false,
            },

            responsive: [
              {
                breakpoint: 1000,
                options: {
                  plotOptions: {
                    bar: {
                      horizontal: false
                    }
                  },
                  legend: {
                    position: "bottom"
                  }
                }
              }
            ]

          }
          
          var chart = new ApexCharts(mainDiv, options);
          
          chart.render();

        });
    });
})(jQuery)
  
  
