<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
use View;
use response;
use Schema;
use Exporter;
use Storage;
use App\Models\User;
use App\Http\Traits\LdLib as library;

class LazyController extends Controller
{
 
    use library;

     

    public function INIT_TABLES($INPUT)
    {
        $tables =   [
                        'employee_information',     #0
                        'users',                    #1
                        'classroom_test',           #2
                    ];

        return $tables[$INPUT];
    }



    public function INIT_CONDITIONS($INPUT)
    {
        $conditions =   [
                        "=", 
                        ">", 
                        "<", 
                        ">=", 
                        "<=", 
                        "!=", 
                    ];

        return $conditions[$INPUT];
    }

    public function __FETCH($DATA)
    {
        
        $c = null;

        $j = null;

        $w = null;

        $g = null;

        $o = null;

        $lj = null;

        $wo = null;

        $wi = null;

        $DATA = base64_decode($DATA);

        $INPUT = $this->cryptoJsAesDecrypt('mlqu-hash-password-2021',$DATA);

        $TABLE = $this->INIT_TABLES( $INPUT["v1"] );

        $TABLE_COLUMNS = Schema::getColumnListing( $TABLE );

        $c = $this->PREP_INPUT( "COLUMN", $INPUT["v2"], $TABLE_COLUMNS );

        if( isset($INPUT["v3"]) )
        {

            foreach ( $INPUT["v3"] as $key => $value ) {

                if( isset($value["c1"]) ){
    
                    $j = $this->PREP_INPUT( "JOIN" ,[$value["c1"]], $TABLE_COLUMNS );

                }
    
                if( isset($value["c2"]) ){
    
                    $lj = $this->PREP_INPUT( $value["c2"], $TABLE_COLUMNS );
        
                }
    
                if( isset($value["c3"]) ){
    
                    $g = $this->PREP_INPUT( $value["c3"], $TABLE_COLUMNS );
        
                }
    
                if( isset($value["c4"]) ){
    
                    $o = $this->PREP_INPUT("ORDERBY", $value["c4"], $TABLE_COLUMNS );
                   
        
                }
    
                if( isset($value["c5"]) ){
    
                    $w = $this->PREP_INPUT( "WHERE", [$value["c5"]], $TABLE_COLUMNS );
        
                }
                
                if( isset($value["c6"]) ){
    
                    $wo = $this->PREP_INPUT( $value["c6"], $TABLE_COLUMNS );
        
                }
    
                if( isset($value["c7"]) ){
    
                    $wi = $this->PREP_INPUT( $value["c7"], $TABLE_COLUMNS );
        
                }
                
            }

        }

        $DATA = DB::table($TABLE);
  
        $DATA->select($c);

        if( isset($w) )
        {
            
            $DATA->where($w);
    
        }

        if( isset($j) )
        {
    
            foreach ($j as $key => $val) {
    
                $DATA->join($val[0],$val[1],$val[2],$val[3]);
    
            }
        }
    
        if( isset($lj) )
        {
    
            foreach ($lj as $key => $val) {
    
                $DATA->leftjoin($val[0],$val[1],$val[2],$val[3]);
    
            }
        }
    
        if( isset($g) )
        {
    
            $DATA->groupBy($g);
    
        }

        if( isset($o) )
        {
      
            $DATA->orderBy($o[0],$o[1]);
          
        }

        if( isset($wo) )
        {
    
            foreach ($wo as $key => $val) {
    
                $DATA->orWhere($val[0],$val[1],$val[2]);
    
            }

        }

        if( isset($wi) )
        {
    
            foreach ($wi as $key => $val) {
    
                $DATA->whereIn($val[0],[$val[1]]);
    
            }

        }



        // if($TABLE == 'forms_containers_cols_list'){
        // dd($DATA->toSql());
        // }
       
        // dd($DATA->toSql());

       
        $DATA = $DATA->get();

        // dd($DATA);


        return response()->json($DATA); 
       
    }

