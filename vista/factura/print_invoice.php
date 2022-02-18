
<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);		
	$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);		
}
$invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceValues['order_date']));
$output = '';

$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	//NOMBRE DE LA EMPRESA
	<tr>
		<td colspan="2" align="center">
			<b style="font-size:65Spx">LAVASECO CUNDINAMARCA</b><br/> 
			<b style="font-size:35Spx">Cels. 310 278 5726 - 311 555 1523</b><br/>
			<b style="font-size:35Spx">Calle 9 #7-24 Barrio Alcaparros Madrid</b>
		</td>
		
	</tr>

	//N factura

	<tr>
		<td colspan="2" align="center" style="font-size:260Spx">
			<b>
			'.$invoiceValues['order_id'].'
			</b>
		</td>
	</tr>

	//Datos cliente

	<tr>
		<td colspan="2"  style="font-size:40Spx">
			
			Fecha : '.$invoiceDate.'<br />
			Cliente: <b style="font-size:50Spx">'.$invoiceValues['order_receiver_name'].'</b><br /> 
			Celular: '.$invoiceValues['celular'].'<br /> 
			Correo : '.$invoiceValues['address'].'<br />
		
		</td>
	</tr>

	//Contenido factura
	
	</tr>
	</table>
	<br />
	<table style="font-size:42px" width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
		<th align="left">Nombre</th>
		<th align="left">Servicio</th>
		<th align="left">Cantidad</th>
		<th align="left">Precio</th> 
	</tr>';

$count = 0;   
foreach($invoiceItems as $invoiceItem){
	$count++;
	$output .= '
	
	<tr>
	<td align="left">'.$invoiceItem["item_name"].'</td>
	<td align="left">'.$invoiceItem["item_code"].'</td>
	<td align="left">'.$invoiceItem["order_item_quantity"].'</td>
	<td align="left">'.$invoiceItem["order_item_final_amount"].'</td>   
	</tr>';
}

$output .= '
	<tr>
	<td align="right" colspan="3"><b>Sub Total</b></td>
	<td align="left"><b>'.$invoiceValues['order_total_before_tax'].'</b></td>
	</tr>

	<tr>
	<td align="right" colspan="3">Monto Pagado:</td>
	<td align="left">'.$invoiceValues['order_amount_paid'].'</td>
	</tr>

	<tr>
	<td align="right" colspan="3"><b>PENDIENTE CANCELAR:</b></td>
	<td align="left"><b>'.$invoiceValues['order_total_amount_due'].'</b></td>
	</tr>
	
	</table>
	<br />
	<table style="font-size:30px" width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>';

	$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	//Fin

	<tr>
		<td colspan="2" " style="font-size:30Spx">
			<b style="font-size:32Spx">Detalles</b><br />'.$invoiceValues['note'].'<br /> 
		</td>
	</tr>';
	

$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	//Fin

	<tr>
		<td colspan="2"  style="font-size:50Spx">
			
			Atendido por : <b style="font-size:60Spx">'.$_SESSION['user'].'</b><br />
			Para entregar: <b style="font-size:60Spx">'.$invoiceValues['fecha_entrega'].'</b><br />
			Dirección de entrega : '.$invoiceValues['dir_entrega'].'<br />
		
		</td>
	</tr>


	<tr>
		<td colspan="2" align="center" style="font-size:30Spx">
			<b style="font-size:32Spx">LAS ANOTACIONES MANUALES NO TENDRAN VALIDEZ</b><br /> 
			Recuerda que entre más grande sea el HTML y las hojas de estilo, se llevará más tiempo renderizar el documento a PDF.

			La ventaja de todo esto es que puedes usar estilos bonitos y usar HTML para generar un PDF, usando un lenguaje que ya sabes, en lugar de aprender a usar la librería que crea PDF de manera nativa.

			No olvides que además de mostrar directamente el documento puedes forzar su descarga o guardarlo de manera local.
			
			<br /> 
		</td>
	</tr>
	
	</tr>
	</table>
	<br />
	<table style="font-size:42px" width="100%" border="1" cellpadding="5" cellspacing="0">
	>';
	
$output .= '
	</table>
	</td>
	</tr>
	</table>';
	
// create pdf of invoice	
$invoiceFileName = 'Invoice-'.$invoiceValues['order_id'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$paper_size = array(0,0,800,2960);
$dompdf->set_paper($paper_size);
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>   
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
   