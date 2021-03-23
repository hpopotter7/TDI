
  
<?php
    $num = 'CMD01-'.date('ymd');
    $nom = 'DUPONT Alphonse';
    $date = '31/12/'.date('Y');
?>
<style type="text/css">

    div.zone { border: none; border-radius: 6mm; background: #FFFFFF; border-collapse: collapse; padding:3mm; font-size: 2.7mm;}
    h1 { padding: 0; margin: 0; color: #DD0000; font-size: 7mm; }
    h2 { padding: 0; margin: 0; color: #222222; font-size: 5mm; position: relative; }

</style>
<page orientation="P" backcolor="#AAAACC" style="font: arial;">

    <!-- <table style="width: 99%;border: 1px;">
        <tr>
            <td style='width:100%; text-align:center'>SOLICITUD DE FACTURA</td>
        </tr>
        <tr>
        <td style='width:100px;background-color:green'>Empresa que Factura</td>
        <td style='width:200px;background-color:black'>TDI</td>
        <td style='width:300px;background-color:black'>TDI</td>
        </tr>-->
        <table style="width: 99%;border: 1px;">
<thead>
  <tr>
    <th colspan='4' style='width:100%; text-align:center'>EMPRESA QUE FACTURA</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td style='width:20%; text-align:center;background-color:green'>Empresa que factura</td>
    <td style='width:50%; text-align:center'>TDI</td>
  </tr>
  <tr>
    <td style='width:20%; text-align:center;background-color:green'>Nombre de vento</td>
    <td style='width:20%; text-align:center'></td>
  </tr>
  <tr>
    <td style='width:20%; text-align:center;background-color:green'>Nombre del cliente</td>
    <td style='width:20%; text-align:center'></td>
  </tr>
  <tr>
    <td style='width:20%; text-align:center;background-color:green'>Lugar</td>
    <td style='width:5px; text-align:center'>CDMX</td>
    <td style='width:20%; text-align:center;background-color:green'>Fechad del evento</td>
    <td style='width:10%; text-align:center'>01/02/2021</td>
  </tr>
  <tr>
    <td colspan='4' style='width:100%; text-align:center'>Datos cliente</td>
  </tr>
</tbody>
</table>
        <!-- <tr>
            <td style="width: 25%;">
                <div class="zone" style="height: 40mm;vertical-align: middle;text-align: center;">
                    <qrcode value="<?php echo $num."\n".$nom."\n".$date; ?>" ec="Q" style="width: 37mm; border: none;" ></qrcode>
                </div>
            </td>
            <td style="width: 75%">
                <div class="zone" style="height: 40mm;vertical-align: middle; text-align: justify">
                    <b>Conditions d'utilisation du billet</b><br>
                    Le billet est soumis aux conditions générales de vente que vous avez
                    acceptées avant l'achat du billet. Le billet d'entrée est uniquement
                    valable s'il est imprimé sur du papier A4 blanc, vierge recto et verso.
                    L'entrée est soumise au contrôle de la validité de votre billet. Une bonne
                    qualité d'impression est nécessaire. Les billets partiellement imprimés,
                    souillés, endommagés ou illisibles ne seront pas acceptés et seront
                    considérés comme non valables. En cas d'incident ou de mauvaise qualité
                    d'impression, vous devez imprimer à nouveau votre fichier. Pour vérifier
                    la bonne qualité de l'impression, assurez-vous que les informations écrites
                    sur le billet, ainsi que les pictogrammes (code à barres 2D) sont bien
                    lisibles. Ce titre doit être conservé jusqu'à la fin de la manifestation.
                    Une pièce d'identité pourra être demandée conjointement à ce billet. En
                    cas de non respect de l'ensemble des règles précisées ci-dessus, ce billet
                    sera considéré comme non valable.<br>
                    <br>
                    <i>Ce billet est reconnu électroniquement lors de votre
                    arrivée sur site. A ce titre, il ne doit être ni dupliqué, ni photocopié.
                    Toute reproduction est frauduleuse et inutile.</i>
                </div>
            </td>
        </tr>
    </table> -->
</page>