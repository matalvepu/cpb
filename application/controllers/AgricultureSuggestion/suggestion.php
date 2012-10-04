<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suggestion extends CI_Controller
{

 public function index()
 {
      //echo date("Y-m-d");

     $later7days = date("Y-m-d",time()+7*24*3600);
     $earlier7days = date("Y-m-d",time()-7*24*3600);

     //Taking Current Date
      $year = date("Y");
      $month = date("m");
      $date = date("d");

      echo "$later7days -> $earlier7days : $year - $month - $date";

      
 }
}
?>

