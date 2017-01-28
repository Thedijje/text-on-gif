<h1>Add Text on GIF Using PHP</h1>
<hr>
<pre>
Project Name    :   Gif Text
Function        :   Add text to animated GIF
Developed by    :   Dheeraj Thedijje
Website         :   <a href="http://Thedijje.com">http://Thedijje.com</a>
Contact         :   <a href="mailto:dheeraj@thedijje.com">Dheeraj@thedijje.com</a>

</pre>
<h2>Introduction</h2>
<p>Native GD library of PHP Support image manipulation which can be performed by using PHP functions. But no direct Animated Gif editing option to add text on it. This project is out put of solution of this problem.

<h2>Environment Requirement</h2>
<ul>
    <li>PHP 5.5x</li>
    <li>GD Library should be installed and enabled</li>
    <li>Imagic Extension should be installed and enabled</li>
</ul>

<h2>Whats the catch</h2>
<p>These are steps performed in Adding text to animated GIF </p>
<ol>
    <li>Using Imagick Extract Source GIF into frames and put it in folder</li>
    <li>Using foreach loop, itrate all files of these frames and add text on static image using GD library function.</li>
    <li>Using Imagick, again combine all frames to make animated GIF again</li>
</ol>

<p>Depending on implications, certain changes you may adapt on file/folder structure.