
    $(function () {
        'use strict'

        $('[data-toggle="offcanvas"]').on('click', function () {
            $('.offcanvas-collapse').toggleClass('open')
        })
    })

    // GLOBAL VARIABLES
    
        var hp = "mlqu-hash-password-2021";
    
        var message = 'Subject added successfully.';
    
        var content = '';
    
        var d = '';
    
        var encyptedData = '';
    
        var footer = '';
    
        var toAppend = '';
    
        var x = '';

        var validators = true;
    
    // ENCRYPT
        var CryptoJSAesJson = {
    
                stringify: function (cipherParams) {
    
                    var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
    
                    if (cipherParams.iv) j.iv = cipherParams.iv.toString();
                    
                    if (cipherParams.salt) j.s = cipherParams.salt.toString();
    
                    return JSON.stringify(j);
                },
               
                parse: function (jsonStr) {
    
                    var j = JSON.parse(jsonStr);
    
                    var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
                  
                    if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
                  
                    if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
                  
                    return cipherParams;
                }
    
        }
    
        function encryptData(data, pass=null){
    
            var encrypted = CryptoJS.AES.encrypt(data, 'mlqu-hash-password-2021', {format: CryptoJSAesJson});
    
            return btoa(unescape(encodeURIComponent(encrypted.toString())));
    
        }
    
    // MODAL BUILDER
    
        function showModal(modal, title, size=null){
    
            $('#'+modal+' .modal-title').empty();

            $('#'+modal+' .modal-body .container').empty();

            if(size != null)
            {

                $('#'+modal+' .modal-dialog').addClass('modal-'+size);

            }

            $('#'+modal+' .modal-footer').empty();

            $('#'+modal+' .modal-title').append(title);

            $('#'+modal).modal('show');
    
        }
    
        function formBuild(formId,action,content,footer,enctype=null){
         
            var form = document.getElementById(formId);

            form.action = action;
            
            $('#form_univ > div.modal-body').empty();
            
            $('#'+formId+' .modal-footer').empty();

            $('#form_univ > div.modal-body').append(content);
    
            $('#'+formId+' .modal-footer').append(footer);
    
            if( enctype != null ){
    
                $('#'+formId).attr("enctype",enctype);
    
            }
    
        }
    
        function __BUILDERN(data, MODALNAME = 'modal_univ'){

            content = '';

            for (let i = 0; i < data['modalContent'].length; i++) 
            {
                
                if(Array.isArray(__CONTENTBUILDER(data['modalContent'][i])))
                {
                    
                    $( __CONTENTBUILDER(data['modalContent'][i])[0]).append(__CONTENTBUILDER(data['modalContent'][i])[1]);
                }
                else
                {
                    content += __CONTENTBUILDER(data['modalContent'][i]);
                }

            }   

            if( data['v1'] )
            {

                content += form_input('','v1','','',data['v1'],'hidden');

            }
            if( data['v2'] )
            {

                content += form_input('','v2','','',data['v2'],'hidden');

            }
            if( data['v3'] )
            {

                content += form_input('','v3','','',data['v3'],'hidden');

            }

            footer = '';

            if(data['url'])
            {
                
                footer += form_button('btn_submit',data['buttonSubmit'],'btn btn-sm text-light','submit','background:#2569c3;!important;height:25px;width:80px');

            }

            if(data['modalSize'])
            {
                showModal(MODALNAME, data['modalTitle'],data['modalSize']);

            }
            else
            {

                showModal(MODALNAME, data['modalTitle']);

            }

            footer += form_button('btn_close',data['buttonCancel'],'btn btn-secondary btn-sm text-light ','button','height:25px;width:80px','data-dismiss="modal"');

            showModal(MODALNAME, data['modalTitle']);
        
            formBuild('form_univ',data['url'],content,footer,data['v6']);

        }
    
        function __CONTENTBUILDER(DATA){ 

            if( DATA['_E'] == 'input' ){
    
                output = '<input ';
    
                if ('_T' in DATA) {
                    
                    output += 'type = "'+DATA['_T']+'" ';
    
                }
    
                if ('_C' in DATA) {
                    
                    output += 'class = "'+DATA['_C']+'" ';
    
                }
    
                if ('_N' in DATA) {
                    
                    output += 'name = "'+DATA['_N']+'" ';
    
                }
    
                if ('_I' in DATA) {
                    
                    output += 'id = "'+DATA['_I']+'" ';
    
                }
    
                if ('_P' in DATA) {
                    
                    output += 'placeholder = "'+DATA['_P']+'" ';
    
                }
    
                if ('_A' in DATA) {
                    
                    output += DATA['_A']+' ';
    
                }
    
                if ('_V' in DATA) {
                    
                    output += 'value = "'+ DATA['_V']+'"';
    
                }
    
                output += '/>'
    
                if( DATA['_C'] == 'custom-file-input'){
    
                    output += '<label class="custom-file-label" for="'+DATA['_I']+'">'+DATA['_CL']+'</label>';
    
                    divoutput = '<div class="input-group mb-3"><div class="custom-file">';
                    
                    divoutput += output;
    
                    divoutput += '</div></div>';
    
                    return divoutput;
    
                }
                else{
    
                    return output;
    
                }
    
            }
    
            if( DATA['_E'] == 'textarea' ){
    
                output = '<textarea ';
    
                if ('_C' in DATA) {
                    
                    output += 'class = "'+DATA['_C']+'" ';
    
                }
    
                if ('_N' in DATA) {
                    
                    output += 'name = "'+DATA['_N']+'" ';
    
                }
    
                if ('_I' in DATA) {
                    
                    output += 'id = "'+DATA['_I']+'" ';
    
                }
    
                if ('_P' in DATA) {
                    
                    output += 'placeholder = "'+DATA['_P']+'" ';
    
                }
    
                if ('_R' in DATA) {
                    
                    output += 'rows = "'+DATA['_R']+'" ';
    
                }
    
                if ('_A' in DATA) {
                    
                    output += DATA['_A'];
    
                }
    
                output += '>';
    
                if ('_V' in DATA) {
                    
                    output +=  DATA['_V'];
    
                }
    
                output += '</textarea>'
    
                return output;
    
            }
    
            if( DATA['_E'] == 'label' ){
    
                output = '<label ';
    
                if ('_C' in DATA) {
    
                    output += 'class = "'+DATA['_C']+'" ';
    
                }

                if ('_S' in DATA) {
    
                    output += 'style = "'+DATA['_S']+'"> ';

                }
                else
                {
                    output += '>';
                }

                if('_V' in DATA ) {
    
                    output += DATA['_V'];
    
                }

                if('_BR' in DATA ) {
                    
                    output += '</label> <br>';

                }
                else
                {
                    output +=' </label>';
                }

    
                return output;
            }

            if( DATA['_E'] == 'sm-label' ){
    
                output = '<br><label ';

                if ('_C' in DATA) {

                    output += 'class = "'+DATA['_C']+'"> <small>';

                }
                if('_V' in DATA ) {

                    output += DATA['_V']+' <small></label>';

                }

                return output;
            }
    
            if( DATA['_E'] == 'select' ){
    
                output = '<select ';
    
                if ('_C' in DATA) {
    
                    output += 'class = "'+DATA['_C']+'" ';
    
                }
    
                if ('_I' in DATA) {
    
                    output += 'id = "'+DATA['_I']+'" ';
    
                }
    
                if('_N' in DATA ) {
    
                    output += 'name = "'+DATA['_N']+'">';
    
                }
    
                output += '</select>';
    
                return output;
            }
            
            if( DATA['_E'] == 'row')
            {
                output = '<div class="row" id="'+DATA['_I']+'"></div>'
            }

            if( DATA['_E'] == 'container-tab')
            {

                if( '_I' in DATA )
                {

                    output = '<ul class="nav nav-tabs" id="'+DATA['_I']+'"></ul>'

                    return ['#form_univ > div.modal-body',output];

                }
                
            }

            if( DATA['_E'] == 'tab')
            {

                output = '<li class="nav-item"><a class="nav-link active" href="'+DATA['TI']+'">'+DATA['_N']+'</a></li>';

                return ['#'+DATA['_AT'],output];    
                
            }

            if( DATA['_E'] == 'col')
            {
                output = '<div class="col"></div>';

                if( '_N' in DATA )
                {

                    if( '_E' in DATA )
                    {

                        output = '<div class="col-'+DATA['_N']+' '+DATA['_E']+'" id="'+DATA['_I']+'"> </div>';

                    }
                    else
                    {

                        output = '<div class="col-'+DATA['_N']+'" id="'+DATA['_I']+'"> </div>';

                    }
                }

                if( '_N' in DATA && '_SM' )
                {
                   
                    if( '_E' in DATA )
                    {

                        output = '<div class="col-sm-'+DATA['_N']+' '+DATA['_E']+'" id="'+DATA['_I']+'"> </div>';

                    }
                    else
                    {

                        output = '<div class="col-sm-'+DATA['_N']+'" id="'+DATA['_I']+'"> </div>';

                    }
                }

                if( '_N' in DATA && '_LG' )
                {

                    if( '_E' in DATA )
                    {

                        output = '<div class="col-lg-'+DATA['_N']+' '+DATA['_E']+'" id="'+DATA['_I']+'"> </div>';

                    }
                    else
                    {

                        output = '<div class="col-lg-'+DATA['_N']+'" id="'+DATA['_I']+'"> </div>';

                    }
                }

                if( '_N' in DATA && '_XL' )
                {

                    if( '_E' in DATA )
                    {

                        output = '<div class="col-xl-'+DATA['_N']+' '+DATA['_E']+'" id="'+DATA['_I']+'"> </div>';

                    }
                    else
                    {

                        output = '<div class="col-xl-'+DATA['_N']+'" id="'+DATA['_I']+'"> </div>';

                    }
                }

                if( '_R' in DATA )
                {

                    $(DATA['_R']).append(output);

                }
                else
                {
                    console.log('missing row!');
                }

            }

        }
        function __ADDTL(DATA){
    
            for (let i = 0; i < DATA.length; i++) {
             
                if( DATA[i]['_E'] == 'option'){
    
                    output = '<option ';
    
                    if ('_IV' in DATA[i] ) {
    
                        output += 'value = "'+DATA[i]['_IV']+'"> ';
    
                    }
                    if('_OV' in DATA[i] ) {
    
                        output += DATA[i]['_OV']+' </option>';
    
                    }
    
                    $( '#'+DATA[i]['_FS'] ).append(output);
    
                }
                if( DATA[i]['_E'] == 'option-fetch-value'){
    
                    elementId = '#'+ DATA[i]['_I'];
    
                    output = '' ;
    
                    $.ajax({
    
                            url: DATA[i]['_U']+DATA[i]['_ED'],
    
                            dataType: 'json',
    
                            async: false,
    
                            data: '',
                        
                            success: function(data) {

                                var jsonData = JSON.stringify( data );

                                var keys = [];

                                var count = 0;
    
                                $.each(JSON.parse( jsonData ), function(keyx, val){

                                    $.each(val, function(key, val){

                                        if(count < 2)
                                        {

                                            keys.push(key)

                                        }
                                        count++;

                                    })

                                })


                                $.each(JSON.parse( jsonData ), function(key, val){

                                    output += '<option value="'+val[keys[0]]+'">'+val[keys[1]]+'</option>'

                                })

                                if( !$(elementId).val() )
                                {
                                    $(elementId).empty();
                                }
                                
    
                                $(elementId).append(output);
    
                            }
    
                    });
    
                }
                if( DATA[i]['_E'] == 'option-selected-value'){
    
                    document.getElementById( DATA[i]['_FS'] ).value =  DATA[i]['_SV'];
    
                }
                
            }
    
        }
    
        function form_label(id,content,t_class){
    
            return '<label class="'+t_class+'">'+content+'</label>'; 
    
        }
        function form_input(id,name,placeholder,t_class,value,attr='',type=''){
    
           return '<input type="'+type+'" class="'+t_class+'" name="'+name+'" id="'+id+'" placeholder="'+placeholder+'" '+attr+' value="'+value+'"/>'; 
        
        }
        function form_select(id, name,  t_class){
    
            var output = '';
            
            output = '<select class="'+t_class+'" id="'+id+'" name="'+name+'">'
                
            output += '</select>';
    
            return output;
    
        }
        function form_button(id,name,t_class,type,style='',attr=''){
    
            return '<button type="'+type+'" class="'+t_class+'" id="'+id+'" style="'+style+'" '+attr+'>'+name+'</button>';
    
        }


        $('#form_univ').one('submit', function(e) {
           
            e.preventDefault();
            
            if(validators)
            {
                $(this).submit();
            }
            else
            {

            }
      
        });
      
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })



    
    // FORM COMPLEX
        function form_option(url,selectid,input,column=null,code=null,selected=null,addtl=null){
    
            var content = '';
    
            if(addtl){
                content += addtl;
    
                $('#'+selectid).empty();
                $('#'+selectid).append(content);
                
                if(selected){
                    document.getElementById(selectid).value = selected;
                }
            }
                
            $.getJSON(url+input, function(data) {
    
                var jsonData = JSON.stringify(data);
    
                $.each(JSON.parse(jsonData), function(key, val){
                    
                    content += '<option value="'+val[code]+'">'+val[column]+'</option>'
    
                })
    
                $('#'+selectid).empty();
                $('#'+selectid).append(content);
    
                if(selected){
                    document.getElementById(selectid).value = selected;
                }
    
            })
           
        }
        
    // GET DATA FUNCTIONS
        function fetchGetJSON( input, callback ){
    
            // $.getJSON('/UNIV/FETCHDATA/'+encyptedData, function(data) {
                        
            // }
    
            $.getJSON(input['url']+input['data'], function(data) {
                
                callback(data)
    
            })
    
    
        }

    
  
    
    
    
    
    // DATE FUNCTION    
    
        function getDateNow(){
    
            var today = new Date();
    
            var dd = String(today.getDate()).padStart(2, '0');
    
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            
            var yyyy = today.getFullYear();
    
            today =   yyyy + '/'  + mm  + '/' + dd ;
    
            return today;
        }

        function formatDateMDY(date){
    
            date = new Date(date);
    
            const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(date);
    
            const mo = new Intl.DateTimeFormat('en', { month: 'long' }).format(date);
    
            const da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(date);
            
            return mo+' '+da+', '+ye;
    
        }
    
        function dateCheck(from,to,check) {
    
            var fDate,lDate,cDate;
    
            fDate = Date.parse(from);
    
            lDate = Date.parse(to);
    
            cDate = Date.parse(check);
    
            if(cDate <= lDate || cDate >= fDate || cDate == lDate || cDate == fDate) {
    
                return true;
    
            }
    
            return false;
        }
    
    
    
    
    // SEARCH FUNCTION
    function addSearch(txtSearch, table){
    
        $("#"+txtSearch).keyup(function () {
    
        var value = this.value.toLowerCase().trim();
    
        $("#"+table+" tr").each(function (index) {
    
            if (!index) return;
    
            $(this).find("td").each(function () {
    
                var id = $(this).text().toLowerCase().trim();
    
                var not_found = (id.indexOf(value) == -1);
    
                $(this).closest('tr').toggle(!not_found);
    
                return not_found;
            
                });
            });
        });
    }


