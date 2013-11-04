var article_list_ajax_limit = 1;
var article_list_ajax_page = 1;
var program_list_ajax_limit = 1;
var program_list_ajax_page = 1;
var partner_list_ajax_limit = 1;
var partner_list_ajax_page = 1;

$('#ajax_article .next,#ajax_article .previous').live('click', function() {
    article_list_ajax_page += $(this).hasClass('next') ? 1 : -1;
    $.ajax({
        url: Routing.generate('blog_article_list_ajax', {
            'domain': app.domain,
            'routeName': app.request._route,
            'routeParams': app.request._route_params,
            'page': article_list_ajax_page,
            'limit': article_list_ajax_limit
        }),
        dataType: "html",
        success: function(data){
            $('#ajax_article').html(data);
        }
    });
});

$('#ajax_program .next,#ajax_program .previous').live('click', function() {
    program_list_ajax_page += $(this).hasClass('next') ? 1 : -1;
    $.ajax({
        url: Routing.generate('blog_program_list_ajax', {
            'domain': app.domain,
            'routeName': app.request._route,
            'routeParams': app.request._route_params,
            'page': program_list_ajax_page,
            'limit': program_list_ajax_limit
        }),
        dataType: "html",
        success: function(data){
            $('#ajax_program').html(data);
        }
    });
});

$('#ajax_partner .next,#ajax_partner .previous').live('click', function() {
    partner_list_ajax_page += $(this).hasClass('next') ? 1 : -1;
    $.ajax({
        url: Routing.generate('blog_partner_list_ajax', {
            'domain': app.domain,
            'routeName': app.request._route,
            'routeParams': app.request._route_params,
            'page': partner_list_ajax_page,
            'limit': partner_list_ajax_limit
        }),
        dataType: "html",
        success: function(data){
            $('#ajax_partner').html(data);
        }
    });
});

