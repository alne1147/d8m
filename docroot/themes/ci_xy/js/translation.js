function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
    document.querySelector('#google_translate_element') !== null ? document.querySelector('#google_translate_element') : '';
}
(function() {
    var script = document.createElement('script');
    script.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
    script.async = true;
    element = document.getElementsByTagName('body')[0];
    element.append(script);
})();