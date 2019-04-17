@extends('layouts.app')


@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">

                <h3 class="box-title">CREATE Post</h3>
                <div class="box-body">

                    @include('partials.validation_errors')

                    {!! Form::model($model,[
                    'action'=>['PostController@update',$model->id],
                    'method' => 'put',
                    'files' =>true

                    ]) !!}
                    <div class="form-group">
                        <label for="title_post">العنوان</label>
                        {!! Form::text('title_post',null,[
                        'class' => 'form-control'
                     ]) !!}
                        <label for="content_post">المحتوى</label>
                        {!! Form::text('content_post',null,[
                        'class' => 'form-control'
                     ]) !!}
                        <label class="form-control" for="image">اختر صورة : </label>
                        {!! Form::file('image', [
                        'class'=>'form-control'

                       ]) !!}

                        @inject('categories','App\Category')

                        <label class="form-control" for="select">القسم :</label>
                        {!! Form::select('category_id',$categories->pluck('name','id'),null,[
                            'class' => 'form-control'
                         ]) !!}
                        <label class="form-control" for="puplish_date">تاريخ النشر :  </label>
                        {{ Form::date('puplish_date', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit"> حفظ</button>
                    </div>



                    {!! form::close() !!}
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
@endsection
