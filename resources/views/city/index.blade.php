@extends('layouts.app')
@inject('model','App\City')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box-body">
            <a href="{{url(route('city.create'))}}" class="btn btn-danger"><i class="fa fa-plus"> &nbsp New city</i></a>


            @include('flash::message')
            @if(count($record))
                <div class="table-responsive">
                    <table class="table table-bordered danger">

                        <thead style="text-align: center">
                        <tr>
                            <td>#</td>
                            <td>Governorate</td>
                            <td>City</td>
                            <td>Edit</td>
                            <td>Delete</td>

                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        @foreach($record as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{optional($record->governorate)->name}}</td>
                                <td>{{$record->name}}</td>
                                <td ><a href="{{url(route('city.edit',$record->id))}}" class="btn btn-danger"><i class="fa fa-edit"></i></a></td>
                                <td class="text-center">
                                    {!!Form::open([
                                    'action' =>['citycontroller@destroy',$record->id],
                                    'method' =>'delete'

                                    ]) !!}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    {!! Form::close() !!}
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
