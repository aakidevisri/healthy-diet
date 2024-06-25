<?php
if(isset($_POST['insert']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    $connect=mysqli_connect("localhost","root","Koushik@0617", "contact"); 
    $query="insert into 'users' ('name','email','message') values ('$name','$email','$message')";
    $result=mysqli_query($connect,$query);
    if($result)
    {
        echo "<script>alert('$name, Your message has been sent successfully')</script>";
    }
    else
    {
        die("<h3 style='color:red;'>Error in sending your Message</h3>");
    }
}
?>