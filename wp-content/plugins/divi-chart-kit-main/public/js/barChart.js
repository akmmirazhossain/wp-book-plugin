(function ($) {
  document.addEventListener( 'DOMContentLoaded', function() {
      var dick_bar_chart = document.querySelectorAll('.dick_bar_chart');
      
      dick_bar_chart.forEach(function(ele, index) {

        var barSelector = ele.querySelector('.dick-bar-chart-container');
        if (barSelector) {
          try {
        const settings = JSON.parse(barSelector.dataset.settings);
        // console.log(barSelector.dataset.settings);
        // console.log(settings.data_set);
        
        seriesData = settings.data_set.map(function(series) {
          return {
            name: series.name,
            data: series.data.split(',').map(Number), // Convert data string to an array of numbers
            color: series.color
          };
        });
        
        // var categoriesList = settings.chart_Categories_list.split(',').map(function(category) {
        //   return category.trim();
        // });
        console.log(seriesData);
        var ele_class = ele.classList.value.split(" ").filter(function (class_name) {
            return class_name.indexOf('dick_bar_chart_') !== -1;
        });
        var mainDiv = barSelector.querySelector('.dick-bar-chart');
        // Create a unique ID for each chart
        var uniqueID = 'dick-bar-chart-' + index;
        mainDiv.setAttribute('id', uniqueID);
        console.log(settings.use_toolbar);
        //const enableZoom = settings.use_zoom === 'on' ? true: false; 
        var options = {
          chart: {
            type: 'bar',
          //   animations: {
          //     enabled: true,
          //     easing: 'easeinout',
          //     speed: 800,
          //     animateGradually: {
          //         enabled: true,
          //         delay: 150
          //     },
          //     dynamicAnimation: {
          //         enabled: true,
          //         speed: 350
          //     }
          // },
            height: settings.chart_height ? parseInt(settings.chart_height, 10) : 'auto',
            width: settings.chart_width ? settings.chart_width: '100%',
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
            } : { enabled: false },

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
            // dropShadow: {
            //   enabled: true,
            //   color: '#000',
            //   top: 18,
            //   left: 7,
            //   blur: 10,
            //   opacity: 0.2
            // },
            // zoom: {
            //   enabled: false
            // },
         
          },
          // stroke: {
          //   show: settings.show_stroke ? true: false,
          //   curve: settings.stroke_curve_type !== '' ? settings.stroke_curve_type :  'straight',
          //   barCap: settings.stroke_bar_cap_type !== '' ? settings.stroke_bar_cap_type :'butt',
          //   colors: settings.stroke_color !== '' ? settings.stroke_color : undefined,
          //   width: 1,
          //   dashArray: settings.stroke_dash_array !== '' ? settings.stroke_dash_array : 0, 
          // },
          series: seriesData ,
          xaxis:
            {
              categories: ['January', 'February', 'March', 'April', 'May', 'June']
            },
        }
        
        var chart = new ApexCharts(mainDiv, options);
        
        chart.render();
        } catch (e) {
          console.error("Error parsing data-settings JSON:", e);
      }

      }else{
        console.error("Chart container not found.");
      }
      });
  });
})(jQuery)