    public function PREP_INPUT($TYPE,$ARRAY,$TABLE_COLUMNS)
    {

        $output = array();
       
        foreach ( $ARRAY as $key => $value ) {

            if( $TYPE == "COLUMN" )
            {

                if( is_array( $value ) )
                {
                    $table = $this->INIT_TABLES($value[0]);

                    $table_columns = Schema::GetColumnListing($table);

                    $column = $table.'.'.$table_columns[$value[1]];

                    array_push( $output, $column );

                }
                else
                {   

                    array_push( $output, $TABLE_COLUMNS[$value] );

                }

            }

            
         

            if( $TYPE == "ORDERBY" )
            {
                

                if( is_array( $value ) )
                {
                    $table = $this->INIT_TABLES($value[0]);

                    $table_columns = Schema::GetColumnListing($table);

                    $output = [$table_columns[$value[1]], $value[2]];

                }
               

            }

            if( $TYPE == "WHERE" )
            {

                $condition = $this->INIT_CONDITIONS($value[1]);

                if( is_array($value[0]) )
                {

                    $table = $this->INIT_TABLES($value[0][0]);

                    $table_columns = Schema::GetColumnListing($table);

                    $column = $table.'.'.$table_columns[$value[0][1]];

                    array_push( $output, [ $column, $condition, $value[2] ] );

                }
                else
                {

                    array_push( $output, [ $TABLE_COLUMNS[$value[0]], $condition, $value[2] ] );

                }

            }

            if( $TYPE == "JOIN" )
            {

          

                foreach ($value as $key => $join) {
                    
                    $jointable = $this->INIT_TABLES($join[0][0]);

                    $jointable_columns = Schema::GetColumnListing($jointable);

                    $jointable_common = $jointable_columns[$join[0][1]];
               
                    
                    $condition = $this->INIT_CONDITIONS($join[1]);


                    $maintable = $this->INIT_TABLES($join[2][0]);

                    $maintable_columns = Schema::GetColumnListing($maintable);

                    $maintable_common = $maintable_columns[$join[2][1]];

                    array_push( $output, [$jointable ,$jointable.'.'.$jointable_common, $condition, $maintable.'.'.$maintable_common]  );

                 
                }









               
                // dd($output);
            }

        }


        
        return $output;
    }

    public function PREP_JOIN($ARRAY,$TABLE_COLUMNS)
    {
        $output = array();
        
        foreach ( $ARRAY as $key => $value ) {

            $condition = $this->INIT_CONDITIONS($value[1]);

            array_push( $output, [ $TABLE_COLUMNS[$value[0]], $condition, $value[2] ] );

        }

        return $output;
    }

    public function PREP_COLS($ARRAY,$TABLE_COLUMNS)
    {
        $columns = array();
        
        foreach ( $ARRAY as $key => $value ) {

            array_push($columns,$TABLE_COLUMNS[$value]);

        }

        return $columns;
    }

    public function __FETCHDATAN($DATA,$TEST=null)
    {

        $DATA = base64_decode($DATA);

        $JSON = $this->cryptoJsAesDecrypt('mlqu-hash-password-2021',$DATA);

        $t = null;

        $c = null;

        $j = null;

        $w = null;

        $g = null;

        $o = null;

        $lj = null;

        $wo = null;

        if( isset($JSON['v1'])){

            $t = $JSON['v1'];

        }

        if( isset($JSON['column'])){

            $c = $JSON['column'];

        }

        if( isset($JSON['join'])){

            $j = $JSON['join'];

        }

        if( isset($JSON['where'])){

            $w = $JSON['where'];

        }

        if( isset($JSON['group'])){

            $g = $JSON['group'];

        }

        if( isset($JSON['order'])){

            $o = $JSON['order'];

        }

        if( isset($JSON['leftJoin'])){

            $lj = $JSON['leftJoin'];

        }

        if( isset($JSON['whereOr'])){

            $wo = $JSON['whereOr'];

        }

        // if( isset($JSON['whereOr'])){

        //     $wo = $JSON['whereOr'];

        // }
      
        $DATA = library::__FETCHDATA($t,$c,$j,$w,$g,$o,$lj,$wo);

     /*    if($TEST=='1')
        {
            dd($DATA->toSql());
        } */

        return response()->json($DATA); 

    }

