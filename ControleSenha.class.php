<?php
include_once "Usuario.class.php";
include_once "./BD/MySQL.class.php";


class ControleSenha{

public function recuperarSenha($usuario){
  $conexao = new MySQL();
  $sql = "select * from usuarios where email='".$usuario->getEmail()."'";
  $resultado = $conexao->consulta($sql);
  //print_r ($resultado);

  if($resultado){
    $nome = $resultado[0]['nome'];
    $login = $resultado[0]['nome_log'];
    $email = $resultado[0]['email'];
    $senha = $resultado[0]['senha'];
    $data_envio = date('d/m/Y');
    // $array_emails= array('lrgobatto@gmail.com','weiss.muri@gmail.com', 'hennig.alecsander@gmail.com', 'ferzanutto1999@gmail.com');


    // Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
    require("mailer/PHPMailerAutoload.php");
    //require("mailer/class.smtp.php");

    // Inicia a classe PHPMailer
    $mail = new PHPMailer();

    // Define os dados do servidor e tipo de conexão
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
    $mail->Port = 465;
    $mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
    $mail->Username = 'suporte.stayaware@gmail.com'; // endereço de email
    $mail->Password = 'ericbonito'; // Senha  do email usado
    $mail->SMTPDebug = 2;
    // Define o remetente
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = "suporte.stayaware@gmail.com"; // Seu e-mail
    $mail->FromName = "Fique Esperto";

    // Define os destinatário(s)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

    $mail->AddBCC($email);

    // Define os dados técnicos da Mensagem
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

    // Define a mensagem (Texto e Assunto)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject  = "Recuperação de Senha"; // Assunto da mensagem
    $mail->Body = "Olá $login!<br><br>Segue a sua senha: ".$senha."<br><br>Este e-mail foi enviado em ".$data_envio.".<br><br>Se você não reconhece este email, ignore!";


    // Envia o e-mail
    // Exibe uma mensagem de resultado
    if ($mail->send()) {
      echo"
      <SCRIPT>alert('E-mail enviado, verifique sua caixa de entrada!');
      window.location.href='index.php';
      </script>
      ";

    }
    else{
      echo "Não foi possível enviar o e-mail.

      ";
      echo "Informações do erro:
        " . $mail->ErrorInfo;
        //header ("location: formSenha.php");

    }
  }else{
    echo"
    <SCRIPT>alert('E-mail não encontrado!');
    window.location.href='formSenha.php';
    </script>
    ";
  }
}
}
?>
