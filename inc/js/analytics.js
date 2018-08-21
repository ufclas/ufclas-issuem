var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-1145687-24']);
_gaq.push(['_addOrganic','search.ufl.edu','query']);
_gaq.push(['_trackPageview']);
_gaq.push(['_trackPageLoadTime']);

(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
            
$(document).ready(function() {
    $('a').click(function() {
        var href = $(this).attr('href');
        if (href.match(/^http/) && !href.match(document.domain)) {
            _gaq.push( [ '_trackEvent', 'Outbound Links', 'Click', href ] );
        }

        if (href.match(/\.(doc|docx|pdf|ppt|pptx|xls|xlsx|zip)$/)) {
            _gaq.push( [ '_trackEvent', 'Downloads', 'Download', href ] );
        }
    });
});