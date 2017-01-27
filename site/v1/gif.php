<?php 
	function get_initial_x($char){
		$image_width	=	540;
		$mid_point		=	$image_width/2;
		$max_char		=	60;
		$per_char		=	9;
		$char;
		$len_required	=	$char*$per_char;
		
		return $mid_point-($len_required/2);
		
		
	}
$output_gif	=	"gif/heart.gif";;
if(isset($_POST['text']) OR isset($_GET['text'])){
	
	
	
	$source_gif			=	'gif/heart.gif';
	
	
	$directory 			= "gif/new_car/";
	
	/*
	|	Directory where output frame is to be put after extraxction;
	|	This directory will be switched based on image that user has selected
	*/
	$frame_directory = "gif/heart_frame/";
	
	/*
	|	Directory where frames to	be kept after writing text;
	*/
	$output_frames 	= "gif/output_frame/";
	
	// Random name for file for output frame.
	$output_name		=	'42847fb966c4969e9b197488aedc3956';
	
	// $op_frame_name=	$frame_directory.$output_name;
	$op_frame_name=	md5(rand().'_'.time());
	
	// Output GIF directory
	$output_gif_dir	=	'gif/output/';
	
	
	/*
	
	// Convert GIF image into frames of jpg to write text
	if(!exec('convert '.$source_gif.' -coalesce '.$op_frame_name.'_%05d.jpg')){
		echo "Error";
	}else{
		echo "Frame extractrd";
	}
	
	*/
	
	
    foreach (scandir($frame_directory) as $file) {
       if ('.' === $file) continue;
        if ('..' === $file) continue;
		
		
		
		$source	=	$frame_directory.$file;
		
		$image	=	imagecreatefromjpeg($source);
		
		$output	=	$output_frames.$op_frame_name.$file;
		$fontsize	=	"24";
		$text		= $_POST['text'];
		if($text==''){
			$text	=	$_GET['text'];
		}
		
		$text2		=	'';
		
		if(strlen($text)>50){
			$text2	=	substr($text,50,50);
			$text	=	substr($text,0,50);
			
		}
		
		$white		=	imagecolorallocate($image,255,255,255);
		$black		=	imagecolorallocate($image,0,0,0);
		
		$rotation	=	0;
		$origin_x	=	get_initial_x(strlen($text));
		$origin_2x=	get_initial_x(strlen($text2));
		$origin_y	=	410;
		$fonts		= 	"fonts/FrenteH1-Regular.otf";
		
		
		
		$text_1	=	imagettftext($image,$fontsize,$rotation,$origin_x+1,$origin_y,$black,$fonts,$text);
		
		if($text2!=''):
			$text_2	=	imagettftext($image,$fontsize,$rotation,$origin_2x,$origin_y+40,$black,$fonts,$text2);
		endif;
		
		
		imagejpeg($image,$output,99);
		
	
		
    }
	
	
	$output_gif	=	$output_gif_dir.$op_frame_name.'.gif';
	exec('convert   -delay 30   -loop 0   '.$output_frames.$op_frame_name.'*.jpg '.$output_gif);

}	
?>
<!doctype html>
	<head>
		<meta property="og:image"	content="images/result_image.jpg" />
		<meta property="og:title" 		content="Add text to GIF image Demo" />
		<meta property="og:description" content="Select animation, add your text and save output image or share it." />
		<title>Add text to GIF image Demo</title>
		<meta name="description" content="Select animation, add your text and save output image or share it.">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	
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
						<span  id="loading"><i class="fa fa-spinner fa-spin fa-lg"></i> Generating Output image...</span>
					</div>
				
				</form>
			</div>
			<div class="col-lg-8">
				<img class="output" src="<?php echo $output_gif?>" width="auto" style="max-width:100%;margin:10px auto">
			</div>
		</div>
		
	</body>
<!doctype!>