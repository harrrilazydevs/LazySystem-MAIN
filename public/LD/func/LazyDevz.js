// const { forEach } = require("lodash");

var zcontent = [];

var data = [];

var submitbutton = 'Add';

var closebutton = 'Close';

var title = '';

var url = '';

var addtl = [];

var v1 = '';

var v6 = [];

var alertoutput = '';

var size = '';

var ids = [];


var defaultElements = [];

var defaultForm = [];

var triggerKey = '';

var defaultData = new XMLHttpRequest();

defaultData.onreadystatechange = getElements;

defaultData.open("GET", '/ld/func/zdefault.json', true);  

defaultData.send();

// var zForms = new XMLHttpRequest();

// zForms.open("GET", '/ld/func/zForms.json', true);  

// zForms.send();


// var zForms = new XMLHttpRequest();

// zForms.onreadystatechange = getForms;

// zForms.open("GET", '/ld/func/zForms.json', true);  

// zForms.send();

// function getForms() {
        
//     if (zForms.readyState == 4) {		// Check if request is complete.
    
//         defaultForm = this.responseText;

//     }
// }


function getForms() {
    
    if (zForms.readyState == 4) {		// Check if request is complete.
       
        defaultForm = this.responseText;

    }
}

function getElements() {
    
    if (defaultData.readyState == 4) {		// Check if request is complete.
       
        defaultElements = this.responseText;

    }
}

class LazyModal{

    constructor()
    {
        zcontent = [];

        data = [];

        addtl = [];

    }

    addSource( id = '', sourceType = '', arr = '')
    {

        var zdefault = JSON.parse(defaultElements)

        if( sourceType == 'formz-default-elements' )
        {
            var temp_arr = [];

            $.each( zdefault['Default-Elements'], function(key, val){

                if( temp_arr.indexOf( val[0] ) == -1 )
                {   

                    temp_arr.push(val[0])

                }

            })

            $.each( temp_arr, function(key, val){

                addtl.push(
                    {
                            _E: 'option',
    
                            _IV: val,
    
                            _FS: id,
    
                            _OV: val,
                    }
                );

            })
            
        }

        if( sourceType == 'trigger' )
        {

            $(document.body).on('click', '#'+arr[0]['triggerId'], function(){

                var temp_arr = [];

                var triggerValue = $(this).val();

                $('#'+arr[0]['appendId']).empty();

                if( arr[0]['Condition'] == 'triggerValue' )
                {

                    $.each( zdefault['Default-Elements'], function(key, val){
        
                        if( val[0]  == triggerValue )
                        {   
        
                            temp_arr.push(val[1])
        
                        }
        
                    })

                    $.each( temp_arr, function(key, val){
                        
                        $('#'+arr[0]['appendId']).append('<option value="'+val+'">'+val+'</option>') 
        
                    })

                }
               
            })
           
        }

        if( sourceType == 'Sql' )
        {


            d =  JSON.stringify({

                v1: arr['zv1'],
    
                v2: [ arr['zv21'], arr['zv22'] ],
    
            })

            encyptedData = encryptData(d,hp);
    
            if( arr['defaultValue'] && arr['defaultOutput'] )
            {
    
                addtl.push(
                            {
                                    _E: 'option',
    
                                    _IV: arr['defaultValue'],
    
                                    _FS: id,
    
                                    _OV: arr['defaultOutput'],
                            }
                        );
    
            }
    
            addtl.push({
                            _E: 'option-fetch-value',
    
                            _U: '/UNIV/FETCHJS/',
    
                            _ED: encyptedData,
    
                            _I: id,
                      })

        }

        if( sourceType == 'value' ){

            addtl.push({
                _E: 'option',

                _IV: arr.IV,

                _OV: arr.OV,

                _FS: id,
          })

       
        }
        
    }

    addFileInput( zname = '', id = '' ){

        zcontent.push(
            {
                _E: 'input',

                _T: 'file',

                _C: 'form-control-file',

                _N: zname,

                _I: id,

                _A: 'multiple'

            }
        )

    }

