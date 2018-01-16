<?php
$sql = "select * from banner where category_id = 312";

$image = sql_all($mysqli,$sql);


  include  VIEW.$_M.'/'.$_C.'.html';

  ?>