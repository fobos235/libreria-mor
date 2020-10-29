<?php
include_once '../conexion.php';
session_start();
// if(!isset($_GET['collection_id'])){
//     header("location: ".BASE_URL);
// }

$pago_id = $_GET['payment_id'];


$validar_compra = curl_init();
curl_setopt($validar_compra, CURLOPT_URL, "https://api.mercadopago.com/v1/payments/$pago_id?access_token=".MERCADO_PAGO_TOKEN);
curl_setopt($validar_compra, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($validar_compra, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($validar_compra);
// echo $res;
$res = json_decode($res);
$status = '';
switch ($res->status) {
    case 'approved':
        $status = 'Aprovado';
        break;
    case 'pending':
        $status = 'Pendiente';
        break;
    case 'pending':
        $status = 'Fallido';
        break;
    
    default:
        $status = 'Pendiente';
        break;
}

$metodo_pago = "";
switch ($res->payment_type_id) {
    case 'credit_card':
        $metodo_pago = "Tarjeta de crédito/débito";
        break;

    case 'ticket':
        $tipo = "";
        switch ($res->payment_method_id) {
            case 'oxxo':
                $tipo = "Oxoo";
                break;
            case 'atm':
                $tipo = "efectivo";
                break;
            
            default:
                $tipo = $res->payment_method_id;
                break;
        }
        $metodo_pago = "Depósito en ".$tipo;
        break;

        case 'atm':
            $tipo = "Depósito en efectivo/Transferencia ";
            switch ($res->payment_method_id) {
                case 'bancomer':
                    $tipo .= "BBVA Bancomer";
                    break;
                case 'banamex':
                    $tipo .= "Citibanamex";
                    break;
                case 'serfin':
                    $tipo .= "Santander";
                    break;
                                
                default:
                    $tipo = $res->payment_method_id;
                    break;
            }
            $metodo_pago = $tipo;
            break;
    
    default:
        $metodo_pago = $res->payment_type_id;
        break;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Gracias por tu compra</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <link rel="stylesheet" href="../css/materialize.min.css">
    <script src="../js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <!--Inicio barra de navegacion -->
    <?php
    include_once "partials/cabecera.php";
    ?>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center">Gracias por tu compra</h1>
            <div class="row ">
                <h5 class="header col s12 light">Estamos revisando y preparando tu pedido. Puedes revisar el progreso en tu lista de pedidos</h5>
                <h6>Detalles de tu compra:</h6>
                <p><strong>Total de compra: $</strong><?=number_format($res->transaction_amount,2).' '.$res->currency_id;?></p>
                <p><strong>Estado: </strong><?=$status;?></p>
                <p><strong>Método de pago: </strong><?=$metodo_pago;?></p>
                <p><strong>Impuestos: $</strong><?=number_format($res->taxes_amount,2);?></p>
                
            </div>
            <?php
            // var_dump($_GET);
            ?>
            <br><br>
            <div class="row center">
                <a href="<?=BASE_URL;?>" id="download-button"
                    class="btn-large waves-effect waves-light">Volver al inicio</a>
            </div>
            <br><br>

        </div>
    </div>
    


    <DIV class="footer">
        <?php
        include_once 'partials/footer.php';
        ?>
    </DIV>
</body>

</html>