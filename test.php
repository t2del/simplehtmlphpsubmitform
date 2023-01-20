<?php
$site = 'The variable site is empty';
//$field1 = '';
$disable = '';
$notice = '<p>Submitted Succesfuly</p>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $field1 = $_POST['field1'];
    $field2 = $_POST['field2'];
    //$spam_check = $_POST['spam_check'];
    if( strpos(file_get_contents("./text.txt"), $field1) !== false) {
        // text already exist
        //echo '// text already exist';
        $notice .= '<p>Text already exist in the file</p>';
    } else {
        // text do not exist
        // then add $field1 to the text file
        $myfile = fopen("text.txt", "a") or die("Unable to open file!");
        fwrite($myfile, "\n". $field1);
        fclose($myfile);
        //echo '// text do not exist';
        $notice .= '<p>Text added to the file successfuly</p>';
    }
}
if(isset($_GET['site'])) {
    $site = $_GET['site'];
}

if(!isset($_GET['site'])) {
    $disable = 'disabled';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
            <div class="notice"><?=$notice?></div>
        <?php } else { ?>
        <form role="form" id="form" method="post" action="">
            <div class="form-group has-feedback">
                <label class="sr-only" for="field1">Field 1</label>
                <input type="hidden" class="form-control disable disabled" id="field1" name="field1" placeholder="Field 1"  required value="<?=$site?>" >
                <div class="pseudo-text"><?=$site?></div>
                <i class="fa fa-user form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback">
                <label class="sr-only" for="message2">Feedback: (optional)</label>
                <textarea class="form-control" rows="8" id="field2" name="field2" placeholder="Feedback: (optional)" ></textarea>
                <i class="fa fa-pencil form-control-feedback"></i>
            </div>

            <div class="form-group has-feedback">                
                <input type="checkbox" id="spam_check" name="spam_check[]" value="spam"><label class="sr-only" for="checkbox"> Report as spam</label>
                <i class="fa fa-pencil form-control-feedback"></i>
            </div>

            <input type="submit" value="Send" class="btn btn-default" <?=$disable?>>
        </form>
        <?php } ?>
    </div>
</body>
</html>