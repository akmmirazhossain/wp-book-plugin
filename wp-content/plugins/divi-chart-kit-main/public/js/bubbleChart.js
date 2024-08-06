

const ctx = document.getElementById('dick-bubble-chart');

new Chart(ctx, {
  type: 'bubble',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3, 5, 2, 3],
      borderWidth: 1
    },
    {
      label: '# of Votes 2',
      data: [15, 29, 13, 45, 42, 63],
      borderWidth: 1
    },
    {
      label: '# of Votes 3',
      data: [25, 29, 23, 65, 62, 33],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
