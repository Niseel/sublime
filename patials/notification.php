<?php
	if(isset($_SESSION['success'])){
		echo '
		<div class="alert alert-success">';
		    echo $_SESSION['success'];
		    echo '
		</div>
		';
		unset($_SESSION['success']);
	}
	else if(isset($_SESSION['fail'])){
		echo '
		<div class="alert alert-danger">';
		    echo $_SESSION['fail'];
		    echo '
		</div>
		';
		unset($_SESSION['fail']);
	}
	else if(isset($_SESSION['error'])){
		echo '
		<div class="alert alert-danger">';
		    echo $_SESSION['error'];
		    echo '
		</div>
		';
		unset($_SESSION['error']);
	}

?>