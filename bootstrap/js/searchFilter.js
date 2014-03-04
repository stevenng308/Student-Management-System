/*
* Author: Steven Ng
* Javascript to handle filtering all users
*/
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {
		//#filter is the id of the input field that will be used to input search terms
            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide(); //searchable is the class a tbody tag will need to filter the info inside it
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});