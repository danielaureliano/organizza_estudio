<?php   
    if (!empty($_POST )) {
        require 'database.php';
        
        // rastreamento dos erros de validação
        $NomeError = null;
        $EnderecoError = null;
        $EmailError = null;
        $telefoneError = null;
        $dtNascimento = null;
        $CpfCnpjError = null;

        $CpfCnpj = null;
        $Nome = null;
        $RazaoSocial = null;
        $InscricaoEstadual = null;
        $Cep = null;
        $Endereco = null;
        $EnderecoNumero = null;
        $Uf = null;
        $Cidade = null;
        $Bairro = null;
        $Telefone = null;
        $Celular = null;
        $Email = null;
        $DataNascimento = null;
        $StatusAtivo = null;
        $CdTipoUsuario = null;
        $NomeUsuario = null;
        $Senha = null;
        $DataCriacao = null;


        
        
        // rastreamento dos valores enviados via POST

        if(isset($_POST['CpfCnpj'])){$CpfCnpj = $_POST['CpfCnpj'];}
        if(isset($_POST['Nome'])){$nome = $_POST['Nome'];}
        if(isset($_POST['RazaoSocial'])){$RazaoSocial = $_POST['RazaoSocial'];}
        if(isset($_POST['InscricaoEstadual'])){$InscricaoEstadual = $_POST['InscricaoEstadual'];}
        if(isset($_POST['Cep'])){$Cep = $_POST['Cep'];}   
        if(isset($_POST['Endereco'])){$Endereco = $_POST['Endereco'];}
        if(isset($_POST['EnderecoNumero'])){$EnderecoNumero = $_POST['EnderecoNumero'];} 
        if(isset($_POST['Uf'])){$Uf = $_POST['Uf'];}
        if(isset($_POST['Email'])){$email = $_POST['Email'];}
        if(isset($_POST['Cidade'])){$Cidade = $_POST['Cidade'];}
        if(isset($_POST['Bairro'])){$Bairro = $_POST['Bairro'];}
        if(isset($_POST['Telefone'])){$Telefone = $_POST['Telefone'];}
        if(isset($_POST['Celular'])){$Celular = $_POST['Celular'];}
        if(isset($_POST['Email'])){$Email = $_POST['Email'];}
        if(isset($_POST['DataNascimento'])){$DataNascimento = $_POST['DataNascimento'];}
        if(isset($_POST['StatusAtivo'])){$StatusAtivo = $_POST['StatusAtivo'];}
        
        // validação dos inputs
        $valid = true;
        if (empty ( $Nome )) {
            $NomeErrore = 'Favor digitar o nome';
            $valid = false;
        }
        
        $valid = true;
        if (empty ( $Endereco )) {
            $EnderecoError = 'Favor digitar o endereço';
            $valid = false;
        }       
        
        $valid = true;
        if (empty ( $Email )) {
            $EmailError = 'Favor digitar o endereço de email';
            $valid = false;
        } else if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
            $emailError = 'Favor digitar um endereço de email válido';
            $valid = false;
        }
        
        $valid = true;
        if (empty ( $Telefone )) {
            $TelefoneError = 'Favor digitar o telefone';
            $valid = false;
        }
        
        $valid = true;
        if (empty ( $dtNascimento )) {
            $dtNascimentoError = 'Favor digitar a data de nascimento';
            $valid = false;
        }
        $valid = true;
        if (empty ( $CpfCnpj )) {
            $CpfCnpjfError = 'Favor digitar o CPF/CNPJ';
            $valid = false;
        }
        
        // insert data
        
        if ($valid) {           
            $pdo = Database::conectar();
            $pdo->setAttribute ( PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE );
            $sql = "INSERT INTO usuario (CdTipoUsuario, NomeUsuario, Email, Senha, DataCriacao, StatusAtivo) VALUES (3,?,?,?,current_timestamp,1)";
            $q = $pdo->prepare($sql);
            $q->execute(array($CdTipoUsuario,$NomeUsuario,$Email,$Senha,$DataCriacao,$StatusAtivo));
            $q->execute()
            $sql = "INSERT INTO organizzaestudio.`cliente` (CdUsuario, CpfCnpj, Nome, RazaoSocial, InscricaoEstadual, Cep, Endereco, EnderecoNumero, Uf, Cidade, Bairro, Telefone, Celular, Email, DataNascimento) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare ( $sql );
            $q->execute ( array($CpfCnpj,$Nome,$RazaoSocial,$InscricaoEstadual,$Cep,$Endereco,$EnderecoNumero,$Uf,$Cidade,$Bairro,$Telefone,$Celular,$Email,$DataNascimento,$StatusAtivo));
            Database::disconnect ();
            print "<script>location.href='clientes.php';</script>";
            //header ( "Location: clientes.php" );
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">

    <title>Organiza Estúdio</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script type="text/javascript" src="js/jquery.mask.min.js"/></script>

    <!-- Adicionando JQuery -->
    <script; src="https://code.jquery.com/jquery-3.2.1.min.js";
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=";
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>

    <script type="text/javascript">
        function formatar(src, mask,e) 
{
    var tecla ="";
    if (document.all) // Internet Explorer
        tecla = event.keyCode;
    else
        tecla = e.which;
    //code = evente.keyCode;
    if(tecla != 8){


    if (src.value.length == src.maxlength){
    return;
    }
  var i = src.value.length;
  var saida = mask.substring(0,1);
  var texto = mask.substring(i);
  if (texto.substring(0,1) != saida) 
  {
    src.value += texto.substring(0,1);
  }
      }
}
    </script>

<script LANGUAGE="Javascript">
<!--
//Aplica a máscara no campo
//Função para ser utilizada nos eventos do input para formatação dinâmica
function aplica_mascara_cpfcnpj(campo,tammax,teclapres) {
    var tecla = teclapres.keyCode;

    if ((tecla < 48 || tecla > 57) && (tecla < 96 || tecla > 105) && tecla != 46 && tecla != 8) {
        return false;
    }

    var vr = campo.value;
    vr = vr.replace( /\//g, "" );
    vr = vr.replace( /-/g, "" );
    vr = vr.replace( /\./g, "" );
    var tam = vr.length;

    if ( tam <= 2 ) {
        campo.value = vr;
    }
    if ( (tam > 2) && (tam <= 5) ) {
        campo.value = vr.substr( 0, tam - 2 ) + '-' + vr.substr( tam - 2, tam );
    }
    if ( (tam >= 6) && (tam <= 8) ) {
        campo.value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
    }
    if ( (tam >= 9) && (tam <= 11) ) {
        campo.value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
    }
    if ( (tam == 12) ) {
        campo.value = vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
    }
    if ( (tam > 12) && (tam <= 14) ) {
        campo.value = vr.substr( 0, tam - 12 ) + '.' + vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
    }
};

//Verifica se CPF ou CGC e encaminha para a devida função, no caso do cpf/cgc estar digitado sem mascara
function verifica_cpf_cnpj(cpf_cnpj) {
    if (cpf_cnpj.length == 11) {
        return(verifica_cpf(cpf_cnpj));
    } else if (cpf_cnpj.length == 14) {
        return(verifica_cnpj(cpf_cnpj));
    } else { 
        return false;
    }
    return true;
}

//Verifica se o número de CPF informado é válido
function verifica_cpf(sequencia) {
    if ( Procura_Str(1,sequencia,'00000000000,11111111111,22222222222,33333333333,44444444444,55555555555,66666666666,77777777777,88888888888,99999999999,00000000191,19100000000') > 0 ) {
        return false;
    }
    seq = sequencia;
    soma = 0;
    multiplicador = 2;
    for (f = seq.length - 3;f >= 0;f--) {
        soma += seq.substring(f,f + 1) * multiplicador;
        multiplicador++;
    }
    resto = soma % 11;
    if (resto == 1 || resto == 0) {
        digito = 0;
    } else {
        digito = 11 - resto;
    }
    if (digito != seq.substring(seq.length - 2,seq.length - 1)) {
        return false;
    }
    soma = 0;
    multiplicador = 2;
    for (f = seq.length - 2;f >= 0;f--) {
        soma += seq.substring(f,f + 1) * multiplicador;
        multiplicador++;
    }
    resto = soma % 11;
    if (resto == 1 || resto == 0) {
        digito = 0;
    } else {
        digito = 11 - resto;
    }
    if (digito != seq.substring(seq.length - 1,seq.length)) {
        return false;
    }
    return true;
}

//Verifica se o número de CNPJ informado é válido
function verifica_cnpj(sequencia) {
    seq = sequencia;
    soma = 0;
    multiplicador = 2;
    for (f = seq.length - 3;f >= 0;f-- ) {
        soma += seq.substring(f,f + 1) * multiplicador;
        if ( multiplicador < 9 ) {
            multiplicador++;
        } else {
            multiplicador = 2;
        }
    }
    resto = soma % 11;
    if (resto == 1 || resto == 0) {
        digito = 0;
    } else {
        digito = 11 - resto;
    }
    if (digito != seq.substring(seq.length - 2,seq.length - 1)) {
        return false;
    }

    soma = 0;
    multiplicador = 2;
    for (f = seq.length - 2;f >= 0;f--) {
        soma += seq.substring(f,f + 1) * multiplicador;
        if (multiplicador < 9) {
            multiplicador++;
        } else {
            multiplicador = 2;
        }
    }
    resto = soma % 11;
    if (resto == 1 || resto == 0) {
        digito = 0;
    } else {
        digito = 11 - resto;
    }
    if (digito != seq.substring(seq.length - 1,seq.length)) {
        return false;
    }
    return true;
}

//Procura uma string dentro de outra string
function Procura_Str(param0,param1,param2) {
    for (a = param0 - 1;a < param1.length;a++) {
        for (b = 1;b < param1.length;b++) {
            if (param2 == param1.substring(b - 1,b + param2.length - 1)) {
                return a;
            }
        }
    }
    return 0;
}

//Retira a máscara do valor de cpf_cnpj
function retira_mascara(cpf_cnpj) {
    return cpf_cnpj.replace(/\./g,'').replace(/-/g,'').replace(/\//g,'')
}
</script>    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><i class="fa fa-camera-retro"></i>Organizza Estúdio</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                  <!--   <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                   <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>-->
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Completo</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Completo (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Completo</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Completo</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Completo</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Completo (atenção)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Completo</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Completo (atenção)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> Novo ALerta
                                    <span class="pull-right text-muted small">5 minutos atrás</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-user fa-fw"></i> 3 Novo Usuário
                                    <span class="pull-right text-muted small">20 minutos atrás</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-shopping-cart"></i> Novo Serviço
                                    <span class="pull-right text-muted small">40 minutos atrás</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> Novo Evento
                                    <span class="pull-right text-muted small">1 dia atrás</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Upload de Arquivos
                                    <span class="pull-right text-muted small">1 dia atrás</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Ver mais Alertas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Administrador</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuações</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Pesquisar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Área Administrativa</a>
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i>Agenda</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Contratos</a>
                        </li>
                        <li>
                                <a href="forms.html"><i class="fa fa-shopping-cart"></i> Serviços</a>
                            </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Gerenciar Cadastros<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="cadastro-cliente.html">Cadastro de Clientes</a>
                                </li>
                                <li>
                                    <a href="funcionarios.html">Cadastro de Funcionários</a>
                                </li>
                                <li>
                                    <a href="servicos.html">Cadastro de Serviços</a>
                                </li>
                                <li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                     
                    </ul>
                    
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

       <!-- <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Visão Geral</h1>
                </div>
                
            </div>
           
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">10</div>
                                    <div>Lembretes!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">5</div>
                                    <div>Contratos!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">10</div>
                                    <div>Serviços!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">8</div>
                                    <div>Alertas</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            </div>-->
        </nav>
---
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cadastro de Clientes</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        <!-- /#page-wrapper -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Informações Pessoais
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="cad_cliente.php" method="post" autocomplete="on">
                                    <form method="get" action="." role="form">
                                        <div class="form-group col-xs-5">
                                            <label>CPF/CNPJ:</label>
                                            <input name="CpfCnpj" class="form-control" type="tel" placeholder="Só números" required="required" id="cpf-cnpj" name="cpf-cnpj" onkeydown="return aplica_mascara_cpfcnpj(this,18,event)" onkeyup="return aplica_mascara_cpfcnpj(this,18,event)">
                                        </div>
                                        <div class="form-group col-xs-5">
                                            <label>Ins.Estadual</label>
                                            <input name="InscricaoEstadual" class="form-control" type="tel" placeholder="Só números" maxlength="13">
                                        </div>
                                       <div class="form-group">
                                            </br></br></br></br><label class="control-label">Nome</label>
                                            <input name="Nome" class="form-control" placeholder="Nome Completo ou Nome Fantasia" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Razão Social</label>
                                            <input name="RazaoSocial" class="form-control" placeholder="Razão Social">
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label>CEP</label>
                                            <input name="Cep" id="cep" size="10" value="" class="form-control" type="tel" placeholder="71.100-000" maxlength="10" onkeyup="formatar(this,'##.###-###',event)">
                                        </div>
                                         <div class="form-group col-xs-8">
                                            <label>Endereço:</label>
                                            <input name="Endereco" id="rua" size="60" class="form-control" placeholder="Informe o seu Endereço:">
                                        </div>
                                        <div class="form-group col-xs-3">
                                            <label>Número</label>
                                            <input name="EnderecoNumero" class="form-control" placeholder="Número" maxlength="6">
                                        </div>
                                        <div class="form-group col-xs-2">
                                            <label>UF:</label>
                                            <input name="Uf" id="uf" size="2" class="form-control" type="text" placeholder="UF" maxlength="2">
                                        </div>
                                        <div class="form-group col-xs-7">
                                            <label>Cidade:</label>
                                            <input name="Cidade" id="cidade" size="40" class="form-control" type="text" placeholder="Cidade" maxlength="50">
                                        </div>                                        
                                        <div class="form-group col-xs-9">
                                            <label>Bairro:</label>
                                            <input name="Bairro" id="bairro" size="40" class="form-control" type="text" placeholder="Bairro" maxlength="50">
                                        </div>
                                         <div class="form-group col-xs-4">
                                            <label for="txttelefone">Telefone Fixo:</label>
                                            <input name="Telefone" class="form-control" placeholder="Fixo" type="tel">
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label>Telefone Celular:</label>
                                            <input name="Celular" class="form-control" placeholder="(99)99999-9999">
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="date" >Aniversário:</label>
                                            <input type="text" id="Data" size="11" name="DataNascimento" class="form-control" placeholder="Ex.: dd/mm/aaaa" maxlength="10" value="" onkeyup="formatar(this,'##/##/####',event)">
                                        </div>
                                        <div class="form-group">
                                            </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br><label>E-mail</label>
                                            <input name="Email" class="form-control" placeholder="seu@email.com">
                                        </div>
                                        <div class="col-sm-12">
                                            <br>
                                            
                                            <br>
                                        </div>
                                    </form>
                                </div>
                                  <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <h3>Dados de Acesso:</h3>                                    
                                    <form role="form">
                                        <fieldset enable>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input id="EnableInput" type="text" class="form-control" placeholder="Login" enable>
                                        </div>
                                        <div class="form-group">
                                               <label for="disabledSelect">Senha Cliente</label>
                                                <input class="form-control" id="EnableInput" type="password" placeholder="Senha" enable>
                                            </div>
                                            
                                        </fieldset>
                                    </form> 
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                    <button type="button" class="btn btn-primary btn-lg btn-block">Salvar</button>
                            </div>
                                    </div>
                                </div>

                               <!-- <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Todos os clientes</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Sobrenome</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Ações</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="info">
                                                <td>Tomás</td>
                                                <td>Costa Cardoso</td>
                                                <td>tomasccardoso@jourrapide.com</td>
                                                <td>(81) 6366-3856</td>
                                                <td>
                                                    <a href="" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-danger">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-warning">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </a>
                                                </td>
                                            </tr>      
                                            <tr class="active">
                                                <td>Julia</td>
                                                <td>Lima Almeida</td>
                                                <td>julialalmeida@rhyta.com</td>
                                                <td>(12) 4200-2531</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-danger">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-warning">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="info">
                                                <td>Pedro</td>
                                                <td>Azevedo Santos</td>
                                                <td>pedroazevedosantos@dayrep.com</td>
                                                <td>(31) 7322-4279</td>
                                                <td>
                                                    <a href="typography.html" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-danger">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-warning">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="active">
                                                <td>Julian</td>
                                                <td>Rodrigues Carvalho</td>
                                                <td>julianrcarvalho@dayrep.com</td>
                                                <td>(19) 6871-6570</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-danger">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                    <a href="#" name="Visualizar" class="btn btn-warning">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="info">
                                                <td>Gabriela</td>
                                                <td>Cunha Cardoso</td>
                                                <td>gabrielacunhacardoso@teleworm.com</td>
                                                <td>(11) 6580-2496</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-danger">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-warning">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="active">
                                                <td>Marina</td>
                                                <td>Dias Cavalcanti</td>
                                                <td>marinadiascavalcanti@dayrep.com</td>
                                                <td>(15) 9076-6890</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                   <a href="#" name="Excluir" class="btn btn-danger">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                    <a href="#" name="Excluir" class="btn btn-warning">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </a> 
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div><br/>-->
                                <div class="col-lg-16">
                                   <!--<a href="cadastrar.html" class="btn btn-success">Adicionar
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a> -->
                                </div>
                             </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>