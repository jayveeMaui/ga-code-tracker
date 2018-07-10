<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.ggpoker.com
 * @since      1.0.0
 *
 * @package    Ga_Code_Tracker
 * @subpackage Ga_Code_Tracker/public/partials
 */

//get track code Lists
$ga_code_tracker_table_name = $GLOBALS['wpdb']->prefix . "ga_code_tracker";
$results = $GLOBALS['wpdb']->get_results( "SELECT * FROM $ga_code_tracker_table_name",ARRAY_A);
$track_arr = array();

if(sizeof($results) > 0) {

    //manipulate the output array [code => description]
    foreach($results as $val) {
        array_push($track_arr, [$val['code'] => $val['description']]);
    }
} 


?>
<script defer='defer'>
(function( $ ) {
	'use strict';
    
    $(document).ready(function(){
        var ga_track_list = <?php echo json_encode($track_arr) ?>;
        $("a").on("click", function (e) {

            var dlLinks = ['/download/', '/download-real-money-poker-app/'];
            var targetLink = $(this).attr('href').split('.com');
            var arrayCL = location.href.split('.com');
            if ((dlLinks.indexOf(targetLink[0]) >= 0 || targetLink[0].indexOf('?gaTrackerID=') >= 0) || (dlLinks.indexOf(targetLink[1]) >= 0 || targetLink[1].indexOf('?gaTrackerID=') >= 0)) {
                e.preventDefault();

                var rLink = '/download-real-money-poker-app/';
                if (bowser.ios) {
                    rLink = '/download-real-money-poker-app/ios-thank-downloading/';
                }
                if (bowser.android) {
                    rLink = '/download-real-money-poker-app/android-thank-downloading/';
                }

                //for multiple download button in one page
                if (targetLink[0].indexOf('?gaTrackerID=') >= 0 || (targetLink[1] != undefined && targetLink[1].indexOf(
                        '?gaTrackerID=') >= 0)) {
                    arrayCL[1] = $(this).attr('href').split('?gaTrackerID=')[1];
                }
                var check_code = ga_track_list.filter(function(e,i){
                    return e[arrayCL[1]] != undefined
                })
                if(check_code.length > 0) {
                    ga('send', 'event', check_code[0][arrayCL[1]].replace(/\\/g,''), 'Click', 'Event', 1);
                } else {
                    sendEventGA($(this), arrayCL[1], $(this).attr('href'));
                }
                sessionStorage.setItem('download', 'true');
                location.href = rLink;
            }
        });
        function sendEventGA(e, f, url) {

            //gtag event trigger
            if (url)
                gtag_report_conversion(url);

            if (e[0].offsetParent.id === 'footer') {
                ga('send', 'event', "Download - Footer Link", 'Click', 'Event', 1);
            } else if (e[0].parentElement.classList[0] === 'menu-item' || e[0].parentElement.classList[1] === 'mobile-dl') {
                ga('send', 'event', "Download - Header Link", 'Click', 'Event', 1);
            } else {
                if (e[0].className == 'slbutton') {
                    ga('send', 'event', "Download - 'Home' Jumbotron Button", 'Click', 'Event', 1);
                }
                if (e[0].classList[0] == 'rd_normal_bt') {
                    ga('send', 'event', "Download - 'Home' H1 Bar Button", 'Click', 'Event', 1);
                }
                console.log('event - send');
            }
        }
    })
})( jQuery );


</script>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
