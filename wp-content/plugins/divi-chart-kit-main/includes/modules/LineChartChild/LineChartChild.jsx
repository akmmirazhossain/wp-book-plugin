// External Dependencies
import React, { Component, createRef } from 'react';
//import { Chart } from 'chart.js/auto';
//import TestChart from '../../../public/js/lib/chart.js';

// Internal Dependencies
import './style.css';

class LineChartChild extends Component {
  static slug = 'dick_line_chart_child';

  constructor(props) {
    super(props);
    this.chartRef = createRef();
  }

  componentDidMount() {
   // this.initializeCharts();
  }

  // initializeCharts() {
  //   const ctx = this.chartRef.current.getContext('2d');
  //   const config = {
  //     type: 'line',
  //     data: {
  //       labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
  //       datasets: [
  //         {
  //           label: '# of Votes',
  //           data: [12, 19, 3, 5, 2, 3],
  //           borderWidth: 1,
  //           fill: false,
  //           tension: 0,
  //           borderCapStyle: 'butt',
  //           backgroundColor: 'rgba(255, 99, 132, 0.2)',
  //           borderColor: 'rgb(255, 99, 132)',
  //           showLine: true,
  //         },
  //       ],
  //     },
  //     options: {
  //       scales: {
  //         y: {
  //           beginAtZero: true,
  //         },
  //       },
  //     },
  //   };

  //   new TestChart(ctx, config);
  // }

  render() {
    return (
      <div className="dick-line-chart-container">
        <div className="dick-line-chart-wrapper">
          <canvas ref={this.chartRef} className="dick-line-chart">Line Chart</canvas>
        </div>
      </div>
    );
  }
}

export default LineChartChild;