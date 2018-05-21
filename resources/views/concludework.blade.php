จำนวนงานทั้งหมด{{count($jobs)}}<br>
จำนวนงานที่เสร็จแล้วทั้งหมด {{count($time_diff)}}<br>
@foreach($time_diff as $item)
    {{$item}}
@endforeach
<hr>
เวลารวม{{array_sum($time_diff)}}<br>
เวลาเฉลี่ย{{array_sum($time_diff)/count($time_diff)}}<br>
<HR>
งานที่ประเมินแล้วทั้งหมด {{count($satisfactions)}} <br>
คะแนนเต็ม 25 คะแนน <br>
@php($sum_avg = 0)
@foreach($satisfactions as  $key=>$satisfaction)
    ลำดับที่[{{$key+1}}]
    ได้คะแนน :
    {{$satisfaction->score1+$satisfaction->score2+$satisfaction->score3+$satisfaction->score4+$satisfaction->score5}}
    คะแนนความพึงพอใจเฉลี่ยของลำดับที่ [{{$key+1}}] :
    {{($satisfaction->score1+$satisfaction->score2+$satisfaction->score3+$satisfaction->score4+$satisfaction->score5)/5}}
    <br>
    @php($sum_avg=$sum_avg+(($satisfaction->score1+$satisfaction->score2+$satisfaction->score3+$satisfaction->score4+$satisfaction->score5)/5))
@endforeach
คะแนนเฉลี่ยของทั้งระบบ:
{{$sum_avg/count($satisfactions)}}<br>
@foreach($jobLessSend as $item)
    {{$item->id}}}
{{$item->problem}}}<br>
@endforeach