<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if( !isset($_GET["q"]) ) exit('Error');

$q = $_GET["q"];

require 'connection.php';

function GetCollectionKeys($collection){

	$getkeys = $collection->findOne();

	if(empty($getkeys)){return;}
	
	foreach ($getkeys as $key => $value) {
		$CollectionKeys[] = $key;
	}	

	return $CollectionKeys;
}

function SearchTheCollection($q, $collection){
	
	$SearchResults = array();
	$CollectionKeys = GetCollectionKeys($collection);
	if(empty($CollectionKeys)){return;}

	foreach ($CollectionKeys as $key) {

		$where = array('$regex' => $q);
		$SearchMachine = $collection->find(array($key => $where));

		if($SearchMachine->count() == 0){
			$qup = ucfirst($q);
			$where = array('$regex' => $qup);
			$SearchMachine = $collection->find(array($key => $where));
		}
	
		

		foreach ($SearchMachine as $result) {
			
			if( !in_array( $result['_id'], $SearchResults ) ){

				$SearchResults[] = $result;
			}
		}
	}

	return $SearchResults;
}


$result = SearchTheCollection($q, $pessoas);
//$result = array_unique($result);
?>
<table class="table">
 <thead> 
 <tr> 
 <th>ID</th> 
 <th>Name</th> 
 <th>Email</th> 
 <th>City</th> 
 <th>Date of Register</th> 
 </tr> 
 </thead> 
 <tbody> 
 <tr> 
 <?php
if(!empty($result)):
foreach ($result as $item):

	foreach ($item as $key => $value):?>
		  <td><?php echo $value; ?></td>


	 <?php endforeach; ?>
 </tr> 
<?php endforeach;?> 
<?php endif; ?>
 </tbody>
 </table>