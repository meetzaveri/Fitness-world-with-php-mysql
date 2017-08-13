<!DOCTYPE html>
<html>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
</style>
<body>
<?php
	$con=mysqli_connect("localhost","root","","itv_blazon1");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
?>

	<div id='box'>
    	<form method="post" enctype="multipart/form-data" >
         <?php
			//print_r ($_FILES['file']);
			if(isset($_FILES['file'])){
			
				$name = $_FILES['file']['name'];
				$extension = explode('.', $name);
				$extension = end($extension);
				$type = $_FILES['file']['type'];
				$size = $_FILES['file']['size'] /1024/1024;
				$random_name = rand();
				$tmp = $_FILES['file']['tmp_name'];
				
				
				if ((strtolower($type) != "video/mp4") && (strtolower($type) != "video/mpeg") && (strtolower($type) != "video/mpeg1") && (strtolower($type) != "video/mpeg4") && (strtolower($type) != "video/avi") && (strtolower($type) != "video/flv") && (strtolower($type) != "video/wmv") && (strtolower($type) != "video/mov"))
				{
					$message= "Video Format is not supported !";
					
    			}elseif($size >=  13835670)
				{
					$message="File must not greater than 20mb";
				}else
				{
					move_uploaded_file($tmp, 'videos/'.$random_name.'.'.$extension);	
					mysqli_query($con, "INSERT INTO vid_entry VALUES('', '$name' , '$random_name.$extension')");
					$message="Video has been successfully uploaded !";
				}
				echo "$message <br/> <br/>";
				echo "size: $size mb<br/>";
				echo "random_name: $random_name <br/>";
				echo "name: $name <br/>";
				echo "type: $type <br/><br/>";
			}
	
		?>
        	Select Video : <br/>
            <input name="UPLOAD_MAX_FILESIZE" value="13835670"  type="hidden"/>
            <input type="file" name="file" id="file" />
            <br/><br/>
            <input type="submit" value="Upload" />
        </form>
	</div>
    
   
    <div id='box'>
		<?php
			$query = mysqli_query($con, "SELECT * FROM vid_entry");
			while($row = mysqli_fetch_array($query)){
			
		?>
        <div id='url'>
		<a href="view_video.php?video=<?php echo $row['url']; ?>">
			<?php echo $row['name'];?>
		</div>
        <a/>
		<?php
		}
		mysqli_close($con);
		?>
    </div>
</body>
</html>