    InitUploadModal( ztitle , zv1 )
    {

        title = ztitle

        submitbutton = 'Upload';

        closebutton = 'Close';

        url = '/UNIV/UPLOAD';

        v1 = zv1;

        v6 = 'multipart/form-data';
        
    }

    addLabel( value = '' , zclass = 'form-label', zstyle = '', br = '' )
    {
        
        if(zstyle)
        {
            zcontent.push(
                        {
                            _E: 'label',

                            _C: zclass,

                            _V: value,

                            _S: zstyle,

                            _BR: br,
                        }
                    )
        }
        else
        {
            zcontent.push(
                        {
                            _E: 'label',

                            _C: zclass,

                            _V: value,
                        }
                    )
        }
        
        
    }

    addLabelR( value = '' , zclass = 'form-label', zstyle = '' )
    {
        
        
        if(zstyle)
        {
            zcontent.push(
                        {
                            _E: 'label',

                            _C: zclass,

                            _V: value,

                            _S: zstyle
                        }
                    )

                    zcontent.push(
                        {
                            _E: 'label',

                            _C: 'form-label mt-2 ml-1',

                            _V: '*',

                            _S: 'color: red;'
                        }
                    )
        }
        else
        {
            zcontent.push(
                        {
                            _E: 'label',

                            _C: zclass,

                            _V: value,
                        }
                    )

            zcontent.push(
                {
                    _E: 'label',

                    _C: 'form-label mt-2 ml-1',

                    _V: '*',

                    _S: 'color: red;'
                }
            )
        }
        
        
    }

    addRow( id = '' )
    {

        zcontent.push(
                        {
                            _E: 'row',

                            _I: id,
                        }
                    )

    }

    addColumn( row = '', columnCount = '', columnSize = '' )
    {

        if( columnSize == 'sm')
        {

            zcontent.push(
                        {
                            _E: 'col',

                            _N: columnCount,

                            _SM: true,

                            _R: row
                        }
                    )
            
        }
        else if( columnSize == 'lg')
        {

            zcontent.push(
                        {
                            _E: 'col',

                            _N: columnCount,

                            _LG: true,

                            _R: row

                        }
                    )

        }
        

    }

    addPasswordBox( zname = '' )    
    {
        
        zcontent.push(
                        {
                            _E: 'input',

                            _T: 'password',

                            _C: 'form-control',

                            _N: zname,
                          
                        }
                    )
        
    }
 
    addTextBox( zname = '', id = '', zvalue = '' , zclass = 'form-control', placeholder = '', attr = '' )    
    {
        
        zcontent.push(
                        {
                            _E: 'input',

                            _T: 'text',

                            _C: zclass,

                            _P: placeholder,

                            _N: zname,

                            _I: id,

                            _V: zvalue,

                            _A: attr,
                        }
                    )
        
    }

    addDateBox( zname = '', id = '', zvalue = '' , zclass = 'form-control', attr = '' )    
    {
        
        zcontent.push(
                        {
                            _E: 'input',

                            _T: 'date',

                            _C: zclass,

                            _N: zname,

                            _I: id,

                            _V: zvalue,

                            _A: attr,
                        }
                    )
        
    }

    addSelect( zname = '', id = '', value = '', zclass = 'custom-select form-control' )
    {
        
        zcontent.push(
                        {
                            _E: 'select',

                            _I: id,

                            _N: zname,

                            _C: zclass,

                            _V: value
                        }
                    )
        
    }

