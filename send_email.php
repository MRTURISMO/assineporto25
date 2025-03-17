<?php  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Captura os dados do formulário  
    $nome = $_POST['nome'];  
    $cpf = $_POST['cpf'];  
    $endereco = $_POST['endereco'];  
    $email = $_POST['email'];  
    $whatsapp = $_POST['whatsapp'];  
    $nome_passageiro = $_POST['nome_passageiro'];  
    $pacote = $_POST['pacote'];  
    $pagamento = $_POST['pagamento'];  
    $signature = $_POST['signature'];  

    // E-mails  
    $to_client = $email; // E-mail do cliente  
    $to_admin1 = 'contato@mrturismobsb.com.br'; // Primeiro e-mail de contato  
    $to_admin2 = 'mruanfelipe10@gmail.com'; // Segundo e-mail de contato  

    // Assunto e mensagem  
    $subject = 'Contrato Preenchido';  
    $message = "  
    Nome do Contratante: $nome\n  
    CPF: $cpf\n  
    Endereço: $endereco\n  
    E-mail: $email\n  
    WhatsApp: $whatsapp\n  
    Nome Completo do Passageiro: $nome_passageiro\n  
    Pacote Selecionado: $pacote\n  
    Forma de Pagamento: $pagamento\n  
    Assinatura: $signature\n  
    ";  

    $headers = "From: $to_admin1 \r\n";  
    $headers .= "Reply-To: $to_admin1 \r\n";  

    // Envio do e-mail para o cliente  
    mail($to_client, 'Cópia do seu Contrato', $message, $headers);  

    // Envio do e-mail para o primeiro administrador  
    mail($to_admin1, $subject, $message, $headers);  
    
    // Envio do e-mail para o segundo administrador  
    mail($to_admin2, $subject, $message, $headers);  

    // Redireciona para uma página de confirmação ou exibe uma mensagem  
    echo 'Contrato enviado com sucesso!';  
}  
?>  