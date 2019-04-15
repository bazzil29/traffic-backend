<?php
function parseToXML($htmlStr)
{
    $xmlStr = str_replace('<', '&lt;', $htmlStr);
    $xmlStr = str_replace('>', '&gt;', $xmlStr);
    $xmlStr = str_replace('"', '&quot;', $xmlStr);
    $xmlStr = str_replace("'", '&#39;', $xmlStr);
    $xmlStr = str_replace("&", '&amp;', $xmlStr);
    return $xmlStr;
}

// Iterate through the rows, printing XML nodes for each
header("Content-type: text/xml");
if ($start_time == '') {
    // Start XML file, echo parent node
    echo '<markers>';
    //echo each xml line
    foreach ($rectangles as $rectangle) {
        echo '<marker ';
        echo 'whereX="' . $rectangle->height . '" ';
        echo 'whereY="' . $rectangle->width . '" ';
        echo 'avg_speed="' . $rectangle->avg_speed . '" ';
        echo 'marker_count="' . $rectangle->marker_count . '" ';
        echo 'color="' . $rectangle->color . '" ';
        echo '/>';

    }
    // End XML file
    echo '</markers>';
    // Modified by Toan
} elseif (substr($start_time,0,6) == 'future') {

    // Start XML file, echo parent node
    echo '<markers>';
    //echo each xml line
    foreach ($rectangles as $rectangle) {
        echo '<marker ';
        echo 'whereX="' . $rectangle->height . '" ';
        echo 'whereY="' . $rectangle->width . '" ';
        // echo 'lastest_data="' . $rectangle->lastest_data . '" ';
        // echo 'weekly_data="' . $rectangle->weekly_data . '" ';
        echo 'color="' . $rectangle->color . '" ';
        echo '/>';

    }
    // End XML file
    echo '</markers>';
} else {
    // Start XML file, echo parent node
    echo '<markers>';
    //echo each xml line
    foreach ($rectangles as $rectangle) {
        echo '<marker ';
        echo 'whereX="' . $rectangle->height . '" ';
        echo 'whereY="' . $rectangle->width . '" ';
        echo 'color="' . $rectangle->color . '" ';
        echo '/>';
    }
    // End XML file
    echo '</markers>';
}
?>