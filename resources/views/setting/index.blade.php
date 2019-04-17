@extends('layouts.app')


@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box-body">



            @include('flash::message')
            @if(count($record))
                <div class="table-responsive">
                    <table class="table table-bordered danger">

                        <thead style="text-align: center">
                        <tr>
                            <td>#</td>
                            <td>about_app</td>
                            <td>phone</td>
                            <td>email</td>
                            <td>android_app_url</td>
                            <td>facebook_url</td>
                            <td>whatsapp_url</td>
                            <td>google_url</td>
                            <td>instgram_url</td>
                            <td>youtube_url</td>
                            <td>twitter_url</td>
                            <td>Edit</td>


                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        @foreach($record as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->about_app}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->email}}</td>
                                <td>{{$record->android_app_url}}</td>
                                <td>{{$record->facebook_url}}</td>
                                <td>{{$record->whatsapp_url}}</td>
                                <td>{{$record->google_url}}</td>
                                <td>{{$record->instagram_url}}</td>
                                <td>{{$record->youtube_url}}</td>
                                <td>{{$record->twitter_url}}</td>
                                <td ><a href="{{url(route('setting.edit',$record->id))}}" class="btn btn-danger"><i class="fa fa-edit"></i></a></td>

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