    public function __INSERTN(Request $DATA)   
    {   
       
        $fileColumn = ''; 

        $TEMP = json_encode($DATA->all());

        $TEMP = json_decode($TEMP);

        $TEMP = json_decode(json_encode($TEMP), true);

        $TABLE = $this->INIT_TABLES( $TEMP["v1"] );

        $TABLE_COLUMNS = Schema::getColumnListing($TABLE);

        $LATESTCODE = library::__FETCHLATESTCODE($TABLE,$TABLE_COLUMNS[0],$TABLE_COLUMNS[0],'DESC',5);

        foreach ($TEMP as $key => $value) {
            
            if( $key != 'v1' && $key != 'v2' && $key != '_token' && $key != 'v3' )
            {

                $ARR[$TABLE_COLUMNS[$key]] = $value;

            }

        } 

        $ARR[$TABLE_COLUMNS[0]] = $LATESTCODE;

        library::__STORE($TABLE,$ARR);

        if( isset($TEMP['v2']) )
        {

            return redirect()->back()->with('success-message', $TEMP['v2']);

        }
        else
        {
            return '<small style="text-align:center; margin-top: 40px;">Lazy Modal</small><hr><br><h1 style="text-align:center; margin-top: 40px;">Alert Output Missing!</h1>';
        }

    }

    public function __DELETEN(Request $DATA)
    {       

        $TEMP = json_encode($DATA->all());

        $TEMP = json_decode($TEMP);

        $TEMP = json_decode(json_encode($TEMP), true);

        $TABLE = $this->INIT_TABLES( $TEMP["v1"] );

        $MESSAGE = $DATA['v2'];

        $TABLE_COLUMNS = Schema::getColumnListing($TABLE);

        $IDS = $this->cryptoJsAesDecrypt('mlqu-hash-password-2021',base64_decode($TEMP['v3']));

        if( is_array($IDS) )
        {
            
            foreach ( $IDS["_D"] as $key => $value ) {
                
                library::__DESTROY($TABLE,$TABLE_COLUMNS,$value);

            }
            
        }
    
        return redirect()->back()->with('success-message', $MESSAGE);

    }

    public function __EDITN(Request $DATA)
    {
        $fileColumn = '';

        $ARR = array();

        $PK = '';

        $TEMP = $DATA->all();

        $TEMP = json_encode($DATA->all());
        
        $TEMP = json_decode($TEMP);

        $TEMP = json_decode(json_encode($TEMP), true);

        $TABLE = $this->INIT_TABLES( $TEMP["v1"] );

        $TABLE_COLUMNS = Schema::getColumnListing($TABLE);

        $EDITABLES = $this->cryptoJsAesDecrypt('mlqu-hash-password-2021',base64_decode( $TEMP['v3'] ));

        //SET ALL VALUES THROUGH LOOPING
        foreach ($TEMP as $key => $value) {
    
            if( $key != 'v1' && $key != 'v2' && $key != 'v3' && $key != '_token' )
            {

                if( $DATA->hasfile($key) )    
                {

                    // if you are editing employee
                    if( $TABLE == library::$_MAIN_TBL_EMPLOYEE )
                    {

                        $path = $this->__REPLACE_EMPLOYEE_PICTURE( $EDITABLES['_MD'] , $TABLE_COLUMNS[$key], $DATA->file($key) );

                        

                    }
                    else if( $TABLE == library::$_MAIN_TBL_STUDENT)
                    {

                    }

                    $ARR[$TABLE_COLUMNS[$key]] = $path;

                }
                else
                {
                    $ARR[$TABLE_COLUMNS[$key]] = $value;
                }

            }

        }

        /* IF NOT COLUMN 0 
        * yung gagamitin sa WHERE
        * dito yon naka store sa _MD
        */

        if( $EDITABLES['_W'] )
        {
            
            $ARR[$TABLE_COLUMNS[$EDITABLES['_W']]] = $EDITABLES['_MD'];

            library::__UPDATE($TABLE,$ARR,$TABLE_COLUMNS[$EDITABLES['_W']]);

        }
        else
        {

            $ARR[$TABLE_COLUMNS[0]] = $EDITABLES['_MD'];

            library::__UPDATE($TABLE,$ARR,$TABLE_COLUMNS[0]);

        }

        return redirect()->back()->with('success-message',$TEMP['v2']);
    }

