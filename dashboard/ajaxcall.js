 let url='http://localhost/First_Project/dashboard/';
//  var items=[];
function getdata(){

    $.ajax({
    
        url:url+"dashboardbackend.php",
        type:"post",
       datatype:"html",
        success:function(data){
            let records=JSON.parse(data);
            
         $("#users").html(records.userdata); 
         $("#client").html(records.clientdata); 
         $("#items").html(records.itemdata); 
         $("#invoice_detail").html(records.total_invoice);
        items=records.items;
        items_sale=records.item_amount;

        chartdata(items,items_sale);
       
        },

    })
}

getdata();

function chartdata(items_name,item_amount){
    window.theme = window.theme || {};
    window.theme.primary = window.theme.primary || "rgba(0,123,255,1)";

    var chartsLine = document.querySelectorAll(".chart-line");

    chartsLine.forEach(function(chart) {
        if (!chart.getAttribute('data-chart-initialized')) {
            var ctx = chart.getContext("2d");

            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
         
            // Line chart
            new Chart(ctx, {
                type: "line",
                data: {
                    labels:items.map(element=>{
                        return element;
                    }),
                    datasets: [{
                        label: "Sales (₹)",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data:items_sale.map(element=>{
                            return element
                        })
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            intersect: false
                        }
                    },
                    interaction: {
                        intersect: true
                    },
                    scales: {
                        x: {
                            reverse: true,
                            grid: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        },
                        y: {
                            ticks: {
                                stepSize: 100
                            },
                            grid: {
                                color: "rgba(0,0,0,0.0)",
                                borderDash: [3, 3]
                            }
                        }
                    }
                }
            });

            chart.setAttribute("data-chart-initialized", "true");
        }
    });
}

