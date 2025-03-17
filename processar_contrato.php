<?php  
// Definir as variáveis de e-mail  
$to = "seu_email@example.com"; // Seu e-mail  
$fromName = $_POST['nome'];  
$emailCliente = $_POST['email'];  
$subject = "Novo Contrato Assinado por " . $fromName;  

// Obter a informação do arquivo enviado  
$foto = $_FILES['foto'];  

// Lidar com o upload do arquivo  
$uploadDir = 'uploads/';  
$uploadFile = $uploadDir . basename($foto['name']);  

// Criar o diretório se não existir  
if (!is_dir($uploadDir)) {  
    mkdir($uploadDir, 0755, true);  
}  

// Mover o arquivo para o diretório de uploads  
if (move_uploaded_file($foto['tmp_name'], $uploadFile)) {  
    $message = "O cliente " . $fromName . " assinou o contrato e enviou uma foto da assinatura.\n\n";  
    $message .= "Nome: " . $fromName . "\n";  
    $message .= "Email: " . $emailCliente . "\n";  
    $message .= "Foto da assinatura: " . $uploadFile . "\n";  

    // Cabeçalhos para o e-mail  
    $headers = "From: $fromName <$emailCliente>\r\n";  
    $headers .= "Reply-To: $emailCliente\r\n";  
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";  

    // Enviar e-mail para você  
    if (mail($to, $subject, $message, $headers)) {  
        echo "Contrato enviado com sucesso para você!";  
        
        // Enviar cópia para o cliente  
        $clientSubject = "Recebemos sua assinatura";  
        $clientMessage = "Caro " . $fromName . ",\n\nObrigado por assinar o contrato.\n\n";  
        $clientMessage .= "Você pode visualizar sua assinatura aqui: " . $uploadFile . "\n\n";  
        $clientMessage .= "Atenciosamente,\nSua Empresa";  

        mail($emailCliente, $clientSubject, $clientMessage, "From: Seu Nome <seu_email@example.com>");  
    } else {  
        echo "Ocorreu um erro ao enviar o contrato.";  
    }  
} else {  
    echo "Erro ao enviar a foto da assinatura.";  
}  
?>  