<!DOCTYPE html>
<html>
<head>
	<title>Bill</title>
	<style>
		body{
			font-family:Raleway,sans-serif;
		}
		.right{
			float:right;
		}
		.red{color:red;}
		.tg  {border-collapse:collapse;border-spacing:0;margin: auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}


	</style>

</head>
<body>
	<h1>portail de paiement en ligne eLECTRA</h1>
	<hr>
	<p>
		<ul>
            <li><strong>Nom:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Adresse mail:</strong>{{ Auth::user()->email }}</li>
            <li><strong>Numéro de compteur: </strong>{{ Auth::user()->customerId }}</li>
            <li><strong>Adresse de facturation:</strong> {{Auth::user()->address}}  </li>
	            <li><strong>payer pour:</strong><span class="red">{{$data[0]->month}},{{$data[0]->year}}</span></li>
        </ul>
	</p>
<table class="tg">
  <tr>
    <th class="tg-yw4l">Consommation initiale<br></th>
    <th class="tg-yw4l">Consommation finale<br></th>
    <th class="tg-yw4l">unités Consumées<br></th>
    <th class="tg-yw4l">tarif unitaire<br></th>
    <th class="tg-yw4l">Total<br></th>
  </tr>
  <tr>
    <td class="tg-yw4l">{{$data[0]->initial}}</td>
    <td class="tg-yw4l">{{$data[0]->final}}</td>
    <td class="tg-yw4l">{{$data[0]->units}}</td>
    <td class="tg-yw4l">Rs.{{($data[0]->amount)/($data[0]->units)}} par unité</td>
    <td class="tg-yw4l red"><strong>Rs.{{$data[0]->amount}}</strong></td>
  </tr>
</table>
<br>

</body>
</html>
