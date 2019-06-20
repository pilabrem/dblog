@extends('dblog::layouts.app')

@section('content')
<div class="starter-template">
    <h1>Liste des opérations sur <b>{{env('APP_NAME')}}</b></h1>
    <p class="lead">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Table</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Action</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                <tr class="@include('dblog::row-context', ['action' => $log->action])">
                    <th scope="row">{{$log->id}}</th>
                    <td>{{$log->table_name}}</td>
                    <td>{{$log->user_name}}</td>
                    <td>{{$log->action}}</td>
                    <td>{{$log->message}}</td>
                    <td>{{$log->created_at}}</td>
                    <td><a href="{{route('dblog.table.show', $log->id)}}"><i class="fa fa-eye"></i>Voir</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6"><span>Aucune opération trouvé sur @env('app_name')</span></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </p>
    <p>{{$logs->links('dblog::pagination.bootstrap-4')}}</p>
</div>
@endsection