var options5 = {
    chart: {
        height: 350,
        type: 'bar',
        parentHeightOffset: 0,
        fontFamily: 'Poppins, sans-serif',
        toolbar: {
            show: false,
        },
    },
    colors: ['#1b00ff', '#f56767'],
    grid: {
        borderColor: '#c7d2dd',
        strokeDashArray: 5,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '25%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    series: [{
        name: 'Real News',
        data: []
    }, {
        name: 'Fake News',
        data: []
    }],
    xaxis: {
        categories: [],
        labels: {
            style: {
                colors: ['#353535'],
                fontSize: '16px',
            },
        },
        axisBorder: {
            color: '#8fa6bc',
        }
    },
    yaxis: {
        title: {
            text: ''
        },
        labels: {
            style: {
                colors: '#353535',
                fontSize: '16px',
            },
        },
        axisBorder: {
            color: '#f00',
        }
    },
    legend: {
        horizontalAlign: 'right',
        position: 'top',
        fontSize: '16px',
        offsetY: 0,
        labels: {
            colors: '#353535',
        },
        markers: {
            width: 10,
            height: 10,
            radius: 15,
        },
        itemMargin: {
            vertical: 0
        },
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        style: {
            fontSize: '15px',
            fontFamily: 'Poppins, sans-serif',
        },
        y: {
            formatter: function (val) {
                return val
            }
        }
    }
};

fetch('/admin/processes-to-dashboard')
    .then(response => response.json())
    .then(data => {
        const onesData = data.map(monthData => monthData.ones);
        const zerosData = data.map(monthData => monthData.zeros);
        const months = data.map(monthData => {
			const monthIndex = monthData.month - 1;
			return new Date(0, monthIndex).toLocaleString('default', { month: 'long' });
		  });
        options5.series[0].data = onesData;
        options5.series[1].data = zerosData;
        options5.xaxis.categories = months;
        var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
        chart5.render();
    })

var options6 = {
	series: [],
	chart: {
		height: 350,
		type: 'radialBar',
		offsetY: 0
	},
	colors: ['#0B132B', '#222222'],
	plotOptions: {
		radialBar: {
		startAngle: -135,
		endAngle: 135,
		dataLabels: {
			name: {
			fontSize: '16px',
			color: undefined,
			offsetY: 120
			},
			value: {
			offsetY: 76,
			fontSize: '22px',
			color: undefined,
			formatter: function (val) {
				return val + "%";
			}
			}
		}
		}
	},
	fill: {
		type: 'gradient',
		gradient: {
		shade: 'dark',
		shadeIntensity: 0.15,
		inverseColors: false,
		opacityFrom: 1,
		opacityTo: 1,
		stops: [0, 50, 65, 91]
		},
	},
	stroke: {
		dashArray: 4
	},
	labels: ['Fake News'],
};
	

fetch('/admin/get-fakeNews-perecentage')
	.then(response => response.json())
	.then(data => {
		var percentage = Number(data);
		options6.series = [percentage];
		options6.fill.gradient.stops[1] = [percentage, '#0B132B'];
		options6.fill.gradient.stops[2] = [percentage + 15, '#222222'];	  
		var chart6 = new ApexCharts(document.querySelector("#chart6"), options6);
		chart6.render();
});