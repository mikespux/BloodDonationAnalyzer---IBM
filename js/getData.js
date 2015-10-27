/**
 * Created by peter wasonga on 10/13/2015.
 */
function getByGender() {
    $.ajax({
       type: "GET",
        url: "php/index.php",
        data: {q : "byGender" },
        success : function(response){
            var obj = JSON.parse(response);
            var male = obj[0].Male;
            var female = obj[0].Female;

            $('#gender').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Blood Donation By Gender January'
                },
                tooltip: {
                    pointFormat: '{series.data.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: "Gender",
                    colorByPoint: true,
                    data: [{
                        name: "Male",
                        y: parseFloat(male),
                        sliced: true,
                        selected: true
                    }, {
                        name: "Female",
                        y: parseFloat(female)
                    }]
                }]
            });
        }
    });
}

function getByAge() {
    $.ajax({
        type: "GET",
        url: "php/index.php",
        data: {q : "byAge" },
        success : function(response){
            var obj = JSON.parse(response);
            var zero_10 = parseFloat(obj[0].zero_10);
            var ten_20 = parseFloat(obj[0].ten_20);
            var twnty_30 = parseFloat(obj[0].twnty_30);
            var thrty_40 = parseFloat(obj[0].thrty_40);
            var fourty_50 = parseFloat(obj[0].fourty_50);
            var fifty_60 = parseFloat(obj[0].fifty_60);
            var sixty_70 = parseFloat(obj[0].sixty_70);

            $(function () {
                $('#age').highcharts({
                    title: {
                        text: 'Blood Donation Count By Age',
                        x: -20 //center
                    },
                    subtitle: {
                        x: -20
                    },
                    xAxis: {
                        categories: ['0 - 10', '10 - 20', '20 - 30', '30 - 40', '40 - 50', '50 - 60',
                            '60 - 70']
                    },
                    yAxis: {
                        title: {
                            text: 'Donation Count'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: [ {
                        name: 'Kenya',
                        data: [zero_10,ten_20,twnty_30,thrty_40,fourty_50,fifty_60,sixty_70]
                    }]
                });
            });

        }
    });
}

function getByBloodGroup() {

    $.ajax({
        type: "GET",
        url: "php/index.php",
        data: {q : "byBloodGroupAplus" },
        success : function(response){
            var obj = JSON.parse(response);
            var Aplus =  parseFloat( obj[0].bloodCount);

            $(function () {
                $('#bloodGroup').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Blood Donation By Blood Group A+'
                    },

                    xAxis: {
                        categories: ['A+'],
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Count',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 60,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Year '+ new Date().getFullYear(),
                        data: [Aplus]
                    }]
                });
            });
        }
    });





}

function getByRegion() {
    $.ajax({
        type: "GET",
        url: "php/index.php",
        data: {q : "byRegion" },
        success : function(response){
            var obj = JSON.parse(response);
            var Kisumu = parseFloat(obj[0].Kisumu);
            var Nairobi =  parseFloat(obj[0].Nairobi);
            var Mombasa =  parseFloat(obj[0].Mombasa);

            $(function () {
                $('#region').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Blood Donation By Regions'
                    },
                    subtitle: {
                    },
                    xAxis: {
                        categories: [
                            'Kisumu',
                            'Nairobi',
                            'Mombasa'
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Count'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name : "Donation Count",
                        data: [Kisumu, Nairobi, Mombasa]

                    }]
                });
            });

        }
    });
}

function getTotalRequests(){
    $.ajax({
        type: "GET",
        url: "php/index.php",
        data: {q : "byTotalRequest" },
        success : function(response) {
            var obj = JSON.parse(response);
            var val = parseFloat(obj[0].total);

            document.getElementById("totalRequest").innerHTML = val;
        }
        });
}

function getMaleRequest(){
    $.ajax({
        type: "GET",
        url: "php/index.php",
        data: {q : "byTotalMale" },
        success : function(response) {
            var obj = JSON.parse(response);
            var val = parseFloat(obj[0].total);

            document.getElementById("totalMaleRequest").innerHTML = val;        }
    });
}

function getFemaleRequest(){
    $.ajax({
        type: "GET",
        url: "php/index.php",
        data: {q : "byTotalFemale" },
        success : function(response) {
            var obj = JSON.parse(response);
            var val = parseFloat(obj[0].total);

            document.getElementById("totalFemaleRequest").innerHTML = val;        }
    });
}