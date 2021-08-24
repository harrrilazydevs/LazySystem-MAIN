<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\employee_information;
use Illuminate\Http\Request;
use App\Http\Traits\LdLib;
use Storage;
use DB;

class DashboardController extends Controller
{

    /* LAZY DEV LIBRARY */
    use LdLib;
    

    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index()
    {
        // BASIC FORMAT

            $page_title = 'Dashboard';

            $page_subtitle = 'Dashboard';
            
            $page_settings = LdLib::PREPARE_PAGE($page_title, $page_subtitle);


        // END

        // CUSTOM

            if( $page_settings['role'] == 'DEVELOPER' )
            {
                $page_settings['role'] = ucfirst( strtolower( $page_settings['role'] ) );

                return view('pages/dashboard/developer/index', compact('page_settings'));
            }

        // END
        
    }
    
    public function changepassword()
    {

        // BASIC FORMAT

            $page_title = 'Change Password';

            $page_subtitle = 'Account Setting';
            
            $page_settings = LdLib::PREPARE_PAGE($page_title, $page_subtitle);
        
        // END
     
        $ld_nav_bread_crumb = array(
            [ 'Dashboard','/dashboard'],
            [ 'Profile','/dashboard/profile'],
            [ 'Change Password','SELECTED']
        );

        return view('pages/_common/user/change_password', compact( 'page_settings', 'ld_nav_bread_crumb' ));

    }

    public function profile()
    {
        // BASIC FORMAT 

            $page_title = 'Profile';

            $page_subtitle = 'User Profile';
            
            $page_settings = LdLib::PREPARE_PAGE($page_title, $page_subtitle);

            $ld_nav_bread_crumb = array(
                                            [ 'Dashboard','/dashboard'],
                                            [ 'Profile','SELECTED']
            );

        // END

        // CUSTOM

            $acc_data = User::all();

            $p_data = employee_information::all();

            $signature_url = Storage::url($p_data[0]->signature);

            $username = ucwords($p_data[0]->fname);

        // END

        return view('pages/_common/user/profile',compact( 'page_settings', 'ld_nav_bread_crumb', 'acc_data', 'p_data', 'username', 'signature_url',));

    }

    public function MDM_USERS()
    {   
        // BASIC FORMAT

            $page_title = 'Master Data Management';

            $page_subtitle = 'User Account';
            
            $page_settings = LdLib::PREPARE_PAGE($page_title, $page_subtitle);

            $ld_nav_bread_crumb = array(
                                            [ 'Dashboard','/dashboard'],
                                            [ 'User Account','SELECTED']
            );

        // END

        // PREPARE TABLE

            $table_title = 'User List';

            $t =   'users as a';

            $c =    [
                        'id',
                        'identifier',
                        'email',
                        'role',
            ];

            $table_contents = LdLib::__FETCH_DATA_TABLE($t,$c);

            $table_headers = array(
                                    [ 'Identifier','20'],
                                    [ 'Email','38'],
                                    [ 'Role','30'],
            );

            $table_body = array(
                                    [ 'identifier','text-center'],
                                    [ 'email','text-center'],
                                    [ 'role','text-center'],
            );

            $table_buttons = array(
                                    'view' =>
                                            [   
                                                'trigger' => 'mdm_view_user',
                                                'attribs' =>
                                                            [
                                                                ['ld-identifier','identifier'],
                                                                ['ld-email','email'],
                                                                ['ld-role','role'],
                                                            ],
                                            ],

                                    'edit' =>
                                            [   
                                                'trigger' => 'mdm_edit_user',
                                                'attribs' =>
                                                            [
                                                                ['ld-identifier','identifier'],
                                                                ['ld-email','email'],
                                                                ['ld-role','role'],
                                                            ],
                                            ],
            );

            $table_settings = LdLib::PREPARE_TABLE($table_headers,$table_body,$table_buttons);
    
        // END PREPARE TABLE

        // PREPARE WIDGET

            $widget_settings = LdLib::PREPARE_WIDGET(array(
                'r-add'=>'w_mdm_users_add',
                'r-archive'=>'w_mdm_users_archived',
                'i-excel'=>'w_mdm_users_i_excel',
                'i-sql'=>'w_mdm_users_i_sql',
                'e-pdf'=>'w_mdm_users_e_pdf',
                'e-excel'=>'w_mdm_users_e_excel',
            ));

            // dd($widget_settings);

        // END PREPARE WIDGET

        return view('pages/_templates/tabular_list_view',compact(
            'page_settings',
            'table_settings',
            'widget_settings',
            'table_contents',
            'ld_nav_bread_crumb',
            'table_title',
        ));

    }

