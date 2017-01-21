<?php 
$output_gif	=	"http://placehold.it/730x440/e74c3c/fff?text=Preview+Area";;
if(isset($_POST['text'])){
	
	/*
	|	Specify directory where output frame will be placed
	|	after extraction of GIF Image
	|
	*/
	$directory 	= "gif/heart/";
	
	/*
	|	Create random filename
	|	md5 of timestamp and random number should be best possible way
	|	this name will be used for naming each file for current GIF extracted frame in sequance number
	|
	*/
	$file_name	=	md5(rand().time());
	
	/*
	|
	|	Specify the image source for processing
	|	Speed of this process depends on source image
	|	Less frame and low quality frame tends to take less time and vice versa
	|
	*/
	$source_gif	=	'gif/heart.gif';

	/*
	|	This is execution of Imagick command using PHP
	|	To use this, extension imagick must be installed on your PHP
	|	http://php.net/manual/en/book.imagick.php
	|	This command will convert source GIF into frames of file having
	|	prefix as $file_name that we have created earlier.
	|
	*/
	
	exec('convert '.$source_gif.' -coalesce '.$directory.$file_name.' %05d.jpg');
	
	/*
	|	Scaning the directory where extrated frame is placed
	|	Validating .. and . file and skip itation
	|	Getting file instance and name of file for adding text
	|
	*/
	
    foreach (scandir($directory) as $file) {
       if ('.' === $file) continue;
        if ('..' === $file) continue;
		
		if(strpos($file,$file_name)===false){
			/*
			|	Checking if file is not from this session or this gif extracted image, skipping 	
			*/
			
			continue;
		}
		/*
		|	Source file will be each frame for given file 
		*/
		$source	=	$directory.$file;
		
		
		/*
		|	Create new jped image from source image for processing
		|
		*/
		
        $image	=	imagecreatefromjpeg($source);
		
		
		/*
		|	$output	:	Specify output file name;
		|
		|	$fontsize	:	specify font size to be used to print text
		|
		|	$text		:	specify text to be print on image frames
		|
		|	$while		:	allocate white color to image
		|
		|	$black		:	allocating black color to image
		|
		*/
		$output	=	$directory.$file;
		$fontsize	=	"25";
		$text		= $_POST['text'];
		
		$white		=	imagecolorallocate($image,255,255,255);
		$black		=	imagecolorallocate($image,0,0,0);
		
		
		
		/*
		|
		|	$rotation		:	rotation of text in degree 
		|
		|	$origin_x		:	origin of text fro top left corner in pixel
		|	
		|	$origin_y		:	origin of text fro top left corner in pixel
		|
		|	$fonts			:	specify path of font
		|
		*/
		$rotation	=	0;
		$origin_x	=	150;
		$origin_y	=	520;
		$fonts		= 	"fonts/font2.ttf";
		
		
		/*
		| Write text on imgae	
		*/
		$text_1	=	imagettftext($image,$fontsize,$rotation,$origin_x+1,$origin_y,$white,$fonts,$text);
		$text_1	=	imagettftext($image,$fontsize,$rotation,$origin_x,$origin_y,$black,$fonts,$text);
		
		
		/*
		| Printing output image	
		*/
		imagejpeg($image,$output,99);
		
	
		
    }
	
	/*
	|	Final name of output gif
	|	render output image and print
	*/
	
	$output_gif	=	$directory.'heart_new.gif';
	exec('convert   -delay 30   -loop 0   '.$directory.$file_name.'_*.jpg '.$output_gif);

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