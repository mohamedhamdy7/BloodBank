@extends('layouts.app')


@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">

                <h3 class="box-title">List of Governorates</h3>
                <div class="box-body">

                    @include('partials.validation_errors')
                    @include('flash::message')
                            {!! Form::model($model,[
                                'action' => ['citycontroller@update',$model->id],
                                'method' => 'put'
                            ]) !!}

                    <div class="form-group">
                        <label for="name">المدينة</label>
                        {!! Form::text('name',null,[
                            'class' => 'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        @inject('governorates','App\Governorate')
                        <label for="governorate_id">المحافظة</label>
                        {!! Form::select('governorate_id',$governorates->pluck('name','id'),null,[
                            'class' => 'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                            {!! Form::close() !!}
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
@endsection