    public function MDM_EMPLOYEES()
    {   
        // BASIC FORMAT

            $page_title = 'Master Data Management';

            $page_subtitle = 'Employee';
            
            $page_settings = LdLib::PREPARE_PAGE($page_title, $page_subtitle);

            $ld_nav_bread_crumb = array(
                                            [ 'Dashboard','/dashboard'],
                                            [ ' Employee','SELECTED']
            );

        // END

        // CUSTOM

            $table_title = 'Employee List';

            $t =    LdLib::$_MAIN_TBL_EMPLOYEE_INFORMATION.' as a';

            $c =    [
                        'a.employee_code',
                        DB::RAW('CONCAT(fname," ",mname," ",lname) as name'),
                        'employee_role',
                        'employee_department',
            ];

            $j =    [
                        ['employee_list as b','b.employee_code','=','a.employee_code'],
            ];

            $table_contents = LdLib::__FETCH_DATA_TABLE($t,$c,$j);

            $table_headers = array(
                                    [ 'Employee Code','20'],
                                    [ 'Name','38'],
                                    [ 'Position','15'],
                                    [ 'Department','15']
            );

            $table_body = array(
                                    [ 'employee_code','text-center'],
                                    [ 'name','text-center'],
                                    [ 'employee_role','text-center'],
                                    [ 'employee_department','text-center']
            );

            $table_buttons = array(
                                    'view' =>['employee_code','mdm_view_employee'],

            );

            $table_buttons = array(
                                    'view' =>
                                            [   
                                                'trigger' => 'mdm_view_employee',
                                                'attribs' =>
                                                            [
                                                                ['ld-employee_code','employee_code'],
                                                            ],
                                            ],
            );

            $table_settings = LdLib::PREPARE_TABLE($table_headers,$table_body,$table_buttons);

        // END

        return view('pages/_templates/tabular_list_view',compact('page_settings','table_settings','table_contents','ld_nav_bread_crumb','table_title'));

    }

    public function MDM_CLASSROOM()
    {
                    // BASIC FORMAT

                        $page_title = 'Master Data Management';

                        $page_subtitle = 'Classroom';
                        
                        $page_settings = LdLib::PREPARE_PAGE($page_title, $page_subtitle);

                        $ld_nav_bread_crumb = array(
                                                        [ 'Dashboard','/dashboard'],
                                                        [ 'Classroom','SELECTED']
                        );

                    // END

                    // PREPARE TABLE

                    $table_title = 'Classroom List';

                    $t =   'classroom_test as a';

                    $c =    [
                                'no',
                                'classroom_name',
                                'classroom_description',
                                'classroom_status',
                    ];

                    $table_contents = LdLib::__FETCH_DATA_TABLE($t,$c);

                    $table_headers = array(
                                            [ 'Classroom Name','15'],
                                            [ 'Description','30'],
                                            [ 'Status','15'],
                    );

                    $table_body = array(

                                            [ 'classroom_name','text-center'],
                                            [ 'classroom_description','text-left'],
                                            [ 'classroom_status','text-center',
                                                [
                                                    'LD-PILLS' => 
                                                                ['PILL-RED','OCCUPIED','140'],
                                                                ['PILL-BLUE','UNDER MAINTENANCE','140'],
                                                                ['PILL-GREEN','VACANT','140'],
                                                                ['PILL-YELLOW','UNDER CONSTRUCTION','140'],
                                                ]
                                            ],
                                            
                    );

                    $table_buttons = array(
                                            'view' =>
                                                    [   
                                                        'trigger' => 'mdm_view_classroom',
                                                        'attribs' =>
                                                                    [
                                                                        ['ld-identifier','no'],
                                                                        ['ld-name','classroom_name'],
                                                                        ['ld-desc','classroom_description'],
                                                                    ],
                                                    ],

                                            'edit' =>
                                                    [   
                                                        'trigger' => 'mdm_edit_classroom',
                                                        'attribs' =>
                                                                    [
                                                                        ['ld-identifier','no'],
                                                                        ['ld-name','classroom_name'],
                                                                        ['ld-desc','classroom_description'],
                                                                    ],
                                                    ], 

                                            'delete' =>
                                                    [   
                                                        'trigger' => 'mdm_delete_classroom',
                                                        'attribs' =>
                                                                    [
                                                                        ['ld-identifier','no'],
                                                                        ['ld-name','classroom_name'],
                                                                        ['ld-desc','classroom_description'],
                                                                    ],
                                                    ], 
                    );

                    $table_settings = LdLib::PREPARE_TABLE($table_headers,$table_body,$table_buttons);

                    // END PREPARE TABLE

                    // PREPARE WIDGET

                    $widget_settings = LdLib::PREPARE_WIDGET(array(
                        'r-add'=>'mdm_insert_classroom',
                        // 'r-archive'=>'w_mdm_users_archived',
                        'i-excel'=>'w_mdm_users_i_excel',
                        'i-sql'=>'w_mdm_users_i_sql',
                        'e-pdf'=>'w_mdm_users_e_pdf',
                        'e-excel'=>'w_mdm_users_e_excel',
                    ));

                    // dd($widget_settings);

                    // END PREPARE WIDGET

                    return view('pages/_templates/tabular_list_view',compact(
                    'page_settings',
                    'table_settings',
                    'widget_settings',
                    'table_contents',
                    'ld_nav_bread_crumb',
                    'table_title',
                    ));


    }
   

    

}
