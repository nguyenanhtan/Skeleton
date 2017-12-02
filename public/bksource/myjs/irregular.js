//$(function(){
$(document).ready(function(){
	//alert("Helle");
    $("#alert-add-irregular").css("float","left");
    $("#add-irregular").submit(function(event){
        event.preventDefault();
        //alert("Helle");
        //alert($("#add-irregular").serialize());

        $.ajax({
            url: $("#base_path").val()+'/ajax/addirregular',//$("#submit-url").val(),
            type: 'POST',
            dataType: 'json',
            //contentType: "application/json; charset=utf-8",
            async: true,
            data: ($("#add-irregular").serialize()),
            success: function (data) {
                $("#alert-add-irregular").fadeIn();
                $("#alert-add-irregular").text("Successful");
                $("#alert-add-irregular").addClass("text-success")
                $("#alert-add-irregular").removeClass("text-danger")
                row = $("#irregular-tab").find("tr [href$='/16']").parents("tr");
                row.find(".id-irr").text(data["id"]);
                row.find(".simple-irr").text(data["simple"]);
                row.find(".simple-past-irr").text(data["simple_past"]);
                row.find(".past-participle-irr").text(data["past_participle"]);
                row.find(".meaning-irr").text(data["meaning"]);
                
                console.log(data);
                //alert(data);
            },
            error: function (data,status,err) {
                $("#alert-add-irregular").fadeIn();
                $("#alert-add-irregular").text("There is something wrong.");
                $("#alert-add-irregular").addClass("text-danger")
                $("#alert-add-irregular").removeClass("text-success")
                
                console.log("data:--->"+data.responseText);
                console.log("Status---->"+status);
                console.log("Error--->"+err);

            }
        });
    });
});

$("#alert-add-irregular").click(function(){
    $(this).fadeOut();
});
$("#add-irregular-").click(function(){
    $("#submit-url").val($("#base_path").val()+'/ajax/addirregular');
    $("#submit-btn").val("Add New");
});
$(".edit-item-").click(function(event){
    event.preventDefault();
    $("#submit-btn").val("Edit");
    $("#submit-url").val($(this).attr("href"));
    /*$.ajax({
            url: $url,
            type: 'POST',
            dataType: 'text',
            //contentType: "application/json; charset=utf-8",
            async: true,
            data: ($("#add-irregular").serialize()),
            success: function (data) {
                $("#alert-add-irregular").fadeIn();
                $("#alert-add-irregular").text(data);
                $("#alert-add-irregular").addClass("text-success")
                $("#alert-add-irregular").removeClass("text-danger")
                
                console.log(data);
                //alert(data);
            },
            error: function (data,status,err) {
                $("#alert-add-irregular").fadeIn();
                $("#alert-add-irregular").text("There is something wrong.");
                $("#alert-add-irregular").addClass("text-danger")
                $("#alert-add-irregular").removeClass("text-success")
                
                console.log("data:--->"+data.responseText);
                console.log("Status---->"+status);
                console.log("Error--->"+err);

            }
        });*/
});
$(".delete-item").click(function(event){
    event.preventDefault();
    $url = $(this).attr("href");
    $row = $(this).parents("tr");
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
        },
        error: function (data,status,err) {           
            console.log("data:--->"+data.responseText);
            console.log("Status---->"+status);
            console.log("Error--->"+err);

        }
    });
});
$('#myModal').on('show.bs.modal', function (e) {
  // do something...
  var button = $(e.relatedTarget);
  //$("#alert-add-irregular").text(button.attr("id"));
  if(button.attr("id") == "btn-add-irregular"){
       //$("#submit-url").val($("#base_path").val()+'/ajax/addirregular');
       $("#submit-btn").val("Add");
       setFormIrregular(null, $("#add-irregular"));
  }else{
      //$("#submit-url").val(button.attr("href"));
      $("#submit-btn").val("Update");
      setFormIrregular(button.parents("tr"), $("#add-irregular"));
    }
});
function setFormIrregular(row,form){
    
    if(row == null){
        //alert("NULL");
        form.find(":text").val("");
        form.find(".id-irr").val("");
    }else{
        //alert("NONE");

        form.find(".id-irr").val(row.find(".id-irr").text());
        form.find(".simple-irr").val(row.find(".simple-irr").text());
        form.find(".simple-past-irr").val(row.find(".simple-past-irr").text());
        form.find(".past-participle-irr").val(row.find(".past-participle-irr").text());
        form.find(".meaning-irr").val(row.find(".meaning-irr").text());
        
        
    }
}