// External Dependencies
import React, { Component, createRef } from 'react';
//import TestChart from 'chart.js/auto';
//import TestChart from '../../../public/js/lib/chart.js';
//import _ from 'lodash';
//var lodash = _.noConflict();
import ApexCharts from 'apexcharts'

// Internal Dependencies
import './style.css';

class LineChart extends Component {
  static slug = 'dick_line_chart';

  constructor(props) {
    super(props);
    // this.state = {
    //     loading: true,
    // }
    this.state = {
      csvData: null,
      error: null,
    };
    this.chartRef = createRef();
    this.computedType = ['chart_data_type','categories', 'csv_upload_data', 'chart_data_count', 'chart_width','chart_height','use_toolbar'];
  }

  componentDidMount() {
    
    if (this.props.chart_data_type === 'csv_upload') {
      // console.log(this.props.csv_upload_data)
   
      // if(this.props.csv_upload_data){
      //   this.processCsvData();
      // }
      if(this.state.csvData === null){
        this.processCsvData();
      }
    }
   
    //this.updateBodyClass();
    this.get_child_items();
    this.initializeCharts();
  
  }

  componentDidUpdate(prevProps, prevState) {
    const _this = this;
    const utils = window.ET_Builder.API.Utils;

    if (prevProps.chart_data_type !== _this.props.chart_data_type) {
        //_this.updateBodyClass();
    }
    if (_this.props.content !== prevProps.content) {
      //console.log("Child Item Change");
      if (_this.props.content.length > 0 && prevProps.content.length > 0) {
      const currentDataSetValues = this.props.content.map(item => item.props.attrs.data_set_values).join();
      const prevDataSetValues = prevProps.content.map(item => item.props.attrs.data_set_values).join();

      if (currentDataSetValues !== prevDataSetValues) {
        _this.get_child_items();
        _this.initializeCharts();
      }

    }
    }

    for (const index of _this.computedType) {
      if (prevProps[index] !== _this.props[index]) {
          if(_this.computedType.includes(index)){
            _this.processCsvData();
            _this.get_child_items();
            _this.initializeCharts();
          }
      }
    } 

    if(this.state.csvData !== null){
      _this.get_child_items();
      _this.initializeCharts();
    }

  }


  processCsvData = () => {
    const csvFileUrl = this.props.csv_upload_data
    fetch(csvFileUrl)
      .then(response => {
        if (!response.ok) {
          throw new Error('File isn\'t available');
        }
        return response.text();
      })
      .then(csvData => {
        const lines = csvData.split('\n');
        const header = lines[0].split(',');

        const data = [];
        for (let i = 1; i <= this.props.chart_data_count; i++) {
          data.push({
            name: header[i],
            data: [],
            item_line_color: this.props[`element_color_${i}`],
            item_line_width: this.props[`item_line_width_${i}`],
          });
        }

        for (let i = 1; i < lines.length; i++) {
          const row = lines[i].split(',');
          for (let j = 1; j <= this.props.chart_data_count; j++) {
            data[j - 1].data.push(parseInt(row[j], 10));
          }
        }

        data.forEach(dataSet => {
          dataSet.data = dataSet.data.join(',');
        });

        this.setState({ csvData: JSON.stringify(data), error: null });
      })
      .catch(error => {
        this.setState({ error: error.message });
      });
  };
  

  get_child_items() {
    const props = this.props;
    const { csvData } = this.state;
    const { content, chart_data_type } = props;

    if (chart_data_type === 'csv_upload' ) {
      if (!this.state.csvData) {
        this.setState({ error: 'CSV data is not available yet.' });
        return [];
      }

      const parsedCsvData = JSON.parse(csvData);
      return parsedCsvData.map(data => ({
        name: data.name || '',
        data: data.data.split(',').map(Number).filter(value => !isNaN(value)),
        color: data.item_line_color || undefined,
        width: data.item_line_width ? parseInt(data.item_line_width, 10) : 0,
      }));
    }
    else{
        // Check if content is empty or undefined
        if (!content || content.length === 0) {
          return [];
        }
    
        return content.map((data) => {
          const item_props = data.props.attrs;
          const dataSetValues = item_props.data_set_values
            ? item_props.data_set_values.split(',').map(Number).filter(value => !isNaN(value))
            : [];
          return {
            name: item_props.item_label || '',
            data: dataSetValues,
            color: item_props.item_line_color || undefined,
            width: item_props.item_line_width ? parseInt(item_props.item_line_width, 10) : 2,
          };
        });
   }

  }



