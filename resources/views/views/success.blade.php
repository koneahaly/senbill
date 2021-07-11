<!DOCTYPE html>
<html>
<head>
    <title>Félicitations</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

        .suc{
            margin-top:100px;
            font-size: 30px;
        }
        div{
            width:50%;
        }
        .btn{
            margin-left: 100px;
        }
        .center{
            margin:auto;
        }
    </style>
</head>
<body>
    <div class="center">
       <p class="suc">Enregistrement ajouté avec succès.   <br>
    <a href="{{ url('/admin') }}"><button type="submit" class="btn btn-primary">Go Back</button></a></p>
    </div>


</body>
</html>
