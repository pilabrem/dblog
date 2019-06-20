@extends('dblog::layouts.app')

@section('content')
<div class="starter-template">
    <section>
        <h1>Opération</h1>
        <p class="lead">
            <table class="table table-striped table-hover" style="text-align:left;">
                <tbody>
                    <tr class="@include('dblog::row-context', ['action' => $log->action])">
                        <td>Action</td>
                        <td>{{$log->action}}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>{{$log->message}}</td>
                    </tr>
                    <tr>
                        <td>Utilisateur</td>
                        <td>{{App\Models\User::find($log->user_id)->name}}</td>
                    </tr>
                    <tr>
                        <td>Localisation</td>
                        <td>{{$log->location}}</td>
                    </tr>
                </tbody>
            </table>
        </p>
    </section>

    <section>
        <h1>Données</h1>
        <p class="lead">
            <table class="table table-striped table-hover" style="text-align:left;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Donnée avant opération</th>
                        <th scope="col">Donnée actuelle</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $data)
                    <tr @if ($data[1] != $data[2]) class="table-warning" @endif>
                        <td>{{$data[0]}}</td>
                        <td>{{$data[1]}}</td>
                        <td>{{$data[2]}}</td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </p>
    </section>
</div>
@endsection