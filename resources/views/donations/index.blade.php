@extends('layouts.app')
@section('page_title')
    تعديل التبرع
@endsection

@extends('layouts.app')
@inject('donation','App\DonationRequest')
@section('page_title')
    التبرعات
@endsection

@section('content')


    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">كل التبرعات</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المريض</th>
                                <th>العمر</th>
                                <th>عدد أكياس الدم</th>
                                <th>اسم المستشفى</th>

                                <th>الهاتف</th>
                                <th>المدينة</th>
                                <th>فصيلة الدم</th>

                                <th class="text-center">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr id="removable{{$record->id}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->patient_name}}</td>
                                    <td class="text-center">{{$record->patient_age}}</td>
                                    <td class="text-center">{{$record->blood_number}}</td>
                                    <td class="text-center">{{$record->hospital_name}}</td>

                                    <td class="text-center">{{$record->phone}}</td>
                                    <td class="text-center">{{optional($record->city)->name}}</td>
                                    <td class="text-center">{{optional($record->blood_type)->name}}</td>

                                    <td class="text-center">
                                        {!!Form::open([
                                    'action' =>['DonationController@destroy',$record->id],
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
                    <p class="text-center">لا يوجد تبرعات !!</p>
                @endif
            </div>

        </div>


    </section>
@endsection