//[Dashboard Javascript]

//Project:	WebkitX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function() {

    'use strict';

    $(".knob").knob({
        /*change : function (value) {
         //console.log("change : " + value);
         },
         release : function (value) {
         console.log("release : " + value);
         },
         cancel : function () {
         console.log("cancel : " + this.value);
         },*/
        draw: function() {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv) // Angle
                    ,
                    sa = this.startAngle // Previous start angle
                    ,
                    sat = this.startAngle // Start angle
                    ,
                    ea // Previous end angle
                    , eat = sat + a // End angle
                    ,
                    r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor &&
                    (sat = eat - 0.3) &&
                    (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor &&
                        (sa = ea - 0.3) &&
                        (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
    /* END JQUERY KNOB */


    var options = {
        series: [{
            name: 'Last Year',
            data: [44, 55, 57, 56, 61, 58, 63]
        }, {
            name: 'Running Year',
            data: [76, 85, 101, 98, 87, 105, 91]
        }],
        chart: {
            type: 'bar',
            foreColor: "#bac0c7",
            height: 260,
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '50%',
            },
        },
        dataLabels: {
            enabled: false,
        },
        grid: {
            show: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#00D0FF', '#3246D3'],
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],

        },
        yaxis: {

        },
        legend: {
            show: false,
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return "$ " + val + " thousands"
                }
            },
            marker: {
                show: false,
            },
        }
    };

    var chart = new ApexCharts(document.querySelector("#recent_trend"), options);
    chart.render();



    var options = {
        series: [{
                name: "Rented",
                data: [12, 22, 14, 18, 22, 13, 17]
            },
            {
                name: "Sold",
                data: [28, 39, 23, 36, 45, 32, 43]
            }
        ],
        chart: {
            height: 280,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#77B6EA', '#545454'],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: 'smooth'
        },
        colors: ['#37d159', '#3246D3'],
        grid: {
            borderColor: '#e7e7e7',
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        },
        legend: {
            show: false,
        }
    };

    var chart = new ApexCharts(document.querySelector("#overview_trend"), options);
    chart.render();



    var options = {
        series: [42, 47, 52, 58, 65],
        chart: {
            height: 360,
            type: 'polarArea'
        },
        labels: ['Sale', 'Rented', 'Booked', 'Not ready', 'UnSold'],
        fill: {
            opacity: 1
        },
        stroke: {
            width: 1,
            colors: undefined
        },
        yaxis: {
            show: false
        },
        legend: {
            position: 'bottom'
        },
        colors: ['#3246D3', '#00D0FF', '#37d159', '#ffa800', '#ee3158'],
        plotOptions: {
            polarArea: {
                rings: {
                    strokeWidth: 0
                },
                spokes: {
                    strokeWidth: 0
                },
            }
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart432"), options);
    chart.render();


    // Slim scrolling

    $('.inner-user-div').slimScroll({
        height: '550px'
    });




}); // End of use strict