    public function __SHOW( $DATA ){

        $DATA = base64_decode($DATA);

        $JSON = $this->cryptoJsAesDecrypt('mlqu-hash-password-2021',$DATA);

        $t = null;

        $c = null;

        $j = null;

        $w = null;

        $g = null;

        $o = null;

        $lj = null;

        $wo = null;

        $f_t = null;

        $f_c = null;

        $f_j = null;

        $f_w = null;

        $f_g = null;

        $f_o = null;

        $f_lj = null;

        $f_wo = null;

        $id = null; 

        $role= null;

        $primaryKey = null;

        $filter = null;

        $selectedFilter = '*';

        $arrayCompact = array();

        if( isset($JSON['t'])){

            $t = $JSON['t'];

        }

        if( isset($JSON['c'])){

            $c = $JSON['c'];

        }

        if( isset($JSON['j'])){

            $j = $JSON['j'];

        }

        if( isset($JSON['w'])){

            $w = $JSON['w'];

        }

        if( isset($JSON['g'])){

            $g = $JSON['g'];

        }

        if( isset($JSON['o'])){

            $o = $JSON['o'];

        }

        if( isset($JSON['lj'])){

            $lj = $JSON['lj'];

        }

        if( isset($JSON['wo'])){

            $wo = $JSON['wo'];

        }

        if( isset($JSON['transferWith']) ){

            foreach ($JSON['transferWith'] as $key => $v) {
                
                if($v == 'id')
                {

                    $id = Auth::user()->id;

                }

                if($v == 'role')
                {

                    $role = $this->getRole();

                }

                if($v == 'primaryKey')
                {
                    
                    $primaryKey = $JSON['primaryKey'];

                }

                if($v == 'filter')
                {

                    foreach ($JSON['filterData'] as $key => $v) {

                        if( isset($JSON['filterData']['f_t'])){

                            $f_t = $JSON['filterData']['f_t'];
                
                        }
                
                        if( isset($JSON['filterData']['f_c'])){
                
                            $f_c = $JSON['filterData']['f_c'];
                
                        }
                
                        if( isset($JSON['filterData']['f_j'])){
                
                            $f_j = $JSON['filterData']['f_j'];
                
                        }
                
                        if( isset($JSON['filterData']['f_w'])){
                
                            $f_w = $JSON['filterData']['f_w'];
                
                        }
                
                        if( isset($JSON['filterData']['f_g'])){
                
                            $f_g = $JSON['filterData']['f_g'];
                
                        }
                
                        if( isset($JSON['filterData']['f_o'])){
                
                            $f_o = $JSON['filterData']['f_o'];
                
                        }
                
                        if( isset($JSON['filterData']['f_lj'])){
                
                            $f_lj = $JSON['filterData']['f_lj'];
                
                        }
                
                        if( isset($JSON['filterData']['f_wo'])){
                
                            $f_wo = $JSON['filterData']['f_wo'];
                
                        }

                    }
                    if( isset($JSON['selectedFilter'])){
                
                        $selectedFilter = $JSON['selectedFilter'];
            
                    }
  
                    $filter = library::__FETCHDATA($f_t,$f_c,$f_j,$f_w,$f_g,$f_o,$f_lj,$f_wo);

                }

            }

        }

        $data = library::__FETCHDATA($t,$c,$j,$w,$g,$o,$lj,$wo);

        // dd($data);

        return view($JSON['url'],compact('id','role','primaryKey','data','filter','selectedFilter'));
       
    }

    public function __UPLOAD($file, $filepath){

        $savePath = public_path($filepath);
        
        $file->move($savePath, $file->getClientOriginalName());

    }

    public function __REPLACE_EMPLOYEE_PICTURE( $employeeid, $column, $file ){

        $t =    'employee_information';

        $c =    [
                    $column
                ];
    
        $w =    [
                    ['employee_code', '=', $employeeid]
                ];

        $data = library::__FETCHDATA($t,$c,null,$w);    

        Storage::delete($data[0]->$column);

        return $file->store('/public/img/employee_images');

    }

   


    //END

    // FORMS ( NOT USING LAZY MODAL )
    public function __FORM_EDIT_SINGLE_TABLE(Request $DATA)
    {

        $array_for_update = array();

        // PREPARE TABLE
        $TABLE = $this->INIT_TABLES( $DATA['_tc'] );

        // GET COLUMNS
        $TABLE_COLUMNS = Schema::getColumnListing($TABLE);

        // SET VALUE FOR PRIMARY KEY
        $array_for_update[$DATA->_pc] = $DATA->_pk;

        foreach ($DATA->all() as $key => $value) {

            if($key != '_token' && $key != '_tc' && $key != '_fn' && $key != '_pk' && $key != '_pc' && $key != '_bm')
            {   
                // PREP COLUMNS TO BE UPDATED
                // FILL IN ONLY THE COLUMNS FOR UPDATE - AND SET ITS VALUE THROUGH LOOPING
                $array_for_update[$key] = $value;
            }
        }

        // TABLE NAME , ARRAY , PRIMARY COLUMN 
        library::__UPDATE($TABLE,$array_for_update,$DATA->_pc);

        // _BM or BACK-MESSAGE
        return redirect()->back()->with('success-message',$DATA['_bm']);

    }

    public function __UPDATE_PASSWORD(Request $DATA)
    {

        $TEMP = $DATA->all();

        $TEMP = json_encode($DATA->all());
        
        $TEMP = json_decode($TEMP);

        $TEMP = json_decode(json_encode($TEMP), true);

        $TABLE = $this->INIT_TABLES( $TEMP["v1"] );

        $TABLE_COLUMNS = Schema::getColumnListing($TABLE);

        $EDITABLES = $this->cryptoJsAesDecrypt('mlqu-hash-password-2021',base64_decode($TEMP['v3']));

        //SET ALL VALUES THROUGH LOOPING
        foreach ($TEMP as $key => $value) {
    
            if( $key != 'v1' && $key != 'v2' && $key != 'v3' && $key != '_token' )
            {

                $ARR[$TABLE_COLUMNS[$key]] = Hash::make($value);


            }

        }

   

        if( $EDITABLES['_W'] )
        {
            
            $ARR[$TABLE_COLUMNS[$EDITABLES['_W']]] = $EDITABLES['_MD'];
            
            library::__UPDATE($TABLE,$ARR,$TABLE_COLUMNS[$EDITABLES['_W']]);

        }
        else
        {

            $ARR[$TABLE_COLUMNS[0]] = $EDITABLES['_MD'];

            library::__UPDATE($TABLE,$ARR,$TABLE_COLUMNS[0]);

        }


        return redirect()->back()->with('success-message',$TEMP['v2']);

    } 

    
    // JS - LAZY MODAL FUNCTIONS
    public static function s_cryptoJsAesDecrypt($passphrase, $jsonString){

        $jsondata = json_decode($jsonString, true);

        $salt = hex2bin($jsondata["s"]);

        $ct = base64_decode($jsondata["ct"]);

        $iv  = hex2bin($jsondata["iv"]);

        $concatedPassphrase = $passphrase.$salt;

        $md5 = array();
        
        $md5[0] = md5($concatedPassphrase, true);

        $result = $md5[0];

        for ($i = 1; $i < 3; $i++) {

            $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);

            $result .= $md5[$i];

        }

        $key = substr($result, 0, 32);

        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);

        return json_decode($data, true);

    }

    public function cryptoJsAesDecrypt($passphrase, $jsonString){

        $jsondata = json_decode($jsonString, true);

        $salt = hex2bin($jsondata["s"]);

        $ct = base64_decode($jsondata["ct"]);

        $iv  = hex2bin($jsondata["iv"]);

        $concatedPassphrase = $passphrase.$salt;

        $md5 = array();
        
        $md5[0] = md5($concatedPassphrase, true);

        $result = $md5[0];

        for ($i = 1; $i < 3; $i++) {

            $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);

            $result .= $md5[$i];

        }

        $key = substr($result, 0, 32);

        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);

        return json_decode($data, true);

    }






}
