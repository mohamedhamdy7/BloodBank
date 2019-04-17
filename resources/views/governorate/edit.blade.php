@extends('layouts.app')
@inject('model','App\Governorate')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">

                <h3 class="box-title">List of Governorates</h3>
                <div class="box-body">

                    @include('partials.validation_errors')

                    <form action="update" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-secondary">Update</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
@endsection
