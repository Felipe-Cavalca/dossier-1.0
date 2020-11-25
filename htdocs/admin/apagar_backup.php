<?php
$arq = filter_input(INPUT_GET, 'arq', FILTER_DEFAULT);

unlink('backup/'.$arq);

header('LOCATION: index.php#backup');