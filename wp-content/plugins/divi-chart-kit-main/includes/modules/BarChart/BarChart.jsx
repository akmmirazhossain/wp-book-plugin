// External Dependencies
import React, { Component, createRef } from 'react';
//import TestChart from 'chart.js/auto';
//import TestChart from '../../../public/js/lib/chart.js';
import ApexCharts from 'apexcharts'

// Internal Dependencies
import './style.css';

class BarChart extends Component {
  static slug = 'dick_bar_chart';

  constructor(props) {
    super(props);
    this.chartWrapper = createRef();
  }

  componentDidMount() {
    this.initializeCharts();
  }

  componentDidUpdate(prevProps, prevState) {
    // const _this = this;
    // _this.initializeCharts();
    if (this.haveSeriesPropsChanged(prevProps, this.props)) {
      setTimeout(() => {
        this.initializeCharts();
      }, 3000); // Delay for 3 seconds
    }
  }

  haveSeriesPropsChanged(prevProps, currentProps) {
    const dataSetCount = parseInt(currentProps.chart_data_count, 10);
    for (let i = 1; i <= dataSetCount; i++) {
      if (
        prevProps[`element_name_${i}`] !== currentProps[`element_name_${i}`] ||
        prevProps[`element_data_${i}`] !== currentProps[`element_data_${i}`] ||
        prevProps[`element_color_${i}`] !== currentProps[`element_color_${i}`]
      ) {
        return true;
      }
    }
    return false;
  }

  initializeCharts() {
    const props = this.props;
    if (this.chartWrapper.current) {
   
      let series = [];
      const dataSetCount = parseInt(props.chart_data_count, 10);
  
      for (let i = 1; i <= dataSetCount; i++) {
        series.push({
          name: props[`element_name_${i}`],
          data: props[`element_data_${i}`].split(',').map(Number), // Convert data string to an array of numbers
          color: props[`element_color_${i}`]
        });
      }

      var options = {
        chart: {
          type: 'bar'
         //animations: {
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
            // height: 350,
            // zoom: {
            //   enabled: false
            // },
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
            // toolbar: {
            //   show: false
            // }
        },
        // stroke: {
          //   show: settings.show_stroke ? true: false,
          //   curve: settings.stroke_curve_type !== '' ? settings.stroke_curve_type :  'straight',
          //   barCap: settings.stroke_bar_cap_type !== '' ? settings.stroke_bar_cap_type :'butt',
          //   colors: settings.stroke_color !== '' ? settings.stroke_color : undefined,
          //   width: 1,
          //   dashArray: settings.stroke_dash_array !== '' ? settings.stroke_dash_array : 0, 
          // },
        series: series,
        xaxis: {
          categories: ['January', 'February', 'March', 'April', 'May', 'June']
        },
        // yaxis: {
        //   reversed: true
        // }
      }
      
      var chart = new ApexCharts(this.chartWrapper.current.querySelector(".dick-bar-chart"), options);
      
      chart.render();
    }
  }

  render() {
    

    return (
      <div className="dick-bar-chart-container" ref={this.chartWrapper}>
        <div className="dick-bar-chart-wrapper">
          <div className="dick-bar-chart">Bar Chart</div>
        </div>
      </div>
    );
  }
}

export default BarChart;