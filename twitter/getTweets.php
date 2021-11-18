<?php
    // ### Checks for presence of the cURL extension.
    function _iscurlinstalled() {
        if  (in_array  ('curl', get_loaded_extensions())) {
            return true;
        }
        else{
            return false;
        }
    }
    if (!_iscurlinstalled()) die('cURL is NOT installed');

    $username = 'themefuse';
    $limit = '5';
    if(isset($_REQUEST['username']))  $username = $_REQUEST['username'];
    if(isset($_REQUEST['items']))  $limit = $_REQUEST['items'];

    $limit = intval($limit);
    if($limit == 0) $limit = 5;

    $tweets_content = '';
    if ( !empty($username) )
    {
        require_once ( 'TWITTER.php' );

        $obj_twitter = new Twitter($username);
        $tweets = $obj_twitter->get($limit);
        $k = 0;
        foreach ( $tweets as $tweet )
        {

            $tweets_content .= '<li>';

            if( isset($tweet[0]) )
            {
            $tweets_content.= $tweets[$k][2];
            $k++;
            }

            $tweets_content .= '</li>';
        }
    }
    echo $tweets_content;
?>