<!DOCTYPE html>
<html lang = "en">
    <body>
        <form method ="post" action ="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
            <input type = "file" name = "upload" id = "upload">
            <input type = "submit" name = "submit" id = "submit">
        </form>
    </body>
</html>
<?php
class MyClass
{
    /**
     * [myFunction description]
     * @return [type] [description]
     */
    public function myFunction()
    {
        if (isset($_POST["submit"])) {
            //the uploaded file directory.
            $fileDirectory  = "Exception/";
            //this variable for getting uploaded file name.
            $fileTarget     = basename($_FILES["upload"]["name"]);
            //this variable for uploaded file path with file name.
            $filePath       = $fileDirectory.basename($_FILES["upload"]["name"]);
            //this variable for getting uploaded file extension.
            $extension      = pathinfo($fileTarget, PATHINFO_EXTENSION);
            //this varialble for getting uploaded file type.
            $check          = $_FILES["upload"]["type"];
            //check the uploaded file format. if the file is "jpeg" format means the file uploaded into directory.
            if ($extension == "jpg") {
                //this function for uploaded file into exact directory with file name.
                move_uploaded_file($_FILES["upload"]["tmp_name"], $fileDirectory.$fileTarget);
                echo "file uploaded";
            } else {
                echo "file not in jpeg format";
            }
        }
    }
}
//create object.
$obj = new MyClass();
//call function using object.
$obj -> myFunction();
