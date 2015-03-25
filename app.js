
 window.onload = function() {

  if (window.location.href.indexOf("?") > 15) {
    window.location.href = "https://essentialhotels.co.uk/index.php?" + window.location.href.split("?").pop();
  }
   /* Search Box Script */
   var search = new Bloodhound({
     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
     queryTokenizer: Bloodhound.tokenizers.whitespace,
     prefetch: {
       url: "/index.json"
     }
   });

   search.initialize();
   $('.essential .typeahead').typeahead(null, {
     name: 'search',
     displayKey: 'value',
     source: search.ttAdapter(),
     templates: {
       empty: '<div class="empty-message"> Can\'t Find Want Your Looking For? <br /> We\'d Love to Help Please <br /> Call <a href="tel:+448001804700">0800 180 4700</a>, <a href="#!" onclick="$zopim.livechat.button.show();"> Chat </a>, or <a href="mailto:nick@essential-hotels.com"> Email </a> </div>',
       suggestion: Handlebars.compile('<p class="{{type}}">{{value}}{{append}}</p>')
     }
   }).bind("typeahead:selected", function(obj, datum, name) {
     if (datum.url) {
       $(location).attr('href', datum.url);
     }
   });
 }
/**
 * Angular App to drive the Home page.
 * Below is a list of custom directives which
 * make up the Page
 */

var app = angular.module('landingpage', []);
