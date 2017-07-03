<?php
    mysql_connect();
    mysql_select_db("contents");
    $result = mysql_query("SELECT taskName FROM TaskNameID WHERE `parent` = " . mysql_real_escape_string($_GET["parent"]));
    while(($data = mysql_fetch_array($result)) !== false)
        echo '<option value="', $data['id'],'">', $data['name'],'</option>'
?>