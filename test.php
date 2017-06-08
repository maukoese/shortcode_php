<?php

include 'shortcode.class.php';

$short = new SHORTCODE();

var_dump($short->do_short("[test]"));
echo "\n";

var_dump($short->do_short("[not_exist]"));
echo "\n";

var_dump($short->do_short("[/param]"));
echo "\n";

var_dump($short->do_short("[two_par=abc,,123,,xxx]"));
echo "\n";

var_dump($short->do_short("[param=abc]"));
echo "\n";

var_dump($short->do_short("[/two_par=abc]"));
echo "\n";

?>
