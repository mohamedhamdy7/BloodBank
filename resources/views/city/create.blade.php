@extends('layouts.app')
@inject('model','App\city')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">

                <h3 class="box-title">CREATE City</h3>
                <div class="box-body">

                    @include('partials.validation_errors')

                    {!! Form::model($model,[
                    'action'=>'citycontroller@store'
                    ]) !!}
                    <div class="form-group">

                        <label for="name">city</label>
                        {!! form::text('name',null,[
                        'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">

                        @inject('governorates','App\Governorate')
                        <label for="governorate_id">Governorate</label>
                        {!! form::select('governorate_id',$governorates->pluck('name','id'),null,[
                        'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">ADD</button>
                    </div>

                    {!! form::close() !!}
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
@endsection
