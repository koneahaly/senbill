@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenue sur le portail de facturation en ligne eLECTRA</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Infos client:-
                    <ul id="">
                        <li><strong>Nom:</strong> {{ Auth::user()->name }}</li>
                        <li><strong>Type de client:</strong> Woyofal</li>
                        <li><strong>Adresse mail:</strong>{{ Auth::user()->email }}</li>
                        <li><strong>Numéro de compteur: </strong>{{ Auth::user()->customerId }}</li>
                        <li><strong>Adresse de facturation:</strong> {{Auth::user()->address}}  </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
