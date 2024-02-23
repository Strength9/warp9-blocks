<?php
//Google Analytics or Tag manager You Decide...
/*-----------------------------------------------------------------------------------*/
/* add Google Analytics to header
/*-----------------------------------------------------------------------------------*/

function ns_google_analytics() { 

    $GTAgManager = '[YOURTRACKINGCODE]';

    echo "<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src=\"https://www.googletagmanager.com/gtag/js?id=".$GTAgManager."\"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '".$GTAgManager."');
    </script>";

}
    
// add_action( 'wp_head', 'ns_google_analytics', 10 );


/*-----------------------------------------------------------------------------------*/
/* add Google Tag Manager before closing head tag
/*-----------------------------------------------------------------------------------*/

    function ns_google_tag_manager_head() { 

        $GTAgManager = '[YOURTRACKINGCODE]';

        echo "<!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','".$GTAgManager."');</script>
        <!-- End Google Tag Manager -->";
 
    }
    
    
    // add Google Tag Manager no script support to body tag
    function ns_google_tag_manager_body() { 
        $GTAgManager = '[YOURTRACKINGCODE]';

       echo '<!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id='.$GTAgManager.'" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->';

    }
    
    // add_action( 'wp_head', 'ns_google_tag_manager_head', 10 );
    // add_action('wp_body_open', 'ns_google_tag_manager_body', 1);



?>