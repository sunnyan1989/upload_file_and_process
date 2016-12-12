<?php
// error_reporting(0);  
$file = fopen("track.txt", "r") or die("Unable to open file!");
$track_arr=array();
$i=0;
//read the track file line by line and store it in an array
while(! feof($file))
{
 $track_arr[$i]= fgets($file);//fgets() read one line of the file
 $i++;
}
fclose($file);
$track_arr=array_filter($track_arr);
//$json_string = json_encode($track_arr);
//file_put_contents('json\track.json', $json_string);
// foreach ($track_arr as $value) {
//   echo "$value <br>";
// }
//set an array to store the data like CompanyID => Times
$track_data = array();

$client = array();
$j=0;

foreach ($track_arr as $value) {
  $value_arr=explode(', ',$value);//explode the string by ', ' and get an array
 //  foreach ($value_arr as $attribute) {
 //  echo "$attribute <br>";
	// }
  $client_name = $value_arr[3];//get the companyID from the array
  $client[$j] = $client_name;
  $j++;
  //Calculate the value of the total number.
  if(!array_key_exists ( $client_name, $track_data)){// test whether this key exists in the array
  	$track_data[$client_name]=1;
  }else{
  	$track_data[$client_name]++;
  }

}
// $keys = array_keys($track_data);
// $desired_keys = $client;

// foreach($desired_keys as $desired_key){
//    if(in_array($desired_key, $keys)){

//    	continue;
//    }   // already set
//    $track_data[$desired_key] = '';
// }

foreach($track_data as $x=>$x_value) {
  echo "CompanyID=" . $x . ", Value=" . $x_value;
  echo "<br>";
}
return $track_data;
?>