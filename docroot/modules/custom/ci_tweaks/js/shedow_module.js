(function($) {
Drupal.behaviors.myBehavior = {
  attach: function (context, settings) {

    //code starts
    $("body").click(function() {
      alert("Hello World");
    });
    //code ends

  }
};
})(jQuery);
