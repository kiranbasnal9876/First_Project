 let url='http://localhost/First_Project/dashboard/';
function getdata(){

    $.ajax({
    
        url:url+"dashboardbackend.php",
        type:"post",
       datatype:"html",
        success:function(data){
            let records=JSON.parse(data);
            console.log(data);
         $("#users").html(records.userdata); 
         $("#client").html(records.clientdata); 
         $("#items").html(records.itemdata); 
         $("#invoice_detail").html(records.total_invoice); 
        },

    })
}

getdata();