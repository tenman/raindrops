<?php

    $config_dir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

    if(file_exists($config_dir.'/wp-config.php')){
        require_once($config_dir.'/wp-config.php');
    }else{
        require_once(dirname($config_dir).'/wp-config.php') or die("error");
    }

    $number = $_GET['ver'];

    if(!preg_match('|[0-9a-f]{32}-([0-9]{1,})|si',$number,$regs)){

        exit;
    }
    $number = $regs[1];

    $table = $table_prefix.$number.'_options';
    $link = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
    $sdb = mysql_select_db(DB_NAME,$link);
    $sql = 'SELECT * FROM `wp_4_options` WHERE `option_name` LIKE \'_raindrops_indv_css\'';
    $result = mysql_query($sql, $link);
    $rows = mysql_fetch_row($result);

header('Content-type: text/css');
    echo $rows[3];
?>