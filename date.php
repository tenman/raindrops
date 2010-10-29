<?php
/*
date.php - calendar based archive navigation
copyright (c) 2005 Scott Merrill (skippy@skippy.net)
Released under the terms of the GNU GPL version 2
   http://www.gnu.org/licenses/gpl.html
*/


if(isset($_GET['ec3_listing']) and !empty($_GET['ec3_listing'])){

    get_template_part('archive');
exit;

}

    $weekdaynames = array(
        0 => __('Sunday'),
        1 => __('Monday'),
        2 => __('Tuesday'),
        3 => __('Wednesday'),
        4 => __('Thursday'),
        5 => __('Friday'),
        6 => __('Saturday')
    );

    if (have_posts()) {
            $ye = mysql2date('Y', $wp_query->posts[0]->post_date);
            $mo = mysql2date('m', $wp_query->posts[0]->post_date);
            $da = mysql2date('d', $wp_query->posts[0]->post_date);
    }else{

            get_template_part('404');
    }

get_header('xhtml1'); ?>

<div id="yui-main">
  <div class="yui-b">
<?php
if(function_exists('bcn_display')){
    echo '<div class="breadcrumb">';
    bcn_display();
    echo '</div>';
}
?>
<div class="<?php echo $yui_inner_layout;?>">
<!-- content -->
<div class="yui-u first" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
<?php
echo '<h1 class="page-title">';
    if (is_year()) {
            $one_year = query_posts("posts_per_page=-1&year=$ye");
            $output = get_year($one_year, $ye);
            wp_reset_query();
             _e( 'Yearly Archives', 'raindrops');

    } elseif (is_month()) {
            $one_month = query_posts("posts_per_page=-1&year=$ye&monthnum=$mo");
            $output = month_list($one_month, $ye, $mo);
            wp_reset_query();
            _e( 'Monthly Archives', 'raindrops');
    } elseif (is_day()) {
            $one_day = query_posts("posts_per_page=-1&year=$ye&monthnum=$mo&day=$da");
            $output = get_day($one_day, $ye, $mo, $da);
            wp_reset_query();
            _e('Daily Archives');
    }
echo '</h1>';
echo '<div id="content" class="narrowcolumn">';
echo $output;
echo '</div>';


?>




      </div>
      <!-- navigation-->
      <div class="yui-u">
        <!--rsidebar start-->
        <?php if($rsidebar_show){get_sidebar('2');} ?>
        <!--rsidebar end-->
      </div>
      <!--add col here -->
    </div>
    <!--main-->
  </div>
</div>
<!--sidebar-->
<!-- navigation 2 -->
<div class="yui-b">
  <!--lsidebar start-->
  <?php get_sidebar('1'); ?>
  <!--lsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>

<?php get_footer(); ?>

