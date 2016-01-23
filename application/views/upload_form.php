<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('Payrecord/inputXLS');?>
<form>
<input type="file" name="file" size="20" enctype="multipart/form-data" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>

