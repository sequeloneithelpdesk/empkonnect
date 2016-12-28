(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.slider').slider({full_width: true});
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 60 // Creates a dropdown of 15 years to control year
  });

  }); // end of document ready
})(jQuery); // end of jQuery name space
