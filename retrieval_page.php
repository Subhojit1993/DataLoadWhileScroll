<?php
include('db_set.php');
$page = (int) (!isset($_GET['p'])) ? 1 : $_GET['p'];

$sql = "SELECT * FROM subhojits_poems ORDER BY id DESC";

$start = ($page * $limit) - $limit;

if( mysql_num_rows(mysql_query($sql)) > ($page * $limit) ){
	$next = ++$page;
}
$query = mysql_query( $sql . " LIMIT {$start}, {$limit}");
if (mysql_num_rows($query) < 1) {
	header('HTTP/1.0 404 Not Found');
	echo 'Page not found!';
	exit();
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>| Data load while scroll |</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ias.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        	
            jQuery.ias({
                container : '.wrap', 
                item: '.item', 
                pagination: '.nav', 
                next: '.nav a', 
                loader: '<img src="css/ajax-loader.gif"/>', 
                triggerPageThreshold: 20 // it will show load more if scroll more than this - subhojit
            });
        });
    </script>
</head>
<body>

<div class="wrap">
	<h1><a href="#">Lines Written by Subhojit</a></h1>

	<!-- loop row data -->
	<?php while ($row = mysql_fetch_array($query)): ?>
    <div class="item" id="item-<?php echo $row['id']?>">
    <h2><span class="num"><?php echo $row['id']?></span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <span class="name"><?php echo $row['poemname'] ?></span>
    </h2>
    <div class="form-profilebg">
    
		<div class="profile">
                <img src="upload/<?php echo $row['photos'] ?>" height="15%" width="100%" id="subho" />
            </div>     
        </div>
	
        
		<h2>
			
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="name"><?php echo $row['genre']?></span>
		</h2>
		<?php echo $row['lines_info']?>
	</div>
	<?php endwhile?>

	<!--page navigation-->
	<?php if (isset($next)): ?>
	<div class="nav">
		<a href='retrieval_page.php?p=<?php echo $next?>'>Next</a>
	</div>
	<?php endif?>
</div><!--.wrap-->

</body>
</html>