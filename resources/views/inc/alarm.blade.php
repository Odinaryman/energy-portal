{!! Form::open(['action' => 'AlarmsController@store', 'method' => 'POST']) !!}
@csrf
    <div class="form-group">
        <strong>{{Form::label('title', 'First Warning')}}</strong>
        <!--{{Form::select('first', ['12000'=> '12000kwh', '500' => '500KWH', '450' => '450KWH', '400' => '400KWH', '350' => '350KWH', '300' => '300KWH', '250' => '250KWH', '200' => '200KWH'], '', ['class' => 'form-control', 'placeholder' => '200KWH'],  [])}}-->
        {{Form::text('first', $trigger_unit_1, ['onkeydown' => 'return numberCheck(event,this)', 'class' => 'form-control', 'placeholder' => 'Type first trigger value', 'required'])}}
    </div>
    <div class="form-group">
        <strong>{{Form::label('title', 'Second Warning')}}</strong>
        <!--{{Form::select('second', ['200' => '200KWH', '150' => '150KWH', '100' => '100KWH', '50' => '50KWH'], '', ['class' => 'form-control', 'placeholder' => '50KWH'],  [])}}-->
        {{Form::text('second', $trigger_unit_2, ['onkeydown' => 'return numberCheck(event,this)', 'class' => 'form-control', 'placeholder' => 'Type second trigger value', 'required'])}}
    </div>
    <strong>{{Form::submit('SUBMIT', ['class' => 'btn btn-success alert-btn login-btn alert-btn'])}}</strong>
{!! Form::close() !!}
