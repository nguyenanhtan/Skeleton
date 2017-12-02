$(document).ready(function(){
	//alert("Helle");
    //$("#alert-add-irregular").css("float","left");
    $("#add-category").submit(function(event){
        event.preventDefault();
        //alert("Helle");
        //alert($("#add-irregular").serialize());

        $.ajax({
            url: $("#base_path").val()+'/blog/addCategory',//$("#submit-url").val(),
            type: 'POST',
            dataType: 'json',
            //contentType: "application/json; charset=utf-8",
            async: true,
            data: ($("#add-category").serialize()),
            success: function (data) {
                
                console.log("Success: "+JSON.stringify(data));
                location.reload();               
            },
            error: function (data,status,err) {                
                console.log("data:--->"+data.responseText);
                console.log("Status---->"+status);
                console.log("Error--->"+err);

            }
        });
    });

    
});
$(".delete-item").click(function(event){
    event.preventDefault();
    $url = $(this).attr("href");
    $row = $(this).parents("tr");
    if(confirm("Are you sure to remove this category?")){
        $.ajax({
            url: $url,
            type: 'POST',
            dataType: 'text',
            //contentType: "application/json; charset=utf-8",
            async: true,
            //data: ($("#add-irregular").serialize()),
            success: function (data) {
                $row.fadeOut();            
                console.log(data);
                //alert(data);
                location.reload();   
            },
            error: function (data,status,err) {           
                console.log("data:--->"+data.responseText);
                console.log("Status---->"+status);
                console.log("Error--->"+err);

            }
        });
    }
});

$(".edit-item").click(function(event){
    event.preventDefault();    
    row = $(this).parents("tr");

    title = row.find(".title");
    id = row.find(".id");
    parent = row.find(".parent");

    $("#id-update").val(id.text());
    
    $("#title-update").val(title.text());
    
    $("#parent-update option[value='"+parent.text()+"']").prop("selected",true);
    
});
$("#save-update").click(function(){
    //event.preventDefault();
    id = $("#id-update").val();
    
    title = $("#title-update").val();
    
    parent = $("#parent-update").val();
    data = {"id":id,"title":title,"parent":parent};
    $.ajax({
        url: $("#base_path").val()+'/blog/addCategory',//$("#submit-url").val(),
        type: 'POST',
        dataType: 'json',
        //contentType: "application/json; charset=utf-8",
        async: true,
        data: data,
        success: function (data) {
            
            console.log("Success: "+JSON.stringify(data));
            location.reload();               
        },
        error: function (data,status,err) {                
            console.log("data:--->"+data.responseText);
            console.log("Status---->"+status);
            console.log("Error--->"+err);

        }
    });

});
