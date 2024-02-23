<?php

/**
 * Formats a given number by adding a leading zero if it doesn't start with 0 or 4, replacing the leading 0 with 4, and removing any spaces.
*/

function format_number($number, $display = '',$whatsapp = ''){
        $countryCode = !empty( get_field('default_international_phone_code','option') ) ? '+'.get_field('default_international_phone_code','option').' (0) ': '+44 (0) ';
        $internationalNumber = preg_replace('/^0/', $countryCode, $number);
       
       if ($display != 'display') {
        $internationalNumber = str_replace('(0)', '', $internationalNumber);
           $internationalNumber = str_replace(' ', '', $internationalNumber);

              if ($whatsapp === 'yes') {
                $internationalNumber = str_replace('+', '', $internationalNumber);
              } else {
                $internationalNumber = str_replace('+', '00', $internationalNumber);
              };

           
         };
         return $internationalNumber;
};






/*
 * Returns the logo image.
 * $pageposition: The position of the logo on the page. Default/Header/Footer Default is 'Default'.
 * $location: The location of the logo. i.e Default/Location1/Location2 Default is 'Default'.
 */
function ReturnLogo($pageposition = 'Default', $location = 'Default') {
    $imageoutput = '';
    if( have_rows('logo_fields', 'option') ) {
        while ( have_rows('logo_fields', 'option') ) : the_row();
            //logo_file
            $field_pageposition = get_sub_field('page_position');
            $field_location = get_sub_field('locations');

            if (($pageposition === $field_pageposition) && ($location === $field_location)) {
                $image = get_sub_field('logo_file');
                if( !empty( $image ) ) { 
                    $imageoutput = '<img src="'.esc_url($image['url']).'" alt="'.esc_attr($image['alt']).'" />';
                };
            };
        endwhile;

        return $imageoutput;
    }
};

/*
* Returns the Social Media Links.
 * $location: The location of the logo. i.e Default/Location1/Location2 Default is 'Default'.
 * wrapper wrap the link in a html tag. i.e div, span, p, etc. Default is ''.
*/

function ReturnSocialMediaLinks($location = 'Default', $wrapper = '') {
    $socialmediaoutput=$wrapperopen = $wrapperclose = '';
    if ($wrapper != '') { $wrapperopen = '<'.$wrapper.'>'; $wrapperclose = '</'.$wrapper.'>'; };
    
    if( have_rows('social', 'option') ) {
        while ( have_rows('social', 'option') ) : the_row();
            //social_media
            $social_media_icons = get_sub_field('icon_fields_contact');
            $social_field_location = get_sub_field('locations');

        if ($location === $social_field_location || $location === '') {
            $link = get_sub_field('social_link');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                
                $socialmediaoutput .= $wrapperopen.'<a href="'.esc_url( $link_url ).'" target="'.esc_attr( $link_target ).'" title="'.esc_html( $link_title ).'">'.$social_media_icons.'</a>'. $wrapperclose;
            endif; 
        };
        endwhile;

        return $socialmediaoutput;
    }
};

/*
* Returns Contact Details.
 * $location: The location of the logo. i.e Default/Location1/Location2 Default is 'Default'.
 * wrapper wrap the link in a html tag. i.e div, span, p, etc. Default is ''.
*/

