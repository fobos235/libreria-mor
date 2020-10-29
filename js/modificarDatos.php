
<?php
session_start();
$arreglo=$_SESSION['1carrito'];
$total=0;
$numero=0;
for($i=0;$i<count($arreglo);$i++){
	if($arreglo[$i]['Id']==$_POST['Id']){
		$numero=$i;
	}
}
$arreglo[$numero]['Cantidad']=$_POST['Cantidad'];
for($i=0;$i<count($arreglo);$i++){
	$total=($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad'])+$total;
}
$_SESSION['1carrito']=$arreglo;
echo $total;

?>