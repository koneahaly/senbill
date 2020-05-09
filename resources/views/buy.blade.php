<!DOCTYPE html>
<html><head><title>Reçu du mois de {{$data[0]->creation_date}}</title></head><body><style>
body{font-family:Raleway,sans-serif;}.right{float:right;}.red{color:red;}.tg  {border-collapse:collapse;border-spacing:0;margin: auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading" style="height:100px;background-color:#337ab7;;font-size:18px;color:white;text-align:center;"><strong><br /> <br />Reçu du mois de {{$data[0]->creation_date}}</strong></div>
    <div class="panel-body">
      <br />
      <br />
      <div class="container">
        <div class="panel panel-info">
          <div class="panel-heading col-md-5" ><strong>Contact</strong></div>
          <div class="panel-body">
            <p>
              Pour signaler un incident électrique<br /> ou un danger:<br /> Service dépannage Senelec <br />
              773098354 <br />
              (appel non surtaxé 7j/7 24h/24)
            </p>
          </div>
        </div>
      </div>
      <p>
                      <ul>
                  <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
                  <li><strong>Registered email-id:</strong>{{ Auth::user()->email }}</li>
                  <li><strong>Connection Id: </strong>{{ Auth::user()->customerId }}</li>
                  <li><strong>Billing Address:</strong> {{Auth::user()->address}}  </li>
                          <li><strong>Bill for:</strong><span class="red">{{$data[0]->creation_date}}</span></li>
              </ul>
              </p><table class="tg">
        <tr>
          <th class="tg-yw4l">Numéro de compte<br></th>
          <th class="tg-yw4l">Montant<br></th>
          <th class="tg-yw4l">Carte prépayée<br></th>
          <th class="tg-yw4l">Date de paiement<br></th>
          <th class="tg-yw4l">Méthode de paiement<br></th>
        </tr>
        <tr>
          <td class="tg-yw4l">{{$data[0]->counter_number}}</td>
          <td class="tg-yw4l">{{$data[0]->amount}}</td>
          <td class="tg-yw4l">{{$data[0]->prepaid_cards_id}}</td>
          <td class="tg-yw4l">{{$data[0]->creation_date}}</td>
          <td class="tg-yw4l red"><strong>{{$data[0]->payment_method}}</strong></td>
        </tr>
      </table>
      <br>
    </div>
  </div>
</div>
</body></html>