function ReturnContactDetails( $type = 'phone',$location = 'Default', $wrapper = '', $showicon = '', $showlocation= '') {
    $contactoutput=$wrapperopen = $wrapperclose = '';
    if ($wrapper != '') { $wrapperopen = '<'.$wrapper.'>'; $wrapperclose = '</'.$wrapper.'>'; };

    //$contactoutput = $type.' / '.$location.' / '.$wrapper.' / '.$showicon.' / '.$showlocation.'<br>';

    if ($type === 'phone') {
        if( have_rows('telephone_accounts', 'option') ) {
            while ( have_rows('telephone_accounts', 'option') ) : the_row();
                //contact_phone
                $field_location = get_sub_field('locations');
                $phonedetails = get_sub_field('contact_telephone');
                $socialicon =get_sub_field('icon_fields_contact'); 


                if ($showicon === 'yes') {  

                    $socialicon =get_sub_field('icon_fields_contact'); 

                    if (($phonedetails) && (($location === $field_location) || ($location === 'all'))){
                        if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
                        $contactoutput .= $wrapperopen.'<a href="tel:'.format_number($phonedetails,'','').'">'.$socialicon.$locationshow.format_number($phonedetails,'display','').'</a>'.$wrapperclose;
                    };
                } elseif ($showicon === 'only') { 

                    if (($phonedetails) && (($location === $field_location) || ($location === 'all'))){
                        if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
                        $contactoutput .= $wrapperopen.'<a href="tel:'.format_number($phonedetails,'','').'">'.$socialicon.'</a>'.$wrapperclose;
                    };


                } else {  
                    if (($phonedetails) && (($location === $field_location) || ($location === 'all'))){
                        if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
                        $contactoutput .= $wrapperopen.'<a href="tel:'.format_number($phonedetails,'','').'">'.$locationshow.format_number($phonedetails,'display','').'</a>'.$wrapperclose;
                    };
                };
 
            endwhile;

            
        };
    };
    if ($type === 'email') {
        if( have_rows('email_accounts', 'option') ) {
            while ( have_rows('email_accounts', 'option') ) : the_row();
                //contact_phone
                $field_location = get_sub_field('locations');
                $emaildetails = get_sub_field('contact_email_address');
                $socialicon =get_sub_field('icon_fields_contact'); 


                if ($showicon === 'yes') {  
                    $socialicon =get_sub_field('icon_fields_contact'); 
                
                    if (($emaildetails) && (($location === $field_location) || ($location === 'all'))){
                        if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
                        $contactoutput .= $wrapperopen.'<a href="mailto:'.$emaildetails.'">'.$socialicon.$locationshow.$emaildetails.'</a>'.$wrapperclose;
                    };
                } elseif ($showicon === 'only') { 

                    if (($emaildetails) && (($location === $field_location) || ($location === 'all'))){
                        if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
                        $contactoutput .= $wrapperopen.'<a href="mailto:'.$emaildetails.'">'.$socialicon.'</a>'.$wrapperclose;
                    };

                } else {  
                   
                    if (($emaildetails) && (($location === $field_location) || ($location === 'all'))){
                        if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
                        $contactoutput .= $wrapperopen.'<a href="mailto:'.$emaildetails.'">'.$locationshow.$emaildetails.'</a>'.$wrapperclose;
                    };
                };
                
            endwhile;  
        };
    };
    if ($type === 'whatsapp') {
        if( have_rows('whatsapp_accounts', 'option') ) {
            while ( have_rows('whatsapp_accounts', 'option') ) : the_row();
                //contact_phone
                $field_location = get_sub_field('locations');
                $whatsapp = get_sub_field('contact_whatsapp');
                $socialicon =get_sub_field('icon_fields_contact'); 


                if ($showicon === 'yes') {  
                    
                    $socialicon =get_sub_field('icon_fields_contact'); 
                    if (($whatsapp) && (($location === $field_location) || ($location === 'all'))){
                        if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
    
    
                        $contactoutput .= $wrapperopen.'<a href="https://wa.me/'.format_number($whatsapp,'','yes').'">'.$socialicon.$locationshow.format_number($whatsapp,'display','').'</a>'.$wrapperclose;
                    };

                } elseif ($showicon === 'only') {  
                    
                        $socialicon =get_sub_field('icon_fields_contact'); 
    
    
                        if (($whatsapp) && (($location === $field_location) || ($location === 'all'))){
                            if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
        
        
                            $contactoutput .= $wrapperopen.'<a href="https://wa.me/'.format_number($whatsapp,'','yes').'">'.$socialicon.'</a>'.$wrapperclose;
                        };
                
                
                } else {  
                    
                    $socialicon = ''; 
                
                    if (($whatsapp) && (($location === $field_location) || ($location === 'all'))){
                        if (($showlocation === 'yes') && ($field_location != 'Default'))  { $locationshow = $field_location.' - '; } else { $locationshow = ''; };
    
    
                        $contactoutput .= $wrapperopen.'<a href="https://wa.me/'.format_number($whatsapp,'','yes').'">'.$socialicon.$locationshow.format_number($whatsapp,'display','').'</a>'.$wrapperclose;
                    };
                
                
                };

                
            endwhile;

            
        };
    };
    
   return $contactoutput;
};

function ReturnAddress($location = 'Default', $wrapper = '') {
    $addressoutput=$wrapperopen = $wrapperclose = '';
    if ($wrapper != '') { $wrapperopen = '<'.$wrapper.'>'; $wrapperclose = '</'.$wrapper.'>'; };

    if( have_rows('address_fields', 'option') ) {
        while ( have_rows('address_fields', 'option') ) : the_row();
            //contact_phone
            $field_location = get_sub_field('locations');
            $addressdetails = get_sub_field('address_field');

            if (($location === $field_location) || ($location === 'all')){
               

                $addressoutput .= $wrapperopen.$addressdetails.$wrapperclose;
            };

        endwhile;
    };

    return $addressoutput;
};

/**
 * Returns a breadcrumb list.
 */
function createbreadcrumb() {
    global $post;
    // Get the IDs of the page ancestors
    $ancestor_ids = get_post_ancestors( $post->ID );
    $ancestor_ids = array_reverse( $ancestor_ids );
    $breadcrumb = '<ul class="breadcrumb">';
    $breadcrumb .= '<li><a href="' . get_home_url() . '">Home</a></li>';

    foreach ( $ancestor_ids as $ancestor_id ) {
        $ancestor_title = get_the_title( $ancestor_id );
        $ancestor_url = get_permalink( $ancestor_id );
        $breadcrumb .= '<li><a href="' . $ancestor_url . '">' . $ancestor_title . '</a></li>';
    };
    // Add the current page to the breadcrumb
    $breadcrumb .= '<li class="current">' . get_the_title( $post->ID ) . '</li>';
    $breadcrumb .= '</ul>';

    return $breadcrumb;
}

/**
 * Add support for excerpts to pages.
 */
add_post_type_support( 'page', 'excerpt' );
?>