// LOADING FUNCTION
    $(window).on('load',function(){
        $(".load-screen").fadeOut(1000);
        $(".page-screen").fadeIn(1000);
        $(".page-screen").removeClass('d-none');

       
        
    })

// CHANGE PASS FUNCTION
    // $(document.body).on('click', '#formChangePass', function(){

    //     let zmodal = new LazyModal();

    //     zmodal.InitUpdateModalSingle("Change Password", 1,  $('.fd').attr('identifier'), 4,'','/UNIV/EDIT/PASSWORD');

    //     zmodal.addLabelR('Password');
    //     zmodal.addPasswordBox();

    //     zmodal.addLabelR('Confirm Password');
    //     zmodal.addPasswordBox('2');

    //     zmodal.AlertOutput('Password Updated Successfully.');

    //     zmodal.Show();


    // })

    $('.ld-eye-peek').on('click',function(){

        if( $($(this).attr('ld-peek-id')).attr('type') == 'password' )
        {
            $($(this).attr('ld-peek-id')).attr('type','text')
            $(this).empty();
            $(this).append('<i class="fas fa-eye-slash"></i>');
        }
        else
        {
            $($(this).attr('ld-peek-id')).attr('type','password')
            $(this).empty();
            $(this).append('<i class="fas fa-eye"></i>');
        }

    })


    $('.form-control').on('click',function(){
        if($(this).hasClass('ld-red-border'))
        {
            $(this).removeClass('ld-red-border')
            $('.invalid-feedback').hide();
        }
    })

    $("#formChangePass").submit(function(e){
        
        e.preventDefault();

        d = JSON.stringify({
            
            _MD:$('.fd').attr('identifier'),
            _W: 4

        })

        ids = encryptData(d,hp);

        $('#formChangePassV3').val(ids);

        if( $('#txt_password_1').val() == $('#txt_password_2').val())
        {
            $(this).submit();
        }
        else
        {
             $('.invalid-feedback').show();
             $('#txt_password_1').addClass('ld-red-border')
             $('#txt_password_2').addClass('ld-red-border')
         
             
        }

    });

    $(function () {
        $('[data-toggle="popover"]').popover()
    })
     
   
   
    
    function calculate_age(textBox, birthdate){

        $('#'+birthdate).on('change',function(){

            dob = $('#'+birthdate).val();

            dob = new Date(dob);

            var today = new Date();

            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

            $('#'+textBox).val(age);

        })

        


    }
    



   

    function setChevRon(collapseid,chevyIdU, chevyIdD)
    {

        const buttonUp = $('#'+chevyIdU);
      
        const buttonDown = $('#'+chevyIdD);

        if( $('#'+collapseid).hasClass('show') )
        {

            buttonUp.slideDown(300);

            buttonDown.slideDown(300);

        }
        else
        {

            buttonUp.slideDown(500);
         
            buttonDown.delay(100).slideUp(500);

        }

    }
  
    
    
    // {{-- 
    
    //     cheat scripts
        
    //     **** FOR MODAL ****
    
    //     label
    //         {
    //                 _E: 'element',
    
    //                 _C: 'class',
    
    //                 _V: 'value',
    //         },
    
    //     input
    //         {
    //                 _E: 'element',
    
    //                 _T: 'type',
    
    //                 _I: 'id',
    
    //                 _N: 'name',
    
    //                 _P: 'placeholder',
    
    //                 _C: 'class',
    
    //                 _V: 'value',
    
    //                 _A: 'attribute array'
    //         },
    
    //     option
    //         {
    //                 _E: 'element',
    
    //                 _IV: 'inner value',
    
    //                 _FS: 'for select',
    
    //                 _OV: 'outer value',
    //         },
    //     set selected option
    //         {
    //             _E: 'option-selected-value',
    
    //             _FS: 'for select',
    
    //             _SV: 'selected value',
    //         }
    
    
    
    
    //     **** FOR MODAL ****
    
    
    
    //     ****JS GET JSON****
    //     d = {   
    //             t: 
    //             c:  [     
                      
    //                 ],
    //             j:  [
    //                     ['', '', '', ''],
    //                 ],
    //             w:  [
    //                     ['', '', '']
    //                 ],
    //             g:
                
    //             o = '';
    
    //             lj =    [
    //                         ['', '', '', ''],
    //                     ],;
    
    //             wo =    [
    //                         ['', '', '']
    //                     ];
    //         }
    
    //     d = JSON.stringify(d);
    
    //     encyptedData = encryptData(d,hp);
    
    //     $.getJSON('/UNIV/FETCHDATA/'+encyptedData, function(data) {
            
    //        some code here..
    
    //     })
    
    //     ****JS GET JSON****
    
    
    
    //     ****CHECK IF OBJ IS UNDEFINED**** 
    
    //     if( typeof res[0] === "undefined" )
    //     {
    //         console.log('test');
    //     }
    //     else
    //     {
    //         console.log('try');
    //     }
    
    //     ****CHECK IF OBJ IS UNDEFINED**** 
        
    
    
    //     ****CREATE JS FUNCTION WITH CB**** 
    
    //     function getClearance(callback){
    
    //     }
    
    //     getClearance(function (res){
    
    //     }
    
    //     ****CREATE JS FUNCTION WITH CB**** 
        
    
    
    
    //     ****MULTI INPUT*** 
    
    //     multiInput =  JSON.stringify({
    
    //         _T: 'PK-INPUT',
    
    //         _TC: 'Sheet_no', (OPTIONAL)
    
    //         _D: selectedSheets
    
    //     })
    
    //     multiInput = encryptData(multiInput,hp);
    
    //     _T: 
    //     *PK-INPUT - Kapag kailangan idefine yung pag iinputan na Column
    //     *PK- Kapag hindi na kailangan idefine yung pag iinputan na Column
    
    //     _TC: Column
    
    
    //     ****MULTI INPUT*** 
    
    
    
    
    
    
    
    
    
    
    // --}}