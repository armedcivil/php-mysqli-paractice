$(document).ready(function(){
  $("#update_submit").on("click", function(event){
    event.preventDefault();
    $form = $(this).parents("form:first");
    $.ajax({
      url: $form.attr("action"),
      type: $form.attr("method"),
      data: $form.serialize(),
      timeout: 3000,
      success: function(result, testStatus, xhr){
        if(result.result === "success"){
          alert("Update success");
          window.location = "/index.php";
        } else {
          alert("Update failure.");
        }
      }
    });
  });
})