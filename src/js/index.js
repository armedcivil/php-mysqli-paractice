$(document).ready(function(){
  $("#regist_submit").on("click", function(event){
    event.preventDefault();
    $form = $(this).parents("form:first");
    $.ajax({
      url: $form.attr("action"),
      type: $form.attr("method"),
      data: $form.serialize(),
      timeout: 3000,
      success: function(result, testStatus, xhr){
        if(result.result === "success"){
          $("table tbody").append($("<tr><td>" + result.id + "</td><td>" + result.memo + "</td><td>" + result.user_name + "</td>"));
        } else {
          alert("Insert failure.");
        }
      }
    });
  });
})