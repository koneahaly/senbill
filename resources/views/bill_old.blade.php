<!DOCTYPE html>
<html><head><title>Facture du mois de {{$data[0]->month}}</title></head><body><style>
body{font-family:Raleway,sans-serif;}.right{float:right;}.red{color:red;}.tg  {border-collapse:collapse;border-spacing:0;margin: auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading" style="height:100px;background-color:#337ab7;;font-size:18px;color:white;text-align:center;"><strong><br /> <br />Facture du mois de {{$data[0]->month}}</strong></div>
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
                          <li><strong>Bill for:</strong><span class="red">{{$data[0]->month}},{{$data[0]->year}}</span></li>
              </ul>
              </p><table class="tg">
        <tr>
          <th class="tg-yw4l">Initial Reading<br></th>
          <th class="tg-yw4l">Final Reading<br></th>
          <th class="tg-yw4l">Units Consumed<br></th>
          <th class="tg-yw4l">Rate<br></th>
          <th class="tg-yw4l">Total<br></th>
        </tr>
        <tr>
          <td class="tg-yw4l">{{$data[0]->initial}}</td>
          <td class="tg-yw4l">{{$data[0]->final}}</td>
          <td class="tg-yw4l">{{$data[0]->units}}</td>
          <td class="tg-yw4l">{{($data[0]->amount)/($data[0]->units)}} FCFA per unit</td>
          <td class="tg-yw4l red"><strong>Rs.{{$data[0]->amount}}</strong></td>
        </tr>
      </table>
      <br>
    </div>
  </div>
</div>
</body></html>
