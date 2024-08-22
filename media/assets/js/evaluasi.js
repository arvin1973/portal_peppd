$(document).ready(function() {

    $('#pn').change(function() {
        var selectedValue = $(this).val();
        
        $.ajax({
            type: 'POST',
            url: base_url+'get_data', // Replace with your server endpoint
            data: { selected_value: selectedValue },
            success: function(response) {
                console.log(response);
                const transformedData = response.data.map(item => {
                    return [`id-${item.wilayah}`, parseFloat(item.nilai).toFixed(2)];
                });

                (async () => {
    
                    const topology = await fetch(
                      indonesiaJson
                    ).then(response => response.json());
                    
                    
                        // Create the chart
                        Highcharts.mapChart('container', {
                            chart: {
                                map: topology
                            },
                        
                            title: {
                                text: 'Prioritas Nasional '+selectedValue
                            },
                        
                            subtitle: {
                                text: response.data_pn.nama_pn
                            },
                        
                            mapNavigation: {
                                enabled: true,
                                buttonOptions: {
                                    verticalAlign: 'bottom'
                                }
                            },

                            legend: {
                                enabled: false // Disable the legend
                            },
                        
                            colorAxis: {
                                min: 0,
                                max: 1, // Set maximum value to 1
                                stops: [
                                    [0, '#FF0000'], // Red for values near 0
                                    [0.5, '#FFFF00'], // Yellow for values near 0.5
                                    [1, '#008000'] // Green for values near 1
                                ]
                            },
                        
                            series: [{
                                data: transformedData,
                                name: 'Hasil Evaluasi',
                                states: {
                                    hover: {
                                        
                                        color: null, // Transparent hover color
                                        borderColor: '#000000', // Black border color
                                        borderWidth: 3 // Thickness of the border
                                    }
                                },
                                dataLabels: {
                                    enabled: false,
                                    format: '{point.name}'
                                }
                            }]
                        });
                    
                    })();
                    
                console.log('Request successful:', response);
            },
            error: function(xhr, status, error) {
                console.error('Request failed. Status:', status, 'Error:', error);
            }
        });
    });

})