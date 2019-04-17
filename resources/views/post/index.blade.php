@extends('layouts.app')
@inject('model','App\Post')

@section('content')
<section>
    <section class="content">

        <div class="box-body">
            <a href="{{url(route('post.create'))}}" class="btn btn-danger"><i class="fa fa-plus"> &nbsp New city</i></a>


            @include('flash::message')
            @if(count($record))
                <div class="table-responsive">
                    <table class="table table-bordered danger">

                        <thead style="text-align: center">
                        <tr>
                            <td>#</td>
                            <td>category</td>
                            <td>title_post</td>
                            <td>image</td>
                            <td>content_post</td>
                            <td>Edit</td>
                            <td>Delete</td>

                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        @foreach($record as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{optional($record->category)->name}}</td>
                                <td>{{$record->title_post}}</td>
                                <td><img src="{{asset('/uploads/' . $record->image)}}" style="width:200px; height:100px"></td>
                                <td>{{$record->content_post}}</td>
                                <td ><a href="{{url(route('post.edit',$record->id))}}" class="btn btn-danger"><i class="fa fa-edit"></i></a></td>
                                <td class="text-center">
                                    {!!Form::open([
                                    'action' =>['PostController@destroy',$record->id],
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
                <p class="text-center"> لا يوجد اى مقالات</p>
            @endif
        </div>


</section>



@endsection