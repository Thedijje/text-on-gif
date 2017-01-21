<?php 
$output_gif	=	"http://placehold.it/730x440/e74c3c/fff?text=Preview+Area";;
if(isset($_POST['text'])){
	$directory = "gif/new_car/";
	
	$source_gif	=	'gif/heart.gif';

	// Convert GIF image into frames of jpg to write text
	exec('convert '.$source_gif.' -coalesce '.$directory.'heart_%05d.jpg');

    foreach (scandir($directory) as $file) {
       if ('.' === $file) continue;
        if ('..' === $file) continue;
		
		
		$source	=	$directory.$file;
		
		
		
        $image	=	imagecreatefromjpeg($source);
		
		$output	=	$directory.$file;
		$fontsize	=	"25";
		$text		= $_POST['text'];
		
		$white		=	imagecolorallocate($image,255,255,255);
		$black		=	imagecolorallocate($image,0,0,0);
		
		$rotation	=	0;
		$origin_x	=	150;
		$origin_y	=	520;
		$fonts		= 	"fonts/font2.ttf";
		
		$text_1	=	imagettftext($image,$fontsize,$rotation,$origin_x+1,$origin_y,$white,$fonts,$text);
		$text_1	=	imagettftext($image,$fontsize,$rotation,$origin_x,$origin_y,$black,$fonts,$text);
		
		imagejpeg($image,$output,99);
		
	
		
    }
	$output_gif	=	$directory.'heart_new.gif';
	exec('convert   -delay 30   -loop 0   '.$directory.'heart_*.jpg '.$output_gif);

}	
?>
<!doctype html>
	<head>
		<meta property="og:image" content="images/result_image.jpg" />
		<meta property="og:title" content="Add text to GIF image Demo" />
		<meta property="og:description" content="Select animation, add your text and save output image or share it." />
		<title>Add text to GIF image Demo</title>
		<meta name="description" content="Select animation, add your text and save output image or share it.">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$('#loading').hide();
			$('#form').submit(function(){
				$('#loading').show();
			});
			});
			
			
		</script>
		
		<style>
			.output{
			border-radius:10px;
			}
			
			img{
			margin:5px;
			border:1px solid #eee;
			padding:3px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Add custome text to GIF</h1>
			<hr>
			<div class="col-lg-4">
				<form class="form" id="form" action="" method="post">
					<div class="form-group">
						<label>Select Image</label>
						<div class="clearfix"></div>
						<div class="col-lg-6">
						<label>Heart</label>
						<input type="radio"checked name="image" value="img1"> <img class="hidden" width="100" src="gif/heart.gif">
						</div>
						
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label>Enter Text</label>
						<input class="form-control" type="text" name="text" value="" placeholder="Add text to be added on image" required>
					</div>
				
					
					<div class="form-group">
						<button class="btn btn-primary" id="save"><i class="fa fa-arrow-right"></i> See Outout</button>
						<span  id="loading"><i class="fa fa-spinner fa-spin fa-lg"></i> Generating Output image</span>
					</div>
				
				</form>
			</div>
			<div class="col-lg-8">
				<img class="output" src="<?php echo $output_gif?>" width="100%" style="margin:10px auto">
			</div>
		</div>
		
	</body>
<!doctype!>