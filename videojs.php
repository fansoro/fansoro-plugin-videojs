<?php

/**
 * Morfy VideoJS Plugin
 *
 * (c) Romanenko Sergey / Awilum <awilum@msn.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Action::add('theme_header', function () {
    echo('<link rel="stylesheet" href="http://vjs.zencdn.net/5.2.1/video-js.css">');
});

Action::add('theme_footer', function () {
    echo('<script src="http://vjs.zencdn.net/5.2.1/video.js"></script>');
});

Shortcode::add('video', 'video');

function video($attributes)
{
    // Extract
    extract($attributes);

    // MP4 Source Supplied
     if (isset($mp4)) {
         $mp4_source = '<source src="'.$mp4.'" type=\'video/mp4\' />';
     } else {
         $mp4_source = '';
     }

     // WebM Source Supplied
     if (isset($webm)) {
         $webm_source = '<source src="'.$webm.'" type=\'video/webm; codecs="vp8, vorbis"\' />';
     } else {
         $webm_source = '';
     }

     // Ogg source supplied
     if (isset($ogg)) {
         $ogg_source = '<source src="'.$ogg.'" type=\'video/ogg; codecs="theora, vorbis"\' />';
     } else {
         $ogg_source = '';
     }

     // Poster image supplied
     if (isset($poster)) {
         $poster_attribute = ' poster="'.$poster.'"';
     } else {
         $poster_attribute = '';
     }

     // Preload the video?
     if (isset($preload)) {
         $preload_attribute = 'preload="'+$preload+'"';
     } else {
         $preload_attribute = '';
     }

     // Autoplay the video?
     if (isset($autoplay)) {
         $autoplay_attribute = " autoplay";
     } else {
         $autoplay_attribute = "";
     }

     // Width
     if (isset($width)) {
         $width = $width;
     } else {
         $width = 640;
     }

     // Height
     if (isset($height)) {
         $height = $height;
     } else {
         $height = 264;
     }

    $template = Template::factory(PLUGINS_PATH . '/videojs/templates/');

    // Set template option: strip = true to prevent markdown LINES AUTO FORMATING
    $template->setOptions([
        "strip" => true
    ]);

    return $template->fetch(
        'videojs.tpl',
        [
            'width'   => $width,
            'height'  => $height,
            'poster_attribute'   => $poster_attribute,
            'preload_attribute'  => $preload_attribute,
            'autoplay_attribute' => $autoplay_attribute,
            'mp4_source'  => $mp4_source,
            'webm_source' => $webm_source,
            'ogg_source'  => $ogg_source
        ]
    );
}
