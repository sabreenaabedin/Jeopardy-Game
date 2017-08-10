<?php  session_start();
    if(isset($_POST['questiontype'])){
      $_SESSION['questiontype'] = $_POST['questiontype'];
      $_SESSION['masterquestion']= $_POST['masterquestion'];
    }
    if(isset($_POST['shortanswerquestion']))
        $_SESSION['shortanswerquestion']= $_POST['shortanswerquestion'];

    if(isset($_POST['qA'])){
      $_SESSION['qA'] = $_POST['qA'];
      $_SESSION['qB'] = $_POST['qB'];
      $_SESSION['qC'] = $_POST['qC'];
      $_SESSION['qD'] = $_POST['qD'];
      $_SESSION['answerchoice'] = $_POST['answerchoice'];
    }
    if(isset($_POST['trueorfalse']))
        $_SESSION['trueorfalse']= $_POST['trueorfalse'];
  ?>
<html>
    <head>
        <title>Simple form handler</title>
        <?php
        ?>

        <script language="JavaScript">
        function goBack() {
            window.history.back();
        }
        </script>
        <style>
        td {
          text-align:center;
        }
        </style>
    </head>

    <body style="background:grey">

    <center><h2 style="color:white">Simple Form Handler</h2></center>
    <p style="color:white">
        The following table lists all parameter names and their values that were submitted from your form.
    </p>
    <center>
    <table style="padding:10px;background:lightgray">
        <tr bgcolor="#FFFFFF">
            <td align="center"><strong>Parameter</strong></td>
            <td align="center"><strong>Value</strong></td>
</tr>
<tr>
    <td width="30%">Question Type</td>
    <td><?php echo $_SESSION['questiontype']?></td>
</tr>
<tr>
    <td width="30%">Question</td>
    <td><?php echo $_SESSION['masterquestion'] ?></td>
</tr>
<tr>
    <td width="30%">Short Answer</td>
    <td><?php echo $_SESSION['shortanswerquestion'] ?></td>
</tr>
<tr>
    <td width="30%">Multiple Choice A</td>
    <td><?php echo $_SESSION['qA'] ?></td>
</tr>
<tr>
    <td width="30%">Multiple Choice B</td>
    <td><?php echo $_SESSION['qB'] ?></td>
</tr>
<tr>
    <td width="30%">Multiple Choice C</td>
    <td><?php echo $_SESSION['qC'] ?></td>
</tr>
<tr>
    <td width="30%">Multiple Choice D</td>
    <td><?php echo $_SESSION['qD'] ?></td>
</tr>
<tr>
    <td width="30%">Multiple Choice Selection</td>
    <td><?php echo $_SESSION['answerchoice'] ?></td>
</tr>
<tr>
    <td width="30%">True/False Selection</td>
    <td><?php
      if(!empty($_SESSION['trueorfalse'])){
        echo $_SESSION['trueorfalse'];
      }
        ?></td>
</tr>

<?php
// retrieve data from the form submission
if(isset($_POST['Confirm'])){
$answers = extract_data();
$final = "";

foreach($answers as $key => $value) {
if(!empty($value))
 $final = (string) $final . (string) $key . ": ". (string) $value . ", ";
}
$final = (string) $final . ";";

# specify a path, using a file system, not a URL
# [server]    /cslab/home/<em>your-username</em>/public_html/<em>your-project</em>/data/filename.txt
# [local]     /XAMPP/htdocs/<em>your-project</em>/data/filename.txt
$filename = "C:\\xampp\htdocs\CS4640\Jeopardy\\test-data.txt";
//write_to_file($filename, $final);
confirmInput($filename, $final);
}
?>

</table>
</center>
</br>

<form action="formHandler.php" method="post">
  <center> <button onClick="goBack()"> Edit </button>
  <input type="submit" name="Confirm" value = "Confirm"></center>
</form>
</body>
</html>

<?php

function confirmInput($filename, $final) {
  echo "confirmInput is running";
    write_to_file($filename, $final);
}

function extract_data() {
    $data = array();
    foreach ($_SESSION as $key => $val) {
        $data[$key] = $val;      // record all form data to an array
    }

    reset($data);
    while ($curr = each($data)) {
        $k = $curr["key"];
        $v = $curr["value"];
    }
    return($data);
}

function write_to_file($filename, $final) {
    $file = fopen($filename, "a");      // if the file doesn't exist, create a new file
    if (!file_exists($filename))
       echo "File does not exist";
    else
       echo "File exists";
    chmod($filename, 0775);             // set permission.
    // Note: consider chmod 755 here but 777 when manually creating a file
    //    who is the owner?
    fputs($file, $final);
    fclose($file);
}
?>