    addSource( id = '', sourceType = '', arr = '')
    {

        var zdefault = JSON.parse(defaultElements)

        if( sourceType == 'formz-default-elements' )
        {
            var temp_arr = [];

            $.each( zdefault['Default-Elements'], function(key, val){

                if( temp_arr.indexOf( val[0] ) == -1 )
                {   

                    temp_arr.push(val[0])

                }

            })

            $.each( temp_arr, function(key, val){

                addtl.push(
                    {
                            _E: 'option',
    
                            _IV: val,
    
                            _FS: id,
    
                            _OV: val,
                    }
                );

            })
            
        }

        if( sourceType == 'trigger' )
        {

            $(document.body).on('click', '#'+arr[0]['triggerId'], function(){

                var temp_arr = [];

                var triggerValue = $(this).val();

                $('#'+arr[0]['appendId']).empty();

                if( arr[0]['Condition'] == 'triggerValue' )
                {

                    $.each( zdefault['Default-Elements'], function(key, val){
        
                        if( val[0]  == triggerValue )
                        {   
        
                            temp_arr.push(val[1])
        
                        }
        
                    })

                    $.each( temp_arr, function(key, val){
                        
                        $('#'+arr[0]['appendId']).append('<option value="'+val+'">'+val+'</option>') 
        
                    })

                }
               
            })
           
        }

        if( sourceType == 'Sql' )
        {

            d =  JSON.stringify({

                v1: arr['zv1'],
    
                v2: [ arr['zv21'], arr['zv22'] ],
    
            })
    
            encyptedData = encryptData(d,hp);
    
            if( arr['defaultValue'] && arr['defaultOutput'] )
            {
    
                addtl.push(
                            {
                                    _E: 'option',
    
                                    _IV: arr['defaultValue'],
    
                                    _FS: id,
    
                                    _OV: arr['defaultOutput'],
                            }
                        );
    
            }
    
            addtl.push({
                            _E: 'option-fetch-value',
    
                            _U: '/UNIV/FETCHJS/',
    
                            _ED: encyptedData,
    
                            _I: id,
                      })

        }

        if( sourceType == 'value' ){

            $.each(arr, function(key,val){

                addtl.push({

                    _E: 'option',

                    _IV: val.IV,

                    _OV: val.OV,

                    _FS: id,

            })

            })

           
       
        }
        
    }

    addOption( id = '', innervalue = '' , outputvalue = '' )
    {

        addtl.push(
                    {
                            _E: 'option',

                            _IV: innervalue,

                            _FS: id,

                            _OV: outputvalue,
                    }
        );
        
    }

    addCustomOption( id = '', zv1 = '', zv21 = '', zv22 = '', defaultValue = '' , defaultOutput = '', condition = '')
    {

        d =  JSON.stringify({

            v1: zv1,

            v2: [zv21 ,zv22],

        })

        encyptedData = encryptData(d,hp);

        if( defaultValue && defaultOutput )
        {

            addtl.push(
                        {
                                _E: 'option',

                                _IV: defaultValue,

                                _FS: id,

                                _OV: defaultOutput,
                        }
                    );

        }

        addtl.push({
                        _E: 'option-fetch-value',

                        _U: '/UNIV/FETCHJS/',

                        _ED: encyptedData,

                        _I: id,
                  })
        
    }

    addTabContainer( id )
    {
        
        zcontent.push(
                        {
                            _E: 'container-tab',

                            _I: id,
                        }
                    )

    }

    addTab(  zid , tid , zti, zname )
    {
        
        zcontent.push(
                        {
                            _E: 'tab',

                            _AT: tid,

                            _I: zid,

                            _TI: zti,
                            
                            _N: zname,
                        }
                    )
                    
    }

    InitViewModal( ztitle )
    {
  
        title = ztitle
  
        closebutton = 'Close';
  
    }

    InitViewModalXL(ztitle )
    {
 
        title = ztitle
 
        closebutton = 'Close';
 
        size = 'xl';
 
    }

    InitInsertModal( ztitle , zv1, zv3)
    {

        title = ztitle

        submitbutton = 'Add';

        closebutton = 'Close';

        url = '/UNIV/INSERT';

        v1 = zv1;
        
        d = JSON.stringify({

            _D: zv3

        })

        ids = encryptData(d,hp);

    }

    InitDeleteModal( ztitle, zv1, c)
    {
        title = ztitle
 
        url = '/UNIV/DELETE';
 
        v1 = zv1;
 
        submitbutton = 'Confirm';
 
        closebutton = 'Close';

        d = JSON.stringify({

            _D: c

        })

        ids = encryptData(d,hp);
        
    }

