$(document).ready(function() {
  $.ajax({
      url: $("#base_path").val()+'/blog/getCategories',//$("#submit-url").val(),
      type: 'POST',
      dataType: 'json',
      //contentType: "application/json; charset=utf-8",
      //async: true,
      //data: ($("#add-category").serialize()),
      success: function (data) {
          //obj = JSON.parse(data);
          tree = data.tree;
          arr = data.arr;
          //print_cat(tree);
          console.log("tree: "+JSON.stringify(tree));
          //console.log("tree: "+JSON.stringify(tree["1"]));
          console.log("arr: "+JSON.stringify(arr));
          //location.reload(); 
          ul = print_tree("1",arr,tree);
          console.log("-->"+ul); 
          $("#list-categories").html(ul);
          //$("#categories").html(print_select("1",arr,tree,0));
      },
      error: function (data,status,err) {                
          console.log("data:--->"+data.responseText);
          console.log("Status---->"+status);
          console.log("Error--->"+err);

      }
  });
  $("#list-categories").on("change",".category-checkbox",function() {
  // Check input( $( this ).val() ) for validity here
  //console.log($(this).val());
    //console.log("__________");
    $("#categories-selected").empty();
    $("#categories-selected").append('<span class=" glyphicon glyphicon-hand-right" aria-hidden="true"></span> ');
    $(".category-checkbox").each(function(){
      //console.log($(this).val());});
      if($(this).is(":checked")){
        $("#categories-selected").append("<li><a href='#'>"+$("label[for='checkbox-"+$(this).val()+"']").text()+"</a></li>")
        console.log($("label[for='checkbox-"+$(this).val()+"']").text());
      }
    });
  });
});
$('#test').click(function(){
 // alert($(this).val());
 $(".category-checkbox").each(function(){console.log($(this).text());});
});

$("#save-article").click(function(){
    event.preventDefault();  
    title = $("#title").val();
    cat = $("#category").val();
    content = $('#summernote').summernote('code');
    $.ajax({
        url: $("#base_path").val()+'/blog/saveArticle',//$("#submit-url").val(),
        type: 'POST',
        dataType: 'json',
        //contentType: "application/json; charset=utf-8",
        async: true,
        data: {"title":title,"content":content,"author":"TANNGUYEN","category":cat},
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