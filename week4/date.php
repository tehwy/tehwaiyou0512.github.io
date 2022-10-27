<!DOCTYPE html>
<html>

<head>

    <title>Week3_Homework2</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>
 
<div class="text-center m-5">
    <h1>What is your date of birth?</h1>
</div>
<div class="d-flex justify-content-evenly">
    
<div class="btn-group col-2">
<select class="form-select bg-info" aria-label="Default select example">
  
  <?php
    for ($num = 1; $num <= 31; $num++) {
        $date=date('d',strtotime("last day of -$num date"));
        echo "<option value=$num>$num</option> ";
      } 
       ?>
</select>
</div>

<div class="btn-group col-2">
<select class="form-select bg-warning" aria-label="Default select example">

  <?php

   $month = array("January", "February", "March", "April", "May", "June", "Jully", "August", "September", "October", "November", "December");
    for ($num = 0; $num <= 11; $num++) {
        $month=date('F',strtotime("first day of -$num month"));
        echo "<option value=$month>$month</option> ";
      } 
       ?>
</select>
</div>

<div class="btn-group col-2">
<select class="form-select bg-danger" aria-label="Default select example">
  
  <?php
    for($i=0;$i<=1900;$i--){
        $year=date('Y',strtotime("last day of +$i year"));
        echo "<option name='$year'>$year</option>";
        } 
       ?>
</select>
</div>

</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>