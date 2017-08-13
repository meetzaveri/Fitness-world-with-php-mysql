<!DOCTYPE html>
<html>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
</style>
<body>
<?php
	$con=mysqli_connect("localhost","root","","video_upload");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
?>

	<div id='box'>
    	<?php
			$video= $_GET['video'];
		?>
        <video id="my_video_1" class="video-js vjs-default-skin" controls data-setup="{}" preload="auto" width="100%" height="450" poster="my_video_poster.png">
        
  		<source src="videos/<?php echo $video; ?>" type='video/mp4'>
		</video>

		<script type="text/javascript">
          function myScript() {
            console.log;
          }
        </script>
        <div id='back'>
        <a href="index.php">Back</a>
        </div>
	</div>
<?php
mysqli_close($con);
?>
    </div>
</body>
</html>