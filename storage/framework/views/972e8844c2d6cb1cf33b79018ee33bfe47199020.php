<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Facture du mois de <?php echo e($data[0]->month); ?></title>
    <style>
    @font-face {
font-family: Junge;
src: url(Junge-Regular.ttf);
}

.clearfix:after {
content: "";
display: table;
clear: both;
}
#logo {
  text-align: center;
  margin-bottom: 10px;
}
a {
color: #001028;
text-decoration: none;
}

body {
font-family: Junge;
position: relative;
width: 100%;
height: 100%;
margin: 0;
color: #001028;
background: #FFFFFF;
font-size: 14px;
}

.arrow {
margin-bottom: 4px;
}

.arrow.back {
text-align: right;
}

.inner-arrow {
padding-right: 10px;
height: 30px;
display: inline-block;
background-color: rgb(233, 125, 49);
text-align: center;

line-height: 30px;
vertical-align: middle;
}

.arrow.back .inner-arrow {
background-color: rgb(233, 217, 49);
padding-right: 0;
padding-left: 10px;
}

.arrow:before,
.arrow:after {
content:'';
display: inline-block;
width: 0; height: 0;
border: 15px solid transparent;
vertical-align: middle;
}

.arrow:before {
border-top-color: rgb(233, 125, 49);
border-bottom-color: rgb(233, 125, 49);
border-right-color: rgb(233, 125, 49);
}

.arrow.back:before {
border-top-color: transparent;
border-bottom-color: transparent;
border-right-color: rgb(233, 217, 49);
border-left-color: transparent;
}

.arrow:after {
border-left-color: rgb(233, 125, 49);
}

.arrow.back:after {
border-left-color: rgb(233, 217, 49);
border-top-color: rgb(233, 217, 49);
border-bottom-color: rgb(233, 217, 49);
border-right-color: transparent;
}

.arrow span {
display: inline-block;
width: 80px;
margin-right: 20px;
text-align: right;
}

.arrow.back span {
margin-right: 0;
margin-left: 20px;
text-align: left;
}

h1 {
color: #5D6975;
font-family: Junge;
font-size: 2.4em;
line-height: 1.4em;
font-weight: normal;
text-align: center;
border-top: 1px solid #5D6975;
border-bottom: 1px solid #5D6975;
margin: 0 0 2em 0;
}

h1 small {
font-size: 0.45em;
line-height: 1.5em;
float: left;
}

h1 small:last-child {
float: right;
}

#project {
float: left;
}

#company {
float: right;
}

table {
width: 100%;
border-collapse: collapse;
border-spacing: 0;
margin-bottom: 30px;
}

table th,
table td {
text-align: center;
}

table th {
padding: 0px 20px;
color: #5D6975;
border-bottom: 1px solid #C1CED9;
white-space: nowrap;
font-weight: normal;
}

table .service,
table .desc {
text-align: left;
}

table td {
padding: 20px;
text-align: right;
}

table td.service,
table td.desc {
vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
font-size: 1.2em;
}

table td.sub {
border-top: 1px solid #C1CED9;
}

table td.grand {
border-top: 1px solid #5D6975;
}

table tr:nth-child(2n-1) td {
background: #EEEEEE;
}

table tr:last-child td {
background: #DDDDDD;
}

#details {
margin-bottom: 30px;
}

footer {
color: #5D6975;
width: 100%;
height: 30px;
position: absolute;
bottom: 0;
border-top: 1px solid #C1CED9;
padding: 8px 0;
text-align: center;
}
    </style>
  </head><body>
    <main>
      <div id="logo">
        <img src="https://elektra.s3.amazonaws.com/images/icons/logo-elektra-halo.png">
      </div>
      <h1  class="clearfix"> Facture du mois de <?php echo e($data[0]->month); ?> <small><span>PAY&Eacute; LE</span><br /> <?php echo e($data[0]->created_at); ?></small></h1>
      <table>
        <thead>
          <tr>
            <th class="service">Consommation initiale</th>
            <th class="desc">Consommation finale</th>
            <th>Consommation totale</th>
            <th>prix de l'unité</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service"><?php echo e($data[0]->initial); ?></td>
            <td class="desc"><?php echo e($data[0]->final); ?></td>
            <td class="unit"><?php echo e($data[0]->units); ?></td>
            <td class="qty"><?php echo e(($data[0]->amount)/($data[0]->units)); ?> FCFA per unit</td>
            <td class="total"><?php echo e($data[0]->amount); ?> FCFA</td>
          </tr>

          <tr>
            <td colspan="4" class="sub">SOUS TOTAL</td>
            <td class="sub total"><?php echo e($data[0]->amount); ?> FCFA</td>
          </tr>
          <tr>
            <td colspan="4">TAX 0%</td>
            <td class="total">0.00 FCFA</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">TOTAL</td>
            <td class="grand total"><?php echo e($data[0]->amount); ?> FCFA</td>
          </tr>
        </tbody>
      </table>
      <div id="details" class="clearfix">
        <div id="project">
          <div class="arrow"><div class="inner-arrow"> Facture </div></div>
          <div class="arrow"><div class="inner-arrow"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->name); ?></div></div>
          <div class="arrow"><div class="inner-arrow"><?php echo e(Auth::user()->address); ?></div></div>
          <div class="arrow"><div class="inner-arrow"><?php echo e(Auth::user()->email); ?></div></div>
        </div>
        <div id="company">
          <div class="arrow back"><div class="inner-arrow">Nom de l'entreprise</div></div>
          <div class="arrow back"><div class="inner-arrow">4 Avenue général Leclerc </div></div>
          <div class="arrow back"><div class="inner-arrow">0625325445</div></div>
          <div class="arrow back"><div class="inner-arrow">services2sn@gmail.com</div></div>
        </div>
      </div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Une majoration de 1,5% sera appliquée sur les factures impayés après 30 jours.</div>
      </div>
    </main>
    <footer>
      La facture a été créée sur un ordinateur et est valide sans la signature et le tampon.
    </footer>
  </body></html>