  initializeCharts() {
  
    const props = this.props;
    const categoriesArray = props['categories'] ? props['categories'].split(',').map(item => {
      // Check if the item is a number
      const num = Number(item);
      return isNaN(num) ? item : num;
    }) : '';

    var options = {
      chart: {
          type: 'line',
          height: props.chart_height ? parseInt(props.chart_height, 10) : 'auto',
          width: props.chart_width ? props.chart_width: '100%',
          zoom: props.use_zoom ==='on' ? {
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

          toolbar: props.use_toolbar ==='on' ? {
              show: true,
              offsetX: 0,
              offsetY: 0,
              tools: {
                download: props.toolbar_download ==='on' ? true: false,
                selection: props.toolbar_selection ==='on'  ? true: false,
                zoom: props.toolbar_zoom ==='on' ? true: false,
                zoomin: props.toolbar_zoom_in ==='on' ? true: false,
                zoomout: props.toolbar_zoom_out ==='on' ? true: false,
                pan: props.toolbar_pen ==='on' ? true: false,
                reset: props.toolbar_reset ==='on' ? true: false | '<img src="/static/icons/reset.png" width="20">',
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
            } :
            {
              show: false,
            },

          animations: props.enable_animation ==='on' ? {
            enabled: true,
            easing: props.timing_function_type !== '' ? Number(props.timing_function_type) : "easeinout",
            speed:  props.animation_speed !== '' ? Number(props.animation_speed) : 800, 
            animateGradually: props.enable_gradually_animation ==='on'  ? 
              {
                enabled: true,
                speed: props.gradually_animation_delay !== '' ? Number(props.gradually_animation_delay) : 150,
              } :
              { 
                enabled: false
              },
            
            dynamicAnimation: props.enable_dynamic_animation ==='on' ? 
              {
                enabled: true,
                speed: props.dynamic_animation_speed !== '' ? Number(props.dynamic_animation_speed) : 350,
              } :
              { 
                enabled: false
              },
            }
            :
            {
            enabled: false,
            },
     
      },
      stroke: {
        show_stroke: props.show_stroke ==='on' ? true: false,
        curve: props.show_stroke && props.stroke_curve_type !== '' ? props.stroke_curve_type :  'smooth',
        lineCap: props.show_stroke && props.stroke_line_cap_type !== '' ? props.stroke_line_cap_type :'butt',
        width: props.show_stroke && props.stroke_width !== '' ? props.stroke_width : 2,
      },
      legend:  props.enable_legend ==='on' ? {
        show: true,
        showForSingleSeries: false,
        showForNullSeries: true,
        showForZeroSeries: true,
        position: props.legend_position ?  props.legend_position : 'top',
        horizontalAlign: props.legend_horizontal_align ?  props.legend_horizontal_align : 'center', 
        floating: true,
        fontSize: props.legend_font_size ?  props.legend_font_size : '14px',
        fontFamily: 'Helvetica, Arial',
        fontWeight: 400,
        formatter: undefined,
        inverseOrder: props.legend_inverse_order ==='on' ?  props.legend_inverse_order : false,
        width: undefined,
        height: undefined,
        tooltipHoverFormatter: undefined,
        customLegendItems: [],
        offsetX: 0,
        offsetY: 0,
        labels: {
            colors: props.legend_level_color && props.legend_level_color !== '' ? [props.legend_level_color] : undefined,
            useSeriesColors: props.use_series_color_for_legend ?  props.use_series_color_for_legend : false, 
        },
        markers: {
            size: props.legend_markar_size ?  props.legend_markar_size : 6,
            shape:  props.legend_marker_shape ?  props.legend_marker_shape : 'square', // circle, square, line, plus, cross
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
      series: this.get_child_items(),
      xaxis: {
        categories: categoriesArray
      },
      
      // yaxis: {
      //   opposite: true,
      // },

      noData: {
        text: 'Loading...'
      },
      // title: {
      //   text: 'Ajax Example',
      // },
    }
    
    if(this.chartRef){
      if(this.chartRef.current && this.chartRef.current.querySelector(".dick-line-chart")){
        var chart = new ApexCharts(this.chartRef.current.querySelector(".dick-line-chart"), options);
      
        chart.render();
      }
    }

  }

  render() {
    
    //console.log(this.props.csv_upload_data);
    const { csvData, error } = this.state;
    return (
      <React.Fragment>
      {
        //this.state.loading === false  ? 
        <>
          <div className="dick-line-chart-container">
            <div className="dick-line-chart-wrapper" ref={this.chartRef} >
              <div className="dick-line-chart"></div>
            </div>
          </div>
        </>
      // :
      //   <div className="et-fb-preloader et-fb-preloader__loading">
      //       <div className="et-fb-loader"/>
      //   </div>
      }
      </React.Fragment>
    );


  }
}

export default LineChart;