    InitUpdateModalSingle( ztitle , zv1='', c,  w='', sz='', zurl='', encType = false )
    {
        d = JSON.stringify({
            
            _MD: c,
            _W: w

        })

        ids = encryptData(d,hp);

        title = ztitle

        submitbutton = 'Update';

        closebutton = 'Close';

        url = '/UNIV/EDIT'

        if (zurl != '')
        {
            url = zurl;
        }

        if (encType != '')
        {
            v6 = 'multipart/form-data';
        }

        v1 = zv1;
        
        size = sz;
    
    }

    InitUpdateModalXl(ztitle , zv1)
    {
        title = ztitle
        submitbutton = 'Update';
        closebutton = 'Close';
        url = '/UNIV/UPDATE';
        v1 = zv1;
        size = 'xl';
    }

    Title( ztitle )
    {
        title = ztitle;
    }

    SubmitButton( zsubmitbutton = '' )
    {
        submitbutton = zsubmitbutton;
    }

    CloseButton( zclosebutton = '' )
    {
       closebutton = zclosebutton;
    }

    Url( zurl )
    {
        url = zurl;
    }

    AlertOutput( zalertoutput )
    {
        alertoutput = zalertoutput;
    }


    Show()
    {
        data =  {

                    modalTitle: title,

                    modalContent: zcontent,

                    modalSize: size,

                    buttonSubmit:  submitbutton,

                    buttonCancel: closebutton,

                    url: url,

                    v1: v1,

                    v2: alertoutput,

                    v3: ids,
                    
                    v6: v6,

                }

        __BUILDERN(data);

        if(addtl)
        {

            __ADDTL(addtl);

        }
  
    }

}

class LazyForm{

