<?php
    include("Autenticador.php");
    include("User.php");

    $usuario = new User;
    $jwt = new Autenticador;

    //Recebe dados do usuário
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $nameUser = $usuario->getNome();
    $emailUser = $usuario->getEmail();
    
    //Começa configuração do Token
    //Tipo de criptografia (primeira parte)
    $header = [
        'alg' => 'HS256',
        'typ' => 'JWT'
    ];

    $header = json_encode($header);
    $header = base64_encode($header);
    
    $jwt->setHeader($header);    
    $userHeader=$jwt->getHeader();
    
    //Corpo do Token(criptografa dados do usuário)
    $payload = [
        'iss' => 'localhost/Testeclass/',
        'user' => $nameUser,
        'sub' => $emailUser
    ];

    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $jwt->setPayload($payload);    
    $userPayload=$jwt->getPayload();
    
    //Última parte(Assinatura do Token)
    $signature = hash_hmac('sha256',"$header.$payload",'password',true);
    $signature = base64_encode($signature);

    $jwt->setSignature($signature);
    $userSignature=$jwt->getSignature();   
   
    
    
    //Teste de validação
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