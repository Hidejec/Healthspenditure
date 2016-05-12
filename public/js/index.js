$(function(){

  $(".dropdown-menu.illness li a").click(function(){
    $("#illness:first-child").text($(this).text());
    $("#illness:first-child").val($(this).text());
    $("#illness:first-child").append(' <span class="caret"></span>');
    $("#illnessValue").val($(this).text());  
});

  $(".dropdown-menu.market li a").click(function(){
    $("#market:first-child").text($(this).text());
    $("#market:first-child").val($(this).text());
    $("#market:first-child").append(' <span class="caret"></span>');
    $("#marketValue").val($(this).text());
});

  $("#auto").click(function(){
    if ($('#auto').prop('checked')) {
      $("#autoValue").val('true');
      $("#market").prop('disabled',true);
      $("#market").removeClass("I_design").addClass("disabledbtn");
      $('#auto').prop('unchecked')
    }
    else{
      $("#autoValue").val('false');
      $("#market").prop('disabled',false);
    $("#market").removeClass("disabledbtn").addClass("I_design");
      $('#auto').prop('checked')
    }
  });
  
});