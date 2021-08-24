<?php
namespace App\Http\Traits;
use Auth;
use DB;
use Storage;
use Schema;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\User;

trait LdLib
{
    /*****************************************************************************************************/
    // CONFIGURATION VARIABLES HERE

    // DEFINE MAIN TABLES HERE
    public static $_MAIN_TBL_EMPLOYEE_INFORMATION = 'employee_information';
    public static $_MAIN_TBL_EMPLOYEE_LIST = 'employee_list';
    public static $_MAIN_TBL_STUDENT_INFORMATION = 'student_personal_information';

    // DEFINE UPLOAD PATHS HERE
    public static $_IMG_PATH_EMPLOYEE = '/public/img/employee_images';

    // VARIABLES
    public static $WIDGETS_DEFAULT_SETTING = array(
        'record' =>['r-add' => [], 'r-archive' => []],
        'import' =>['i-excel' => [],'i-sql' => []],
        'export' =>['e-pdf' => [],'e-excel' => []]
    );


    /*****************************************************************************************************/

    public static function GET_SIDEBAR_CONTENTS( $identifier ){

        if( LdLib::GET_USER_ROLE( $identifier ) == 'DEVELOPER' )
        {
            $ld_sidebar = array(
                                    
                                [
                                    'ADMIN MENU',
                                        [ 
                                            [ 'Dashboard','nav-item','fas fa-home','/dashboard'],
                                            [ 'Master Data Management','collapse','fas fa-database','collapse1',
                                                [
                                                    ['User Account','nav-item','fab fa-gg-circle','/dashboard/mdm/users'],
                                                    ['Student','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['Employee','nav-item','fab fa-gg-circle','/dashboard/mdm/employee'],
                                                    ['Program','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['School','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['Course','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['Curriculum','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['Campus','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['Building & Room','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['Fees & Tuition','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['Discount & Scholarship','nav-item','fab fa-gg-circle','/dashboard'],
                                                    ['Classroom','nav-item','fab fa-gg-circle','/dashboard/mdm/classroom'],
                                                ]
                                            ],
                                            [ 'System Configuration','collapse','fas fa-cogs','collapse2',
                                                [
                                                    ['System User & Accessibility','nav-item','fas fa-cog','/dashboard'],
                                                    ['System Alert & Messages','nav-item','fas fa-cog','/dashboard'],
                                                    ['Academic Term Setup','nav-item','fas fa-cog','/dashboard'],
                                                    ['Email Setup','nav-item','fas fa-cog','/dashboard'],
                                                    ['Grading Setup','nav-item','fas fa-cog','/dashboard'],
                                                ]
                                            ],
                                            [ 'System Templates','collapse','far fa-clone','collapse3',
                                                [
                                                    ['Excel Import Template','nav-item','fas fa-cog','/dashboard'],
                                                ]
                                            ],
                                    ]
                                ], 
            );

            return $ld_sidebar;
        }

    }

    public static function GET_PROFILE_URL( $user_role, $identifier ){

        if( $user_role == 'EMPLOYEE' )
        {

            $t =    LdLib::$_MAIN_TBL_EMPLOYEE_INFORMATION;

            $c =    [
                        'picture'
                    ];
        
            $w =    [
                        ['employee_code', '=', $identifier]
                    ];
        }
        else
        {
            $t =    LdLib::$_MAIN_TBL_STUDENT_INFORMATION;

            $c =    [
                        'picture'
                    ];
        
            $w =    [
                        ['student_no', '=', $identifier]
                    ];
        }

        $p_data = LdLib::__FETCHDATA($t,$c,null,$w);

        return Storage::url($p_data[0]->picture);

    }

    public static function GET_USER_ROLE( $id ){

        $t= LdLib::$_MAIN_TBL_EMPLOYEE_LIST;

        $c= ['employee_role'];

        $w= [
                ['employee_code','=',$id]
            ];

        $data= LdLib::__FETCHDATA($t,$c,null,$w);
     
        return $data[0]->employee_role;

    }

    public static function GET_USER_NAME( $id, $role ){

        if( $role == 'EMPLOYEE')
        {
            $t= LdLib::$_MAIN_TBL_EMPLOYEE_INFORMATION;

            $w= [
                    ['employee_code','=',$id]
                ];
        }
        else
        {
            $t= LdLib::$_MAIN_TBL_STUDENT_INFORMATION;

            $w= [
                    ['student_no','=',$id]
                ];
        }

        $c= ['fname','lname'];

        $data= LdLib::__FETCHDATA($t,$c,null,$w);

        return ucwords($data[0]->fname.' '.$data[0]->lname);

    }

    public static function PREPARE_PAGE( $page_title, $page_subtitle ){

        $id = Auth::user()->id;

        $identifier = Auth::user()->identifier;

        $user_role = Auth::user()->role;

        if( $user_role == 'EMPLOYEE' )
        {
            $role = LdLib::GET_USER_ROLE( $identifier );
        }
        else
        {
            $role = 'STUDENT';
        }

        $profile_url = LdLib::GET_PROFILE_URL($user_role, $identifier);

        $user_name = LdLib::GET_USER_NAME( $identifier, $user_role );

        $ld_sidebar = LdLib::GET_SIDEBAR_CONTENTS( $identifier );

        $page_settings = array(
                                'role' => $role,
                                'id' => $id,
                                'identifier' => $identifier,
                                'profile_url' => $profile_url,
                                'ld_sidebar' => $ld_sidebar,
                                'page_title' => $page_title,
                                'page_subtitle' => $page_subtitle,
                                'user_name' => $user_name,
        );

        return $page_settings;

    }

    public static function PREPARE_TABLE( $HEADERS, $BODY, $BUTTONS ){

        return $table_settings = array (    
                                            'headers'=>$HEADERS,
                                            'body'=> $BODY,
                                            'buttons'=>array($BUTTONS),
                                );
        
    }

    public static function PREPARE_WIDGET( $functions ){

        foreach ($functions as $fkey => $fval) {

            foreach (LdLib::$WIDGETS_DEFAULT_SETTING as $dkey => $dval) {

                foreach ($dval as $dfkey => $default_function) {

                    if( $fkey == $dfkey )
                    {
                        LdLib::$WIDGETS_DEFAULT_SETTING[$dkey][$dfkey] = $fval;
                    }

                }

            }

        }

        return LdLib::$WIDGETS_DEFAULT_SETTING;

    }



    
    


    public static function __FETCH_DATA_TABLE($TABLE, $COLUMN, $_JOIN = null, $_WHERE = null, $_GRPBY = null, $_ORDBY = null, $_LJOIN = null, $_WHEREOR = null,$_WHEREIN = null, $_WHERENOTIN = null)
    {   
        
        if ( $COLUMN[0] == '*' ){

            $TABLE_COLUMNS = Schema::getColumnListing($TABLE);

        }
        else{
            
            for ($i=0; $i < sizeof($COLUMN) ; $i++) { 

                if(strpos($COLUMN[$i], 'concat')  !== false){

                    $COLUMN[$i] = DB::raw($COLUMN[$i]);

                }
            }
            
            $TABLE_COLUMNS = $COLUMN;

        }

        $DATA = DB::table($TABLE);

        $DATA->select($TABLE_COLUMNS);

        if( isset($_JOIN) )
        {
    
            foreach ($_JOIN as $key => $val) {
    
                $DATA->join($val[0],$val[1],$val[2],$val[3]);
    
            }
        }
    
        if( isset($_LJOIN) )
        {
    
            foreach ($_LJOIN as $key => $val) {
    
                $DATA->leftjoin($val[0],$val[1],$val[2],$val[3]);
    
            }
        }
    
        if( isset($_WHERE) )
        {
    
            $DATA->where($_WHERE);
    
        }
    
        if( isset($_GRPBY) )
        {
    
            $DATA->groupBy($_GRPBY);
    
        }
        if( isset($_ORDBY) )
        {

            if(is_array($_ORDBY[0])) 
            {

                foreach ($_ORDBY as $key => $val) {

                    $DATA->orderBy($val[0],$val[1]);
                    
                }

            }
            else
            {

                $DATA->orderBy($_ORDBY[0],$_ORDBY[1]);

            }
          
        }
        if( isset($_WHEREOR) )
        {
    
            foreach ($_WHEREOR as $key => $val) {
    
                $DATA->orWhere($val[0],$val[1],$val[2]);
    
            }
    
        }

        if( isset($_WHEREIN) )
        {
    
            foreach ($_WHEREIN as $key => $val) {
    
                $DATA->whereIn($val[0],[$val[1]]);
    
            }
    
        }

        if( isset($_WHERENOTIN) )
        {

            $DATA->whereNotIn($_WHERENOTIN[0],$_WHERENOTIN[1]);
    
        }

        return $DATA->paginate(15);

    }
    public static function __FETCHDATA($TABLE, $COLUMN, $_JOIN = null, $_WHERE = null, $_GRPBY = null, $_ORDBY = null, $_LJOIN = null, $_WHEREOR = null,$_WHEREIN = null, $_WHERENOTIN = null)
    {   
        
        if ( $COLUMN[0] == '*' ){

            $TABLE_COLUMNS = Schema::getColumnListing($TABLE);

        }
        else{
            
            for ($i=0; $i < sizeof($COLUMN) ; $i++) { 

                if(strpos($COLUMN[$i], 'concat')  !== false){

                    $COLUMN[$i] = DB::raw($COLUMN[$i]);

                }
            }
            
            $TABLE_COLUMNS = $COLUMN;

        }

        $DATA = DB::table($TABLE);

        $DATA->select($TABLE_COLUMNS);

        if( isset($_JOIN) )
        {
    
            foreach ($_JOIN as $key => $val) {
    
                $DATA->join($val[0],$val[1],$val[2],$val[3]);
    
            }
        }
    
        if( isset($_LJOIN) )
        {
    
            foreach ($_LJOIN as $key => $val) {
    
                $DATA->leftjoin($val[0],$val[1],$val[2],$val[3]);
    
            }
        }
    
        if( isset($_WHERE) )
        {
    
            $DATA->where($_WHERE);
    
        }
    
        if( isset($_GRPBY) )
        {
    
            $DATA->groupBy($_GRPBY);
    
        }
        if( isset($_ORDBY) )
        {

            if(is_array($_ORDBY[0])) 
            {

                foreach ($_ORDBY as $key => $val) {

                    $DATA->orderBy($val[0],$val[1]);
                    
                }

            }
            else
            {

                $DATA->orderBy($_ORDBY[0],$_ORDBY[1]);

            }
          
        }
        if( isset($_WHEREOR) )
        {
    
            foreach ($_WHEREOR as $key => $val) {
    
                $DATA->orWhere($val[0],$val[1],$val[2]);
    
            }
    
        }

        if( isset($_WHEREIN) )
        {
    
            foreach ($_WHEREIN as $key => $val) {
    
                $DATA->whereIn($val[0],[$val[1]]);
    
            }
    
        }

        if( isset($_WHERENOTIN) )
        {

            $DATA->whereNotIn($_WHERENOTIN[0],$_WHERENOTIN[1]);
    
        }

        return $DATA->get();

    }

    public static function __FETCHLATESTCODE($TABLE, $COLUMN, $ORDERBY, $ARR, $PAD)
    {
        if ($COLUMN == '*'){

            $TABLE_COLUMNS = Schema::getColumnListing($TABLE);
        }
        else{

            $TABLE_COLUMNS = $COLUMN;
        }

        $DATA = DB::table($TABLE);

        $DATA->select($TABLE_COLUMNS);

        $DATA->orderBy($ORDERBY, $ARR);

        if($DATA->pluck($TABLE_COLUMNS)->count()>0){

            $TEMP_CODE = $DATA->pluck($TABLE_COLUMNS)[0];
            
            if(!strpos($TEMP_CODE, '-')){

                $LATESTCODE = $TEMP_CODE += 1;
            }
            else{

                $TEMP = Str::of($TEMP_CODE)->after('-');

                $TEMP = (string) $TEMP;

                $TEMP1 = $TEMP += 1;

                $TEMP1 = str_pad($TEMP1,$PAD,"0",STR_PAD_LEFT);

                $TEMP = Str::of($TEMP_CODE)->before('-');

                $LATESTCODE = $TEMP.'-'.$TEMP1;
            }

            return $LATESTCODE;
        }
 

    }

    public static function __STORE($TABLE, $DATA)
    {
        DB::table($TABLE)->insert($DATA);
    }

    public static function __UPDATE($TABLE, $DATA, $PRIMARY)
    {
        // dd($DATA);
        // dd($PRIMARY);
        DB::table($TABLE)->where($PRIMARY,'=', $DATA[$PRIMARY])->update($DATA);
    }

    public static function __DESTROY($TABLE, $TABLECOLUMN, $PRIMARYCODE, $CUSTOM=false)
    {   
        if($CUSTOM)
        {
        
            DB::table($TABLE)->where($TABLECOLUMN[2],'=', $PRIMARYCODE)->delete();

        }
        else
        {

            DB::table($TABLE)->where($TABLECOLUMN[0],'=', $PRIMARYCODE)->delete();

        }
    }







































    // public static function getSubjects()
    // {
    //     $subjects = DB::table('subjects')
    //     ->select(
    //                 'subject_code', 
    //                 'name', 
    //                 'category',
    //                 'units'
    //             )
    //     ->get();
    //     return $subjects;
    // }

   


    // public static function getStudentName()
    // {   
    //     $name = DB::table('student_profile')
    //     ->select(
    //                 DB::raw("CONCAT(fname,' ',lname) AS name"),
    //                 'student_profile.stud_id AS studentid'
    //             )
    //     ->join('student_account', 'student_account.stud_id', '=', 'student_profile.stud_id')
    //     ->where('student_account.userid','=',Auth::user()->id)
    //     ->get();

    //     return $name;
    // }
    // public static function getClasses()
    // {       
    //     $classes = classes::select (
    //                                 'classes.id as no',
    //                                 'users.name as created',
    //                                 'created_date as date',
    //                                 'professor_profile.name as professor',
    //                                 'section',
    //                                 'room',
    //                                 'max_student as maxstudent'
    //                             )
    //             ->join('professor_profile', 'professor_profile.id', '=', 'classes.adviser')
    //             ->join('users', 'users.id', '=', 'classes.created_by')
    //             ->get();
    //     return $classes;
    // }



    // public static function getFilter($f)
    // {   
    //     if( $f == 'enlistment')
    //     {   
    //         $obj =  enlistment::select(
    //                                     'subjects.subject_code as code', 
    //                                     'subjects.name as subject'
    //                                 )
    //             ->join('subjects', 'subjects.subject_code', '=', 'enlistment.subject_code')
    //             ->where('approving_adviser','=',Auth::user()->id)
    //             ->groupBy('subjects.name')
    //             ->get();
    //     }
    //     else if( $f == 'dean')
    //     {   

    //     }

    //     return $obj;
    // }

    // public static function getEnlistedStudents(){

    //     $enlistment = DB::table('enlistment')
    //         ->select(   
    //                     'subjects.subject_code as subjectCode', 
    //                     'subjects.name as subject', 
    //                     DB::raw('concat(student_profile.fname," ",student_profile.mname," ",student_profile.lname) as student'), 
    //                     'users.name as approving', 
    //                     'enlistment_date as date',
    //                     'units'
    //                 )
    //         ->join('student_profile', 'student_profile.stud_id', '=', 'enlistment.stud_id')
    //         ->join('subjects', 'subjects.subject_code', '=', 'enlistment.subject_code')
    //         ->join('users', 'users.id', '=', 'enlistment.approving_adviser')
    //         ->where('approving_adviser', '=', Auth::user()->id)
    //         ->get();
    //     return $enlistment;
    // }
    // public static function getEnlistments($role)
    // {
    //     $user = User::findOrFail(Auth::user()->id);

    //     if( $role == 'adviser' ){

    //         $enlistment = DB::table('enlistment')
    //         ->select(   
    //                     'subjects.subject_code as subjectCode', 
    //                     'subjects.name as subject', 
    //                     DB::raw('concat(student_profile.fname," ",student_profile.mname," ",student_profile.lname) as student'), 
    //                     'users.name as approving', 
    //                     'enlistment_date as date',
    //                     'units'
    //                 )
    //         ->join('student_profile', 'student_profile.stud_id', '=', 'enlistment.stud_id')
    //         ->join('subjects', 'subjects.subject_code', '=', 'enlistment.subject_code')
    //         ->join('users', 'users.id', '=', 'enlistment.approving_adviser')
    //         ->where('approving_adviser', '=', Auth::user()->id)
    //         ->get();

    //     }
    //     else if( $role == 'student' ){

    //         $enlistment = DB::table('enlistment')
    //         ->select(   
    //                     'subjects.subject_code as subjectCode', 
    //                     'subjects.name as subject', 
    //                     DB::raw('concat(student_profile.fname," ",student_profile.mname," ",student_profile.lname) as student'), 
    //                     'users.name as approving', 
    //                     'enlistment_date as date',
    //                     'units',
    //                     'current_status as status'
    //                 )
    //         ->join('student_profile', 'student_profile.stud_id', '=', 'enlistment.stud_id')
    //         ->join('subjects', 'subjects.subject_code', '=', 'enlistment.subject_code')
    //         ->join('student_account', 'student_account.stud_id', '=', 'enlistment.stud_id')
    //         ->join('users', 'users.id', '=', 'enlistment.approving_adviser')
    //         ->where('student_account.userid', '=', Auth::user()->id)
    //         ->get();
    //     }
    //     else if( $role == 'registrar' ){    


    //         $enlistment = DB::table('enlistment')
    //         ->select(   
    //                     'subjects.subject_code as subjectCode', 
    //                     'subjects.name as subject', 
    //                     DB::raw('count(subjects.subject_code) as "no"')
    //                 )
    //         ->join('subjects', 'subjects.subject_code', '=', 'enlistment.subject_code')
    //         ->where('current_status', '=', 'Approved')
    //         ->groupBy('subjects.name')
    //         ->get();

    //         // dd($enlistment);
    //     }


    //     return $enlistment;
    // }

    
    // public static function getStudents()
    // {
    //     $subjects = DB::table('subjects')
    //     ->select(
    //                 'subject_code', 
    //                 'name', 
    //                 'category'
    //             )
    //     ->get();
    //     return $subjects;
    // }






    

}
