<?php
   // Array with names
   //$a[] = "Android";
   $a[] = "Abigail";
   $a[] = "Venessa";
   $a[] = "Monique";
   $a[] = "Onaje";
   $a[] = "Tyshorna";

   
   $q = $_REQUEST["q"];
   $hint = "";
   
   if ($q !== "") {
      $q = strtolower($q);
      $len = strlen($q);
      
      foreach($a as $name) {
		
         if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
               $hint = $name;
            }else {
               $hint .= ", $name";
            }
         }
      }
   }
   echo $hint === "" ? "Please enter a valid Tutor/Instructor" : $hint;
?>