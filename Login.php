<?php
    include("Autenticador.php");
    include("User.php");

    $usuario = new User;
    $jwt = new Autenticador;
    
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $nameUser = $usuario->getNome();
    $emailUser = $usuario->getEmail();
    
    $header = [
        'alg' => 'HS256',
        'typ' => 'JWT'
    ];

    $header = json_encode($header);
    $header = base64_encode($header);
    
    $jwt->setHeader($header);    
    $userHeader=$jwt->getHeader();
    
    $payload = [
        'iss' => 'localhost/Testeclass/',
        'user' => $nameUser,
        'sub' => $emailUser
    ];

    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $jwt->setPayload($payload);    
    $userPayload=$jwt->getPayload();
    
    
    $signature = hash_hmac('sha256',"$header.$payload",'password',true);
    $signature = base64_encode($signature);

    $jwt->setSignature($signature);
    $userSignature=$jwt->getSignature();   
   
    
    /*echo "$userHeader";
    echo "$userPayload";
    echo "$userSignature";
    */
    $valid = hash_hmac('sha256',"$userHeader.$userPayload",'password',true);
    $valid = base64_encode($valid);
    
    if($userSignature == $valid){
        echo "valid";
        echo "<br>";
        echo $userHeader,".",$userPayload,".",$userSignature;
        echo "<br>";
    }else{
        echo 'invalid';
        echo "<br>";
        echo $userHeader,".",$userPayload,".",$userSignature;
     }
     
?>