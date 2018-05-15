<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Retired Imprest vs Unretired Imprest'
    },
    subtitle: {
        text: 'Sources: PPRA'
    },
    xAxis: {
        allowDecimals: false,
        labels: {
            formatter: function () {
                return this.value; // clean, unformatted number for year
            }
        }
    },
    yAxis: {
        title: {
            text: 'Amount'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        pointFormat: '{series.name} imprest <b>{point.y:,.0f}</b><br/>in {point.x}'
    },
    plotOptions: {
        area: {
            pointStart: 2018,
            marker: {
                enabled: false,
                symbol: 'circle',
                radius: 2,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            }
        }
    },
    series: [{
        name: 'Retired',
        data: [
            <?php echo $arrayretired['imprest_retired'];?>, 0, 0
        ]
    }, {
        name: 'Unretired',
        data: [
            <?php echo $arrayu['imprest_unretired'];?>, 0, 0
        ]
    }]
});
</script>