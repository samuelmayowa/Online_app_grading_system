<?php
function password_generate($chars) 
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
  return substr(str_shuffle($data), 0, $chars);
}
  echo password_generate(7)."<br />";
   $x=0;
   while($x<=1000){
       echo password_generate(7)."<br />";
       $x++;
       
   }
   
?>