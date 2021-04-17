<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Check your PCR results</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
  <h6 class="not-visible">Updated</h6>
  <h3>Check your PCR results</h3> 
  </div>

<div class="content">
<button class="btn" id="btn.id">Click here</button>
 <h1>...</h1>

<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="images/user-avatar-with-check-mark.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
 						<br>
                                                <a href="index.php" style="color: red;">go back</a>
                                                <br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
</div>

<script>


    generateResponse = function(){

      var random = Math.round(Math.random());
      if (random) {
        document.getElementsByTagName('h1')[0].innerHTML  = 'You are Positive';
        
      }
      else {
        document.getElementsByTagName('h1')[0].innerHTML  = 'You are Negative';
        
      }
      document.getElementsByTagName('H6')[0].classList.toggle('not-visible');
      setTimeout(function() { document.getElementsByTagName('H6')[0].classList.toggle('not-visible'); }, 400);
    }

document.getElementsByTagName('button')[0].onclick = generateResponse;

</script>

</body>
</html>
