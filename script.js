(function ($) {

    'use strict';

    $('#wp-faq-fuzzy-search-query').on('input', function() {
    
        const options = {
            keys: ['title', 'excerpt'],
            threshold: 0.3,
            ignoreLocation: true
        };
        
        const fuse = new Fuse(wp_faq_list, options);
            
        const search_results = fuse.search($(this).val());

        $('ul#wp-faq-search-results').empty();

        if (search_results.length == 0 && $(this).val().length > 0) {

            $('ul#wp-faq-search-results').append('<li>Keine Ergebnisse :(</li>')

        } else {

            search_results.forEach(function(result){

                console.log(result.item.title)
                $('ul#wp-faq-search-results').append('<li><a target=_blank href="'+result.item.url+'">'+result.item.title+'</a></li>')

            })

        }

    });

})(jQuery);
