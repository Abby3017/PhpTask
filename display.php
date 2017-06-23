<!DOCTYPE html>
<html>
<head>
	<title>Data Output</title>
</head>
<body>

<?php
if(!class_exists('Prime'))
require_once('class.Prime.php');

if(!class_exists('Bktree'))
require_once('class.bkTree.php');

ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
?>

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
 <p>Set lower range: <input type="text" name="low" /></p>
 <p>Set higher range: <input type="text" name="high" /></p>
 <p><input type="submit" name="Submit" /></p>
</form>
<ul >

<?php
if(isset($_POST['Submit']))
{
if(empty($_POST))
die("please input number");

$lower;
$higher;

if(is_numeric($_POST["low"]))
$lower = $_POST["low"];

if(is_numeric($_POST["high"]))
$higher = $_POST["high"];

$prime 	= new Prime();
$prime->setLow($lower);
$prime->setHigh($higher);
$prime->calcPrime();
//print_r($prime->getPrime());
 $rs = $prime->getPrime();
foreach($rs as $r)
{
	echo '<li style="display:inline">'.$r.' '.'</li>';
}
}
?>
</ul>
</br>

<h3>Output of Bk Tree</h3>

<ul>
<?php
$arr=array("help","shel","smell","fell","felt","oops","pop","oouch","halt");
$bk=new Bktree(array_pop($arr));
$bk->build($arr);
$rsp = $bk->query('helt',2);
//print_r($rs);
foreach($rsp as $rs)
{
	foreach($rs as $r)
		echo '<li>'.$r.'</li>';
}
?>
</ul>


</body>

</html>