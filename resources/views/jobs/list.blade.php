@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Jobs</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Customer
                                </th>
                                <th>
                                    Service Type
                                </th>
                                <th>
                                    Kilogram
                                </th>
                                <th>
                                    Washer Mode
                                </th>
                                <th>
                                    Dryer Mode
                                </th>
                                <th>
                                    Detergent
                                </th>
                                <th>
                                    Bleach
                                </th>
                                <th>
                                    Fabric Conditioner
                                </th>
                                <th>
                                    Services
                                </th>
                                <th>
                                    Machines
                                </th>
                                <th>
                                    Status
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                             <tr>
                                 <td>
                                     {{ $job->id }}
                                 </td>
                                 <td>
                                    {{ $job->name }}
                                    <br/>
                                    {{ $job->phone }}
                                 </td>
                                 <td>
                                     {{ $job->service_type }}
                                 </td>
                                 <td>
                                     {{ $job->kilogram }}
                                 </td>
                                 <td>
                                     {{ $job->washer_mode }}
                                 </td>
                                 <td>
                                     {{ $job->dryer_mode }}
                                 </td>
                                 <td>
                                     {{ $job->detergent }}
                                 </td>
                                 <td>
                                     {{ $job->bleach }}
                                 </td>
                                 <td>
                                     {{ $job->fabric_conditioner }}
                                 </td>
                                 <td>
                                     <ul class="list-unstyled">
                                         @if($job->is_press)
                                         <li>Press</li>
                                         @endif
                                         @if($job->is_fold)
                                         <li>Fold</li>
                                         @endif
                                     </ul>
                                 </td>
                                 <td>
                                    <ul class="list-unstyled">
                                        <li>{{ $job->washer ? $job->washer->name : '' }}</li>
                                        <li>{{ $job->dryer ? $job->dryer->name : '' }}</li>
                                     </ul>
                                 </td>
                                 <td>
                                     {{ $job->status }}
                                 </td>
                                 <td>
                                    @if( $job->status == 'Pending' )
                                    <form action="{{ url('/jobs/approve') . '/' . $job->id . '?page=' . Request::get('page', 1) }}" method="POST">
                                        <div class="form-group">
                                            <button type="submit" class="btn">Approve</button>
                                        </div>
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                    </form>

                                    <form action="{{ url('/jobs/decline') . '/' . $job->id }}" method="POST">
                                        <div class="form-group">
                                            <button type="submit" class="btn">Decline</button>
                                        </div>
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                    </form>
                                    @endif
                                 </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop