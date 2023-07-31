<?php $dates = ['created_at','updated_at','date'] ?>
<div class="model-view">
    <table class="table" style="">
        @foreach($keys as $key)
        <tr>
            <th>{{ strtoupper(str_replace('_',' ',$key)) }}</th>
            <td>
                @if(isset($custom_functions[$key]))
                    {!! $custom_functions[$key]($model) !!}
                @elseif(in_array($key,$dates))
                    {!! $model->$key->toDayDateTimeString() !!}
                @else
                    {!! $model->$key !!}
                @endif
            </td>
        </tr>
            @endforeach
    </table>
</div>
