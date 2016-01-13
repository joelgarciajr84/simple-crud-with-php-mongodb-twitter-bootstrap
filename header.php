<?php
include "header.html";
require_once("connection.php");

$MenuLabelAndActions = array(
    'Create' => 'index.php'
    ,'Update' => 'update.php'
    , 'Delete' => 'delete.php'
    );
$Currenturl = 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
$UrlAction = end((explode('/', $Currenturl)));

if(empty($UrlAction)){
    $UrlAction = 'index.php';
}
?>
  <body>
	 <div align="center" class="well">
        <h2>Simple MongoDB CRUD using PHP</h2>

		<ul class="nav nav-pills">
        <?php foreach ($MenuLabelAndActions as $Label => $Action):?>

			<li <?php if($Action == $UrlAction){ echo "class='active'";}?>><a href="<?php echo $Action; ?>"><?php echo $Label; ?></a></li>
			<?php endforeach; ?>
            <li><input id="search" onkeyup="searchmongo(this.value)" placeholder="Type something to search" type="text"></li>
		</ul>
        <p>Results: <span id="results"></span></p>

	</div>