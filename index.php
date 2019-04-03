<?php
    include_once 'header.php'; 
 ?>
 
	<section class="main-container">


		<?php
			// Content display if user login
			if (isset($_SESSION['u_id'])){
			echo "Welcome username, you are logged in!";
		    }
         ?>

		<div class="main-wrapper">
		
			<div align="center">
			<h2> Welcome to the Green Hunter </h2>
			<img src="img/malariakills.jpg" alt="sign" width="600" height="345">
			</div>
		</div>
	</section>

<?php
    include_once 'footer.php'; 
 ?>