    init( formName , appendTo )
    {

        var defaultFormJson = [];

        var panels = [];
        
        var rows = [];

        var columns = [];

        var contents = [];

        var panelCount = 0;

        var rowCount = 0;

        var columnCount = 0;

        var contentCount = 0;

        var appendTo;

        window.onload = function(){

            var request = new XMLHttpRequest();
        
            request.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {

                    defaultForm = this.responseText;

                    defaultFormJson = JSON.parse(defaultForm);

                    this.appendTo = appendTo;

                    $.each(defaultFormJson, function(key, form) {

                        if( typeof(form['formName']) != "undefined" && form['formName'] == formName )
                        {

                            panels = [];

                            $.each( form['panels'], function(key, panel) {

                                panels.push(panel)

                                /* $.each( panel['rows'], function(key, row) {
                                    
                                    rowCount++;

                                    rows.push([row['order'],rowCount,panelCount,row['title']])

                                    $.each( row['columns'], function(key, col) {
                                    
                                        colCount++;
                
                                        columns.push( [rowCount, colCount, col['type'],  col['title'] ] )
                                    
                                        $.each( col['contents'], function(key, content) {
                                    
                                            contentCount++;

                                            contents.push( [colCount, content] )

                                        })
                                        
                                    })
                                    
                                }) */

                            })

                            panels.sort(LazyForm.sortFunction);

                            if( typeof(panels) != "undefined" )
                            {

                                $.each( panels, function(key, panel) {

                                    panelCount++;

                                    rows = [];
    
                                    LazyForm.writePanel( panelCount, panel['title'], appendTo)
    
                                    $.each( panel['rows'], function(key, row) {
    
                                       rows.push(row)

                                    })
    
                                    rows.sort(LazyForm.sortFunction);
    
                                    $.each( rows, function(key, row) {

                                        columns = [];
    
                                        rowCount++;

                                        LazyForm.writeRow( rowCount,  panelCount, row['title'] )
    
                                        $.each( row['columns'], function(key, column) {

                                            columns.push(column);
    
                                        })
        
                                        columns.sort(LazyForm.sortFunction);

                                        $.each( columns, function(key, column) {
    
                                            columnCount++;
    
                                            LazyForm.writeColumn( rowCount, columnCount, column['type'], column['title'] )

                                            $.each( column['contents'], function(key, content) {
                                               
                                                LazyForm.writeElement( content,columnCount )
                
                                            })
            
                                        })
    
                                    })
    
                                })

                            }

                           

                            return false;//break
                        }
                    
                    })

           

                    // rows.sort((a, b) => a[0] - b[0]);

                    // cols.sort((a, b) => a[0] - b[0]);

                    // contents.sort((a, b) => a[0] - b[0]);


                    // LazyForm.writeForm(panels,rows,cols,contents,appendTo);

                }
            };
        
            request.open('GET', '/ld/func/zForms.json', true);

            request.send();

        }

    }

    
    static sortFunction(a, b) { 

        return a.order - b.order  ||  a.name.localeCompare(b.name);

    }

    static setImagePull( fileInputId , imageId )
    {

        const inputFile = document.getElementById(fileInputId)

        const previewImage = document.getElementById(imageId)

        inputFile.addEventListener("change", function(){

            const file = this.files[0];

            if( file )
            {

                const reader = new FileReader();

                reader.addEventListener("load", function(){
                    
                    previewImage.setAttribute("src", this.result)
                })

                reader.readAsDataURL(file)

            }

        })
    }

    static addImage( imageId , label )
    {
        var output = '<label style="font-size:9pt;" class="text-muted mt-2 ">'+label+'</label><br>';

        output += '<img src="..." class="border rounded" alt="" id="Image'+imageId+'" style="height:100%; width:100%;">';

        return output;

    }

    static addInput ( label, inputId, tc, cc, type, ig)
    {
        
        if( type == 'hidden' )
        {

            var output = '<label style="font-size:9pt;" class="text-muted mt-2 " hidden>'+label+'</label><input ig="'+ig+'" name="'+cc+'" cc="'+cc+'" tc='+tc+' it="'+type+'" class="userInput form-control form-control-sm" type="text" id="txtInput'+inputId+'" hidden>'
       
        }
        else
        {

            var output = '<label style="font-size:9pt;" class="text-muted mt-2 ">'+label+'</label><input ig="'+ig+'" cc="'+cc+'" name="'+cc+'" tc='+tc+' it="'+type+'" class="userInput form-control form-control-sm" type="'+type+'" id="txtInput'+inputId+'">'

        }

        return output;

    }

    static addFileInput ( label, inputId, tc, cc, type, ig)
    {

        var output = '<label class="custom-file-label" for="customFile">'+label+'</label>'
        
        output += '<div class="custom-file"><input type="file" class="userInput custom-file-input" it="'+type+'" ig="'+ig+'" cc="'+cc+'" tc='+tc+' name="'+cc+'"  id="FileInput'+inputId+'"></div>'

        return output;

    }

    static addCheckbox( label, inputId, tc, cc, ig, type )
    {
       var output = '<div class="form-check my-3"><input class="userInput form-check-input" type="checkbox" it="'+type+'" name="'+cc+'" ig="'+ig+'" tc='+tc+' cc='+cc+' id="chkBox'+inputId+'">'
       
       output += '<label class="form-check-label" for="chkBox'+inputId+'">'+label+'</label></div>'

       return output;

    }

    static addSubtitle( output )
    {
        var output = '<h6 class="font-weight-bold border-bottom text-center text-muted mt-4 " style="font-size:8pt;"> '+output+'</h6>'

        return output;

    }

    static writePanel( panelId, panelHeader, appendTo )
    {

        if( panelId == '1' )
        {

            var output = '<div class="panel" id="panel'+ panelId +'" >';

            output += '<div class="col my-3 pl-0 mb-1 font-weight-bold text-muted border-bottom pb-1 text-secondary" id="header" style="font-size:9pt;">' + panelHeader+'</div><div class="container"></div></div>';

        }
        else
        {
            var output = '<div class="panel" hidden id="panel' + panelId +'" >';

            output += '<div class="col my-3 pl-0 mb-1 font-weight-bold text-muted border-bottom pb-1 text-secondary" id="header" style="font-size:9pt;">' + panelHeader+'</div><div class="container"></div></div>';

        }

        $(appendTo).append( output );
            
    }

    static writeRow( rowId, panelid, rowName )
    {

        var output = '<div class="row  pb-1" id="row'+rowId+'" name="'+rowName+'"> </div>';

        $('#panel'+panelid+' .container').append( output );

    }

    static writeColumn( rowId, colId, colType, name )
    {

        var output = '<div class="'+colType+' px-1" id="col'+colId+'" name="'+name+'"> </div>';

        $('#row'+rowId).append( output );

    }

    static writeElement( arr, colId )
    {

        if( arr['element'] == 'input' )
        {

            if( arr['type'] == 'text' || arr['type'] == 'date' || arr['type'] == 'hidden')
            {

                var output = this.addInput(arr['label'],arr['id'], arr['tc'], arr['cc'], arr['type'], arr['ig'] )

                $('#col' + colId).append(output);

            }

            if( arr['type'] == 'image-file' )
            {

                var output = this.addFileInput(arr['label'],arr['id'], arr['tc'], arr['cc'], arr['type'], arr['ig'] )

                $('#col' + colId).append(output);

            }

            if( arr['type']== 'checkbox' )
            {
                var output = this.addCheckbox(arr['label'],arr['elementId'], arr['tc'], arr['cc'], arr['ig'], arr['type'] )

                $('#col' + colId).append(output);

            }

            if( arr['type'] == 'select' )
            {
                x =  JSON.stringify({

                    v1: arr['pf'],

                    v2: [ [ arr['pf'], arr['iV'] ], [ arr['pf'], arr['oV'] ] ]

                })

                encyptedData = encryptData(x,hp);

                $.ajax({

                    url: '/UNIV/FETCHJS/'+encyptedData,

                    dataType: 'json',

                    async: false,

                    success: function(data) {

                        var keys = [];

                        $.each(data, function(key, val){

                            $.each(val, function(key,val)
                            {
                                keys.push(key)

                            })
                            
                        })
                        
                        var output = '<label style="font-size:9pt;" class="text-muted mt-2">'+arr['label']+'</label>';
                        
                        output += '<select class="userInput custom-select-sm custom-select" name="'+arr['cc']+'" ig="'+arr['ig']+'" tc='+arr['tc']+' cc="'+arr['cc']+'" it="'+arr['type']+'" id="sel'+arr['elementId']+'"></select>'
                    
                        $('#col'+ colId).append(output);
                        
                        var output = '';
                        
                        $.each(data, function(key, val){

                            output += '<option value="'+val[keys[0]]+'">'+val[keys[1]]+'</option>'
                        
                        })

                        $('#sel'+arr['elementId']).append(output);
                    
                    }

                })

            }
        }

        if( arr['element'] == 'header' )
        {
            if( arr['type'] == 'subtitle' )
            {

                var output = this.addSubtitle(arr['label'])

                $('#col' + colId).append(output);

            }
        }

        if( arr['element'] == 'image' )
        {

            var output = this.addImage( arr['id'], arr['label'] );

            $('#col' + colId).append( output );

            $('#col' + colId).addClass( 'mb-5' );

            console.log(arr)

            LazyForm.setImagePull( 'FileInput' + arr['pf'], 'Image' + arr['id'] );

        }

        if( arr['element'] == 'button' )
        {

            if( arr['type'] == 'icon-button' )
            {

                var output = this.addSubtitle(arr['label'])

                $('#col' + colId).append(output);

            }

        }

       

    }

    static writeForm( arrPanel, arrRows, arrCols, arrContents, appendTo )
    {

        this.appendTo = appendTo

        arrPanel.forEach(val => {
        
            this.writePanel(val[0], val[1])
            
        });

        arrRows.forEach(val => {

            this.writeRow(val[0], val[1], val[2])
            
        });

        arrCols.forEach(val => {

            this.writeCol( val[0], val[1], val[2], val[3] )
            
        });

        arrContents.forEach(val => {

            this.writeElement( val[1], val[0] )
            
        });


    }

    static getKeys( arr )
    {

        let keys = [] ;

        $.each(arr, function(key, val){

            $.each(val, function(key,val)
            {
                keys.push(key)

            })

        })

        return keys;
    }





    
}

