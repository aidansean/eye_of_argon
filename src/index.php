<?php
// Connect to database
include_once('mysql.php') ;
$mySQL_connection = mysql_connect('localhost', $mysql_username, $mysql_password) or die('Could not connect: ' . mysql_error()) ;
mysql_select_db($mysql_database) or die('Could not select database') ;

$title = 'Eye of Argon acronymer' ;
$stylesheets = array('style.css') ;
include_once($_SERVER['FILE_PREFIX'] . '/_core/preamble.php') ;
?>

<div class="right">
<h3>What is this?</h3>
<p>This page takes the whole text of The Eye of Argon and compiles a list of words (which have more than three letters.)  It then generates an acronym based on the input string you provide.  It's not intelligent enough to work out what is a noun, verb or adjective, but then again it makes about as much sense as the original text.</p>

<h3>Make your own acronym</h3>
<form action="index.php" method="post">
<p class="center">Acronym: <input type="text" name="acronym" value="<?php echo strtoupper($_POST['acronym']) ; ?>"/>
<input type="submit" class="submit" value="Query bustily?"/></p>
</form>

<p id="acronym">
<?php

$wordListSource = file_get_contents('eye_of_argon_wordlist.txt') ;
$words = explode(PHP_EOL,$wordListSource) ;
if(isset($_POST['acronym'])){
  $acronym_in = strtoupper($_POST['acronym']) ;
  $acronym = '' ;
  for($i=0 ; $i<strlen($acronym_in) ; $i++){
    if(preg_match('/[A-Z]/',substr($acronym_in,$i,1))) $acronym = $acronym . substr($acronym_in,$i,1) ;
  }
  $acronym = mysql_real_escape_string($acronym) ;
  echo $acronym , ' : ' ;
  $text = '' ;
  for($i=0 ; $i<strlen($acronym) ; $i++){
    $letter = strtolower(substr($acronym,$i,1)) ;
    $match = ($letter=='x') ? 1 : 0 ;
    $counter = 0 ;
    while($counter<10000){
      $counter++ ;
      $r = rand(0,count($words)-1) ;
      if(substr($words[$r],$match,1)==strtolower($letter)){
        $text = $text . ucfirst($words[$r]) . ' ' ;
        $counter = 10000 ;
      }
    }
  }
  echo $text ;
  $text = mysql_real_escape_string($text) ;
  $query = 'INSERT INTO ' .  $mysql_prefix . 'eye_of_argon_acronym (acronym,text) VALUES ("' . $acronym . '","' . $text . '")' ;
  mysql_query($query) ;
}
?>
</p>

<h3>Others' undulations</h3>
<table><tbody>
<?php
$query = 'SELECT * FROM ' .  $mysql_prefix . 'eye_of_argon_acronym ORDER BY edited DESC LIMIT 50' ;
$result = mysql_query($query) ;
while($row=mysql_fetch_assoc($result)){
  if($row['acronym']!='') echo '<tr><th>' , $row['acronym'] , '</th><td>' , $row['text'] , '</td></tr>' , PHP_EOL ;
}
echo '</tbody></table>' ;

?>
</div>

<?php foot() ; ?>