<?php
if (($_FILES["file"]["type"] == "text/plain")
&& ($_FILES["file"]["size"] < 20000000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	$name = "track.txt";
	}
	move_uploaded_file($_FILES["file"]["tmp_name"],
      "" . $name);
      echo "Stored in: " . "" . $name;
      echo "<br>";
      echo "<br>";
  }
else
  {
  echo "Invalid file";
  }
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
$month_data = array();
$track_data = array();
$track_by_month = array();
foreach ($track_arr as $value) {
  $value_arr=explode(', ',$value);//explode the string by ', ' and get an array
  $client_date = $value_arr[0];
  $client_month = substr($client_date,0,7);
  $client_name = $value_arr[3];//get the companyID from the array  
  // array_push($month_data,$client_name);
  // $track_by_month[$client_month]=$month_data;
  $track_by_month[$client_month][]=$client_name;
}
//set an array to store the data like CompanyID => Times
function calculate_data($a){
    $result = array();
    foreach($a as $val){
      if(!array_key_exists($val, $result)){// test whether this key exists in the array
      $result[$val]=1;
      }else{
      $result[$val]++;
      }
    }
    return $result;
}

foreach($track_by_month as $x=>$x_value){
  $track_data[$x] = calculate_data($x_value);
}
// for($k=0;$k<count($track_by_month);$k++){
//   $track_data[$k] = calculate_data($track_by_month[$k]);
// }
foreach($track_data as $x=>$x_value) {
  echo "Month: " . $x;
  echo "<br>";
  foreach($x_value as $companyID=>$count){
    echo "CompanyID:" . $companyID . ", Value=" . $count;
    echo "<br>";
  }
  echo "<br>";
}
return $track_data;
?>