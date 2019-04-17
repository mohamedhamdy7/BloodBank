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
                            <td>client</td>
                            <td>title</td>
                            <td>message</td>


                            <td>Delete</td>

                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{optional($record->client)->name}}</td>
                                <td>{{$record->title}}</td>
                                <td>{{$record->message}}</td>

                                <td class="text-center">
                                    {!!Form::open([
                                    'action' =>['ContactController@destroy',$record->id],
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
                <p class='text-center h3'>لا توجد رسائل !!</p>
            @endif
        </div>

    </section>
    <!-- /.content -->
@endsection
