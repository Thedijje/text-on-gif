<?php 
	$output	=	"http://placehold.it/730x440/1abc9c/fff?text=Preview+Area";
	if(!empty($_POST)){
	
		$source	=	"images/".$_POST['image'].".jpg";
		$fontsize	=	$_POST['fontsize'];
		$text		=	$_POST['text'];
		
		if(empty($source) OR empty($fontsize) OR empty($text)){
			$output	=	"http://placehold.it/730x440/1abc9c/fff?text=Empty+parameter";
		}else{
		
			
		$image	=	imagecreatefromjpeg($source);
		
		$output	=	"images/result_image.jpg";
		
		
		$white		=	imagecolorallocate($image,255,255,255);
		$black		=	imagecolorallocate($image,0,0,0);
		
		$rotation	=	0;
		$origin_x	=	100;
		$origin_y	=	100;
		$fonts		= 	"fonts/".$_POST['fonts'].".ttf";
		
		$text_1	=	imagettftext($image,$fontsize,$rotation,$origin_x,$origin_y,$black,$fonts,$text);
		$text_1	=	imagettftext($image,$fontsize,$rotation,$origin_x+2,$origin_y,$white,$fonts,$text);
		imagejpeg($image,$output,99);
		
		}
		
		
		
	}
?>

<!doctype html>
	<head>
		<meta property="og:image" content="images/result_image.jpg" />
		<meta property="og:title" content="Add text to image Demo" />
		<meta property="og:description" content="Select image and fonts, add your text and save output image or share it." />
		<title>Add text to image Demo</title>
		<meta name="description" content="Select image and fonts, add your text and save output image or share it.">
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
			<h1>Add custome text to image</h1>
			<hr>
			<div class="col-lg-4">
				<form class="form" id="form" action="" method="post">
					<div class="form-group">
						<label>Select Image</label>
						<div class="clearfix"></div>
						<div class="col-lg-6">
						<input type="radio" name="image" value="img1"> <img width="100" src="images/img1.jpg">
						</div>
						
						<div class="col-lg-6">
						<input type="radio" name="image" value="img2"> <img width="100" src="images/img2.jpg" >
						</div>
						<div class="clearfix"></div>
						<div class="col-lg-6">
						<input type="radio" name="image" value="img3"> <img width="100" src="images/img3.jpg" >
						</div>
						
						<div class="col-lg-6">
						<input type="radio" name="image" value="img4"> <img width="100" src="images/img4.jpg" >
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label>Enter Text</label>
						<input class="form-control" type="text" name="text" value="" placeholder="Add text to be added on image" required>
					</div>
					
					<div class="form-group">
						<label>Enter font size</label>
						<input class="form-control" type="number" min="10" max="50" step="10" value="20" name="fontsize" required>
					</div>
					
					<div class="form-group">
						<label>Select Font</label>
						<select name="fonts"  class="form-control" required>
							
							<option selected>font1</option>
							<option>font2</option>
							<option>font3</option>
							<option>font4</option>
							<option>font5</option>
						</select>
					</div>
					
					<div class="form-group">
						<button class="btn btn-primary" id="save"><i class="fa fa-arrow-right"></i> See Outout</button>
						<span  id="loading"><i class="fa fa-spinner fa-spin fa-lg"></i> Generating Output image</span>
					</div>
				
				</form>
			</div>
			<div class="col-lg-8">
				<img class="output" src="<?php echo $output?>" width="100%" style="margin:10px auto">
			</div>
		</div>
		
	</body>
<!doctype!>