<?php

    function days_in_month($month, $year) {
            $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            if ($month != 2) {
                    return $daysInMonth[$month - 1];
            }
            return (checkdate($month, 29, $year)) ? 29 : 28;
    }

    function get_month ($posts = '', $year = '', $this_month = '', $pad = 1) {

    global $wpdb, $weekdaynames, $month;

    // info about this month
    $days_in_month      = days_in_month($this_month, $year);
    $first_day_of_month = date('w', mktime(0, 0, 0, $this_month, '1', $year));
    $last_day_of_month  = date('w', mktime(0, 0, 0, $this_month, $days_in_month, $year));

    // what day starts the week here?
    $start_of_week = get_settings('start_of_week');
    if (0 != $start_of_week) {
            $end_of_week = 6 - (7 - $start_of_week);
    } else {
            $end_of_week = 7;
    }

    // one week here
    for ($i = $start_of_week; $i < ($start_of_week + 7); $i++) {
            if ($i >= 7) {
                    $one_week[] = $weekdaynames[$i - 7];
            } else {

                    $one_week[] = $weekdaynames[$i];
            }
    }

    // pad the beginning of the calendar with dates from last month
    // grab any post data for those days

    $pre_pad = 0;
    $before = '';
    if ($start_of_week != $first_day_of_month) {
            if ($first_day_of_month > $start_of_week) {
                    $pre_pad = ($first_day_of_month - $start_of_week);
            } elseif ($start_of_week > $first_day_of_month) {
                    $pre_pad = (7 - $start_of_week) + $first_day_of_month;
            }
    }

    $days_in_last_month = date('t', mktime(0, 0, 0, $this_month-1, '1', $year));

    if ( (0 != $pre_pad) && ($pad) ) {
            $start = ($days_in_last_month - $pre_pad)+1;
            $lastmonth = $this_month - 1;


        $old_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_date >
    '$year-$lastmonth-$start 00:00:01' AND post_date < '$year-$lastmonth-$days_in_last_month 23:59:59' ORDER BY post_date");


        if ($old_posts) {
                $last_month = array();
                foreach ($old_posts as $post) {
                        $day = substr($post->post_date, 8, 2);
                        if (! isset($last_month[$day])) {
                                $last_month[$day] = "<a href=\"" . get_permalink($post->ID) . "\"
title=\"$post->post_title\">$day</a>";
                        } else {
                                $last_month[$day] = "<a href=\"" . get_settings('home') . "/$year/$lastmonth/$day\"
title=\"/$year/$lastmonth/$day\">$day</a>";
                        }
                }
        }
    }

    for ($i = ($days_in_last_month - $pre_pad)+1; $i <= $days_in_last_month; $i++) {
                    if (! $pad) {
                            $before .= '<td> </td>';
                    } else {
                            $before .= '<td class="lastmonth">';
                            if (isset($last_month[$i])) {
                                    $before .= $last_month[$i];
                            } else {
                                    $before .= $i;
                            }
                            $before .= '</td>';
                    }
    } // end if ($pad) ...

    $the_month = array();

    // prepare an array for this month's posts, by date
    if (! empty($posts)) {
            foreach ($posts as $post) {
                    $day = substr($post->post_date, 8, 2);
                    if (10 > $day) {
                            $day = substr($day, 1, 1);
                    }
                    if (! isset($the_month[$day])) {
                            $the_month[$day] = "<a href=\"" . get_permalink($post->ID) . "\" title=\"$post->post_title\">$day</a>";
                    } else {
                            $the_month[$day] = "<a href=\"" . get_settings('home') . "/$year/$this_month/" . zeroise($day, 2) . "\"
    title=\"$year/$this_month/" . zeroise($day, 2) . "\">$day</a>";
                    }
            }
    }

    $daycount = $pre_pad;
    $here = get_settings('home');
    $cal = "<h2 class=\"h2\"><a href=\"$here/$year/\" title=\"$year\">$year</a> <a href=\"$here/$year/$this_month/\"
    title=\"$year/$this_month\">" .
    $month[zeroise($this_month, 2)] . "</a></h2>";
    $cal .= '<table><tr>';


    foreach ($one_week as $day) {
            $cal .= "<th>$day</th>";
    }

    $cal .= '</tr><tr>' . $before;
    for ($i = 1; $i <= $days_in_month; $i++) {
            $cal .= '<td> ';
            if (isset($the_month[$i])) {
                    $cal .=  $the_month[$i];
            } else {
                    $cal .= $i;
            }
            $cal .= ' </td>';
            $daycount++;
            if ($daycount >= 7) {
                    $cal .= '</tr><tr>';
                    $daycount = 0;
            }
    }

    $after = '';

    // if necessary, pad the end of the calendar with dates from next month
    // grab any post data for those days
    if ( ($end_of_week != $last_day_of_month) && ($pad) ) {
            $end = (7 - $daycount);
            $nextmonth = $this_month + 1;
            $new_posts = $wpdb->get_results("SELECT ID, post_title, post_date FROM $wpdb->posts WHERE post_status = 'publish' AND
    post_date > '$year-$nextmonth-01 00:00:01' AND post_date < '$year-$nextmonth-0$end 23:59:59' ORDER BY post_date");
            if ($new_posts) {
                    if (10 > $nextmonth) {
                            //$nextmonth = "0$nextmonth";

                            $nextmonth = printf("%02d", $nextmonth);

                    }
                    $next_month = array();
                    foreach ($new_posts as $post) {
                            $day = substr($post->post_date, 9, 1);
                            if (! isset($next_month[$day])) {
                                    $next_month[$day] = "<a href=\"" . get_permalink($post->ID) . "\"
    title=\"$post->post_title\">$day</a>";
                            } else {
                                    $next_month[$day] = "<a href=\"" . get_settings('home') . "/$year/$nextmonth/0$day\"
    title=\"/$year/0$nextmonth/$day\">$day</a>";
                            }
                    }
            }
    }

    for ($i = 1; $i <= (7 - $daycount); $i++) {
            if (! $pad) {
                    $after .= '<td> </td>';
            } else {
                    $after .= '<td class="lastmonth">';
                    if (isset($next_month[$i])) {
                            $after .= $next_month[$i];
                    } else {
                            $after .= $i;
                    }
                    $after .= '</td>';
            }
    } // end if ($pad) ...
        $cal .= $after;
        $cal .= '</tr></table>';
    return $cal;
    } //end get_month()




    function get_year($posts = '', $year = '', $pad = 0) {

        $months = array();

        // first let's parse through our posts, organizing them by month
        foreach ($posts as $post) {
                $y = substr($post->post_date, 0, 4);
                $m = substr($post->post_date, 5, 2);
                $d = substr($post->post_date, 8, 2);
                $months[$m][] = $post;
        }

        $output = '';
        foreach ($months as $num => $val) {
                $output .= year_list ($val, $year, $num, $pad);

        }
    return $output;
    } // end get_year()



    function get_day($posts = '', $year = '', $mon = '', $day = '', $pad = 1){

        global $month;

        $here = get_settings('home');

        $output = "<h2 class=\"h2\"><a href=\"$here/$year/\" title=\"$year\">$year</a> <a href=\"$here/$year/$mon/\" title=\"$year/$mon\">" .
        $month[zeroise($mon, 2)] . "</a><span class=\"day-name\">  $day </span></h2>";
        $output .= '<table id="date_list"><tr>';
        // organize posts by hour
        //2009-05-27 08:47:10

        foreach ($posts as $mytime) {
                $h = substr($mytime->post_date, 11, 2);
                if (10 > $h) {
                        $h = substr($h, 1, 1);
                }
                $today[$h][] = $mytime;
        }

        for ($i = 0; $i <= 24; $i++) {
                $output .= '<tr><td class="time">';
                if (10 > $i) {
                        $output .= "0$i:00";
                } else {
                        $output .= "$i:00";
                }
                $output .= '</td><td>';

                if (isset($today[$i])) {
                                foreach ($today[$i] as $mytime) {
                                        $output .= "<a href=\"" . get_permalink($mytime->ID) . "\"
        title=\"$mytime->post_title\">$mytime->post_title</a><br />";
                                }

                } else {
                        $output .= '&nbsp';
                }
                $output .= '</td></tr>';
        }
        $output .= '</table>';
        return $output;
    }
    // end get_day()






    function year_list($one_month,$ye,$mo){
        $result = "";
        for($i=1;$i <= 12;$i++){
            $result .= "<tr><td class=\"month-name\"><span class=\"month-name\">";
            $result .= $i;

            $links = "";
    //var_dump($one_month);
            foreach($one_month as $month){

                list($y,$m,$d,$h,$m,$s) = sscanf($month->post_date,"%d-%d-%d $d:$d:$d");

                if($m == $i and $ye == $y){
                $links .= "<li><a href=\"" . get_permalink($month->ID) . "\" title=\"$mytime->post_title\">".$month->post_title."</a></li>";
                }

            }

            if(!empty($links)){
                $result .= " </span></td><td><ul>";
                $result .= $links;
                $result .= "</ul></td></tr>";
                }else{
                $result .= " </span></td><td>&nbsp;</td></tr>";

            }
        }
        return "<table id=\"year_list\">".$result."</table>";
    }






    function month_list($one_month,$ye,$mo){
        $result = "";
        for($i=1;$i <= days_in_month($mo, $ye);$i++){
        $result .= "<tr><td class=\"month-date\"><span class=\"day-name\">";
        $result .= $i;
        $links = "";
    foreach($one_month as $month){

        list($y,$m,$d,$h,$m,$s) = sscanf($month->post_date,"%d-%d-%d $d:$d:$d");

        if($d == $i and $m == $mo and $y == $ye){
        $links .= "<li><a href=\"" . get_permalink($month->ID) . "\" title=\"$mytime->post_title\">".$month->post_title."</a></li>";
        }

    }
        if(!empty($links)){
        $result .= " </span></td><td><ul>";
        $result .= $links;
        $result .= "</ul></td></tr>";
        }else{
        $result .= " </span></td><td>&nbsp;</td></tr>";

        }

        //$result .= "</ul></td></tr>\n";
    }
    $here = get_bloginfo('url');
        $output = "<h2 id=\"date_title\" class=\"h2\"><a href=\"$here/$y/\" title=\"$year\"><span class=\"year-name\">{$y} </span></a> <span class=\"month-name\">" . $m . " </span></h2>";
        return $output."<table id=\"month_list\">".$result."</table>";
    }






?>