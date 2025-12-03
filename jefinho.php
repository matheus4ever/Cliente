<?php 
const CHEQUE_ESPECIAL = 500;
$clientes = [];

function cadastrarCliente(&$clientes): bool {

    $nome = readline('Informe seu nome: ');
    $cpf = readline('Informe seu CPF: ');

    //validar cliente
    if (isset($clientes[$cpf])) {
        print('Esse CPF já possui cadastro\n');
        return false;
    }

    $clientes[$cpf] = [
        'nome' => $nome, 
        'cpf' => $cpf,
        'contas' => []
    ];

    return true;

}

function cadastrarConta(array &$clientes): bool{

    $cpf = readline("Informe seu CPF:");

    if(!isset($clientes[$cpf])){
        print("Cliente não possui cadastro \n");
        return false;
    }

    $numConta = uniqid();

    $clientes[$cpf]['contas'][$numConta] = [
        'saldo' => 0,
        'cheque_especial' => CHEQUE_ESPECIAL,
        'extrato' => []
    ];

    print("Conta criada com sucesso\n");
    print("O número da sua conta é: " . $numConta);
    return true;

}

function depositar(array &$clientes){
    $cpf = readline("Informe seu CPF novamente: ");

    $numConta  = readline("Informe o número da conta: ");

    $valorDeposito = (float) readline("Informe o valor do depósito: ");

    if ($valorDeposito <= 0 ){
        print("Valor de depósito inválido\n");
        return false;
    }

    $clientes[$cpf]['contas'][$numConta]['saldo'] += $valorDeposito;

    $dataHora = date('d/m/Y H:i');
    $clientes[$cpf]['contas'][$numConta]['extrato'][] = "Depósito de R$ $valorDeposito em $dataHora";

    print "Depósito realizado com sucesso\n";
    return true;
}

function sacar(&$clientes){

    $cpf = readline("Informe seu CPF:");

    //validacao do CPF

    $conta = readline("Informe o número da conta: ");

    $valorSaque = readline("Informe o valor do saque:");

    if($clientes[$cpf]['contas'][$conta]['saldo'] + CHEQUE_ESPECIAL >= $valorSaque){
        $clientes[$cpf]['contas'][$conta]['saldo'] -= $valorSaque;
    }
}

//MENU PRINCIPAL
function menu(){
    print "\n ============= MEU BANCO EM PHP =============\n";
    print "1 - cadastrar cliente\n";
    print "2 - cadastrar conta\n";
    print "3 - depositar\n";
    print "4 - sacar\n";
    print "5 - consultar saldo\n";
    print "6 - consultar extrato\n";
    print "7 - sair\n";
    print " ============================================\n";

    print "Escolha uma opção:";
}

//PROGRRAMA PRINCIPAL
while(true){

    menu();

    $opcao = readline();

    switch ($opcao) {
        case '1':
            cadastrarCliente($clientes);
            break;
        
        case '2':
            cadastrarConta($clientes);
            break;
        case '3':
            depositar($clientes);
            break;
        case '4':
            sacar($clientes);
            print("Saque realizado com sucesso");
            break;
        case '5':
            print($clientes[$cpf]['contas'][$numConta]['saldo']);
            break;
        case '6':
            print($clientes[$cpf]['contas'][$numConta]['extrato']);
            break;
        case '7':
            print("Obrigado por usar nosso banco\n");
            print("Saindo...");
            die();
        default:
            print "Opção inválida";
            break;
    }
}

    cadastrarCliente($clientes);
    print_r($clientes);

    cadastrarConta($clientes);
    print_r($clientes);

    depositar($clientes);
    print_r($clientes);
