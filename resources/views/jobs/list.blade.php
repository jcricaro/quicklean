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
                                    Name
                                </th>
                                <th>
                                    Phone
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
                                 </td>
                                 <td>
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