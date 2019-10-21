<?php
include 'lib/customizer.php';
include 'lib/widget-areas.php';
include 'lib/widget.php';
add_filter('pre_option_link_manager_enabled','__return_true');

//以下に独自に追加したウィジェットエリアやウィジェットのコードをお書きください。