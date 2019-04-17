@extends('layouts.app')


@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box-body">



            @include('flash::message')
            @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered danger">

                        <thead style="text-align: center">
                        <tr>
                            <td>#</td>
                            <td>name</td>
                            <td>email</td>
                            <td>birth_date</td>
                            <td>donation_last_date</td>
                            <td>phone</td>
                            <td>password</td>
                            <td>city</td>

                            <td>blood_type</td>

                            <td>Delete</td>

                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->email}}</td>
                                <td>{{$record->birth_date}}</td>
                                <td>{{$record->donation_last_date}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->password}}</td>
                                <td>{{optional($record->city)->name}}</td>

                                <td>{{optional($record->blood_type)->name}}</td>

                                <td class="text-center">
                                    {!!Form::open([
                                    'action' =>['ClientController@destroy',$record->id],
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
