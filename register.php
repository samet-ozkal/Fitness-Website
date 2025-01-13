<?php 
session_start();
include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);
    $oolc=$_POST['oolc'];
    $golc=$_POST['golc'];
    $kolc=$_POST['kolc'];
    $bolc=$_POST['bolc'];
    $baolc=$_POST['baolc'];
    

    $checkEmail="SELECT * FROM users WHERE email='$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows > 0){
        echo "Email Address Already Exists !";
    }
    else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password,oolc,golc,kolc,bolc,baolc, date) VALUES ('$firstName','$lastName','$email','$password','$oolc','$golc','$kolc','$bolc','$baolc', NOW())";
        if($conn->query($insertQuery) == TRUE){
            
            header("location: login.html"); // Ana sayfaya yönlendir
        }
        if (!$query) {
            echo "Error: " . mysqli_error($conn);
        }
        
    }
}

if(isset($_POST['signIn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);
   
    $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows > 0){
        $_SESSION['email'] = $email; // Oturumu başlat
        header("Location: index.php"); // Ana sayfaya yönlendir
        exit();
    }
    else{
        echo "Not Found, Incorrect Email or Password";
    }
}
?>
