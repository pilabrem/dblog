@switch($action)
@case('create')
table-success
@break
@case('read')
table-info
@break
@case('update')
table-warning
@break
@case('delete')
table-danger
@break
@default

@endswitch