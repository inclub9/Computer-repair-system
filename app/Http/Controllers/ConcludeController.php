<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Job;
use App\Satisfaction;
use App\SystemUser;
use App\Techonjob;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Charts;
use Carbon\Carbon;

class ConcludeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:manager');
    }

    public function index()
    {
        $jobs_id = Job::select('id')->get();
        //dd($jobs_id[0]->id);
        $start_job = 0;
        $accept_job = 0;
        $check_job = 0;
        $process_job = 0;
        $claim_job = 0;
        $complete_job = 0;
        $waiting_satisfaction_job = 0;
        $satisfaction_complete_job = 0;
        foreach ($jobs_id as $job_id) {
            //echo $job_id->id;
            $comments = Comment::all()->where('job_id', '=', $job_id->id)->last();
            //echo $comments->id.$comments->status_id.'<br>';
            if ($comments->status_id == 'งานใหม่') {
                $start_job = $start_job + 1;
            } elseif ($comments->status_id == 'ช่างรับงานซ่อม') {
                $accept_job = $accept_job + 1;
            } elseif ($comments->status_id == 'ตรวจสอบข้อมูลงานซ่อม') {
                $check_job = $check_job + 1;
            } elseif ($comments->status_id == 'ดำเนินการซ่อม') {
                $process_job = $process_job + 1;
            } elseif ($comments->status_id == 'ส่งเคลม') {
                $claim_job = $claim_job + 1;
            } elseif ($comments->status_id == 'ซ่อมเสร็จสิ้น') {
                $complete_job = $complete_job + 1;
            } elseif ($comments->status_id == 'รอผลความพึงพอใจในงานซ่อม') {
                $waiting_satisfaction_job = $waiting_satisfaction_job + 1;
            } elseif ($comments->status_id == 'ประเมินผลความพึงพอใจในงานซ่อมแล้ว') {
                $satisfaction_complete_job = $satisfaction_complete_job + 1;
            }
        }
        $chartAllJob = Charts::create('pie', 'highcharts')
            ->title('แผนภาพวงกลมของสถานะงานทั้งหมดในระบบ')
            ->labels(['งานใหม่', 'ช่างรับงานซ่อม', 'ตรวจสอบข้อมูลงานซ่อม', 'ส่งเคลม', 'ดำเนินการซ่อม', 'รอผลความพึงพอใจในงานซ่อม', 'ประเมินผลความพึงพอใจในงานซ่อมแล้ว'])
            ->values([
                $start_job,
                $accept_job,
                $check_job,
                $claim_job,
                $process_job,
                $waiting_satisfaction_job,
                $satisfaction_complete_job,
            ])
            ->dimensions(1000, 500)
            ->responsive(true);


//$test[] = ['test','test2'];
        $systemusers = SystemUser::all()->where('department_id', '=', '2');
        $arr_systenuser = [];
        $arr_coutJob = [];
        foreach ($systemusers as $systemuser) {
            array_push($arr_systenuser, $systemuser->name);
            $count = Techonjob::where('systemuser_id', '=', $systemuser->id)->count();
            array_push($arr_coutJob, $count);
        }
        $TechOnJob = Charts::create('donut', 'highcharts')
            ->title('การทำงานของช่างแต่ละคนในระบบ')
            ->labels($arr_systenuser)
            ->values($arr_coutJob)
            ->dimensions(1000, 500)
            ->responsive(true);

        $types = Type::all()->toArray();
        $arr_types = [];
        $arr_types_id = [];
        $arr_types_count = [];
        //dd($types[0]['name']);
        foreach ($types as $item) {
            //echo $item['name'];
            //dd($item['name']);
            //dd($item['id']);
            array_push($arr_types, $item['name']);
            array_push($arr_types_id, $item['id']);
            array_push($arr_types_count, Job::where('type_id', $item['id'])->count());
        }
        //dd($arr_types);
        $type_job = Charts::create('pie', 'highcharts')
            ->title('งานในแต่ละประเภท')
            ->labels($arr_types)
            ->values($arr_types_count)
            ->dimensions(1000, 500)
            ->responsive(true);


        $jobs = Job::all();
        $comments_finished = new Collection();
        $cou = 0;
        foreach ($jobs as $job) {
            //echo $job->id.'<br>';
            $comments = Comment::where('job_id', '=', $job->id)->where('status_id', '=', 'รอผลความพึงพอใจในงานซ่อม')->get();
            foreach ($comments as $comment) {
                $comments_finished = $comments_finished->merge($comment->job_id);
            }
            $cou = $cou + 1;
        }
        //dd($comments_finished);
        $time_diff = [];
        foreach ($comments_finished as $item) {
            //echo $item;
            $start = Comment::select('created_at')->where('job_id', $item)->first();
            $start = Carbon::parse($start->created_at);
            //dd($start);
            $end = Comment::where('job_id', $item)->where('status_id', '=', 'รอผลความพึงพอใจในงานซ่อม')->get();
            foreach ($end as $itemEnd) {
                $end = Carbon::parse($itemEnd->created_at);
            }
            //dd($end);
            array_push($time_diff, $start->diffInMinutes($end));
            //<----จบการหาส่วนต่างของเวลา--->
        }
        $satisfactions = Satisfaction::all();

        $jobs_less = Job::select('id')->get();
        //dd($jobs_less->toArray());
        $id_job_not_com = new Collection();
        foreach ($jobs_less as $less) {
            //dd($less->id);
            $comments = Comment::all()->where('job_id', '=', $less->id)
                ->whereNotIn('status_id', ['งานใหม่', 'ช่างรับงานซ่อม', 'ตรวจสอบข้อมูลงานซ่อม', 'ดำเนินการซ่อม', 'ส่งเคลม'])->toArray();
            if (empty($comments)) {
                $id_job_not_com = $id_job_not_com->merge($less->id);
            }
        }
        //dd($id_job_not_com);
        $jobLessSend = new Collection();
        foreach ($id_job_not_com as $co=>$item){
            if ($co == 10) break;
            $jobLessSend = $jobLessSend->merge(Job::where('id','=',$item)->get());
        }
        //dd($jobLessSend);

        return view('conclude', ['chartAllJob' => $chartAllJob, 'TectOnJob' => $TechOnJob, 'type_job' => $type_job]
            , compact('time_diff', 'jobs', 'satisfactions','jobLessSend'));
    }


    public function finished_work_time()
    {
        $jobs = Job::select('id')->get();
        $comments_finished = new Collection();
        $cou = 0;
        foreach ($jobs as $job) {
            //echo $job->id.'<br>';
            $comments = Comment::where('job_id', '=', $job->id)->where('status_id', '=', 'รอผลความพึงพอใจในงานซ่อม')->get();
            foreach ($comments as $comment) {
                $comments_finished = $comments_finished->merge($comment->job_id);
            }
            $cou = $cou + 1;
        }
        //dd($comments_finished);
        $time_diff = [];
        foreach ($comments_finished as $item) {
            //echo $item;
            $start = Comment::select('created_at')->where('job_id', $item)->first();
            $start = Carbon::parse($start->created_at);
            //dd($start);
            $end = Comment::where('job_id', $item)->where('status_id', '=', 'รอผลความพึงพอใจในงานซ่อม')->get();
            foreach ($end as $itemEnd) {
                $end = Carbon::parse($itemEnd->created_at);
            }
            //dd($end);
            array_push($time_diff, $start->diffInMinutes($end));
            //<----จบการหาส่วนต่างของเวลา--->
        }
        $satisfactions = Satisfaction::all();


        $jobs_less = Job::select('id')->get();
        //dd($jobs_less->toArray());
        $id_job_not_com = new Collection();
        foreach ($jobs_less as $less) {
            //dd($less->id);
            $comments = Comment::all()->where('job_id', '=', $less->id)
                ->whereNotIn('status_id', ['งานใหม่', 'ช่างรับงานซ่อม', 'ตรวจสอบข้อมูลงานซ่อม', 'ดำเนินการซ่อม', 'ส่งเคลม'])->toArray();
            if (empty($comments)) {
                $id_job_not_com = $id_job_not_com->merge($less->id);
            }
        }
        //dd($id_job_not_com);
        $jobLessSend = new Collection();
        foreach ($id_job_not_com as $item){
            $jobLessSend = $jobLessSend->merge(Job::where('id','=',$item)->get());
        }
        //dd($jobLessSend);

        return view('concludework', compact('time_diff', 'jobs', 'satisfactions','jobLessSend'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
