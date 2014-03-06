/*
* Author: Steven Ng
* Javascript to handle filtering all users
*/
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {
		//#filter is the id of the input field that will be used to input search terms
            var rex = new RegExp($(this).val(), 'i');
            $('.searchable').hide(); //searchable is the class a tr tag will need to filter the info inside it.
									//it was '.searchable tr' which might mean search every row in the tbody. this filtered out the user's profile too.
									//assigning class 'searchable' onto a tr fixes this possibly because it only filters each individual tr and not the sub tags.
            $('.searchable').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});