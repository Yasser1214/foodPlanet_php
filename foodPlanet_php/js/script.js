$(document).ready(function () {
  $('#select-menu').click(function() {
    var checked = $("input[type=checkbox]:checked").length;

    if (!checked) {
      alert("You must select at least one item.");
      return false;
    }

  });
});


/* put the buttons out of the form, if not, the features could note be maintained after the click 
cause to regenerate the buttons after the request the generation of the form will be forced ! */
$(document).ready(function() {

  $("#registration").click(function() {
    event.preventDefault();
    $("#connection-form").hide();
    $("#registration-form").toggle("swing");
  });

  $("#connection").click(function() {
    event.preventDefault();
    $("#registration-form").hide();
    $("#connection-form").toggle("swing");
  });

});


$(document).ready(function () {
  $('.addbar').click(function() {
    var auth =  $("#authentification").val(); 

    if (!auth) {
      $('#select-menu').attr("disabled", true);
      $('#isAuthentified').text("Please connect to select your order !");
      $('.checkboxes').prop("checked", false);
      $('.addbar').attr("disabled", true);
      $("#registration-form").hide();
      $("#connection-form").show("swing");
    } 

  });
});


/* by using jQuery to display the "user" button, the input tag can access to the user value only 
after the script has compiled so after the second load. Better to use php conditions inside html.

$(document).ready(function () {
  $('.submit-auth').click(function() {
   
    var auth = $("#authentification").val(); 

    if (auth == 1) {
      $(".auth-button").hide();
      $("#registration-form").hide();
      $("#connection-form").hide();
      $("#user").show("swing");
    } 

  });
});*/


$(document).ready(function () {
  $('#apply-promo').click(function() {
    var promo_val = $("#promo-value").val(); 
    
    if (promo_val == "tastyWorld") {
      event.preventDefault();
      $("#promo-value").css("background-color", "#7FFF00");
      $('#promo-message').text("Valid code !");
      $('#apply-promo-val').val('yes');
    } else if (promo_val == "") {
      event.preventDefault();
      $("#promo-value").css("background-color", "#FFD700");
      $('#promo-message').text("Enter a code or go your way !");
    } else {
      event.preventDefault();
      $("#promo-value").css("background-color", "#FF6347");
      $('#promo-message').text("Invalid code !");
    }

  });
});


$(document).ready(function() {

  $("#display-menus").click(function() {
    event.preventDefault();
    $("#welcome-panel").hide("slow", "linear", "callback");
    $("#menu").show("slow", "linear", "callback");
    $("#sandwich").hide("slow", "linear", "callback");
    $("#accompaniment").hide("slow", "linear", "callback");
    $("#drink").hide("slow", "linear", "callback");
  });

  $("#display-sand").click(function() {
    event.preventDefault();
    $("#welcome-panel").hide("slow", "linear", "callback");
    $("#menu").hide("slow", "linear", "callback");
    $("#sandwich").show("slow", "linear", "callback");
    $("#accompaniment").hide("slow", "linear", "callback");
    $("#drink").hide("slow", "linear", "callback");
  });

  $("#display-accomp").click(function() {
    event.preventDefault();
    $("#welcome-panel").hide("slow", "linear", "callback");
    $("#menu").hide("slow", "linear", "callback");
    $("#sandwich").hide("slow", "linear", "callback");
    $("#accompaniment").show("slow", "linear", "callback");
    $("#drink").hide("slow", "linear", "callback");
  });

  $("#display-drinks").click(function() {
    event.preventDefault();
    $("#welcome-panel").hide("slow", "linear", "callback");
    $("#menu").hide("slow", "linear", "callback");
    $("#sandwich").hide("slow", "linear", "callback");
    $("#accompaniment").hide("slow", "linear", "callback");
    $("#drink").show("slow", "linear", "callback");
  });

});


$(document).ready(function() {

  $("#display-menus2").click(function() {
    event.preventDefault();
    $("#items-buttons").show("slow", "linear", "callback");
    $("#welcome-panel").hide("slow", "linear", "callback");
    $("#menu").show("slow", "linear", "callback");
    $("#sandwich").hide("slow", "linear", "callback");
    $("#accompaniment").hide("slow", "linear", "callback");
    $("#drink").hide("slow", "linear", "callback");
  });

  $("#display-sand2").click(function() {
    event.preventDefault();
    $("#items-buttons").show("slow", "linear", "callback");
    $("#welcome-panel").hide("slow", "linear", "callback");
    $("#menu").hide("slow", "linear", "callback");
    $("#sandwich").show("slow", "linear", "callback");
    $("#accompaniment").hide("slow", "linear", "callback");
    $("#drink").hide("slow", "linear", "callback");
  });

  $("#display-accomp2").click(function() {
    event.preventDefault();
    $("#items-buttons").show("slow", "linear", "callback");
    $("#welcome-panel").hide("slow", "linear", "callback");
    $("#menu").hide("slow", "linear", "callback");
    $("#sandwich").hide("slow", "linear", "callback");
    $("#accompaniment").show("slow", "linear", "callback");
    $("#drink").hide("slow", "linear", "callback");
  });

  $("#display-drinks2").click(function() {
    event.preventDefault();
    $("#items-buttons").show("slow", "linear", "callback");
    $("#welcome-panel").hide("slow", "linear", "callback");
    $("#menu").hide("slow", "linear", "callback");
    $("#sandwich").hide("slow", "linear", "callback");
    $("#accompaniment").hide("slow", "linear", "callback");
    $("#drink").show("slow", "linear", "callback");
  });

});