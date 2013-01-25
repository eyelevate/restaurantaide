<?php
//add scripts to header
echo $this->Html->script(array('events.js'),FALSE);
//alerts on page
echo $this->TwitterBootstrap->flashes(array(
    "auth" => False,
    "closable"=>true
    )
);
?>
<div class="row-fluid">
	
</div>