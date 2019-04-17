@extends('layouts.app')
@inject('model','App\Governorate')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box-body">

            @if(count($name))
                <div class="table-responsive">
                    <table class="table table-bordered danger">

                        <thead style="text-align: center">
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Restore</td>

                            <td>DeleteForce</td>
                        </tr>
                        </thead>
                        <tbody style="text-align: center">

                        @foreach($name as $name)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$name->name}}</td>
                              <td><a href="governorate/{{$name->id}}/restore" class="btn btn-danger">Restore</a></td>
                              <td><a href="governorate/{{$name->id}}/deleteforce" class="btn btn-danger">DeleteForce</a></td>
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
