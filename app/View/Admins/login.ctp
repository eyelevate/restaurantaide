<?php
//displays a message bar if the user has not logged in, before accessing. Uses auth->authError variable set in controller
echo $this->TwitterBootstrap->flashes(array(
    "auth" => true,
    "closable"=>true
    )
);

?>
<div class="row-fluid">
	<div class="container span10 offset5">
			<?php
			echo $this->Form->create('User');
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->submit('Admin Login');
			echo $this->Form->end();
			?>			
	
	</div>	
</div>

