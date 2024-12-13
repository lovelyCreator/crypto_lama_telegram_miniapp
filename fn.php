<?php
function n($n) {
  return number_format($n, 4, '.', '');
}
function convert_seconds($seconds) 
 {
  $dt1 = new DateTime("@0");
  $dt2 = new DateTime("@$seconds");
  return $dt1->diff($dt2)->format('%a Days - %h:%i:%s');
  }