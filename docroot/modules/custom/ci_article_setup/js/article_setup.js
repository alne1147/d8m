Drupal.behaviors.myBehavior = {
    attach: function (context, settings) {
        // Using once() to apply the myCustomBehaviour effect when you want to do just run one function.
        alert("Your book is overdue.");
        // Using once() with more complexity.
    }
};
