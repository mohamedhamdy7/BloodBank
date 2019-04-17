@extends('layouts.app')
@inject('model','App\Governorate')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box-body">
            <a href="{{url(route('governorate.create'))}}" class="btn btn-danger"><i class="fa fa-plus"> &nbsp New Governorate</i></a>

            <a href="trashed" class="btn btn-danger" style="float: right">Show Trashed value</a>
            @include('flash::message')
            @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered danger">

                        <thead style="text-align: center">
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Edit</td>
                            <td>Delete</td>

                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td ><a href="{{url(route('governorate.edit',$record->id))}}" class="btn btn-danger"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <a href="governorate/{{$record->id}}/delete" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                    </a>
                                   </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            @else
            @endif
        </div>

    </section>
    <!-- /.content -->
@endsection
