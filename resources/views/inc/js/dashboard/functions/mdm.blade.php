<script type="text/javascript">

  $( document ).ready(function() {


  });





/*** USERS ***/ 

  $('.w_mdm_users_add').on('click', function(){

    // let zmodal = new LazyModal();

    // zmodal.InitInsertModal( "New Record" );

    // zmodal.addLabel('Identifier');
    // zmodal.addTextBox('', '', $(this).attr('ld-identifier'), 'form-control mb-2 mt-0','','readonly' );

    // zmodal.addLabel('Email');
    // zmodal.addTextBox('', '', $(this).attr('ld-email'), 'form-control mb-2','','readonly' );

    // zmodal.addLabel('Role');
    // zmodal.addTextBox('', '', $(this).attr('ld-role'), 'form-control mb-2','','readonly' );

    // zmodal.Show();

  })

  $('.mdm_view_archived').on('click', function(){

    let zmodal = new LazyModal();

    zmodal.InitViewModal("Account Information");

    zmodal.addLabel('Identifier');
    zmodal.addTextBox('', '', $(this).attr('ld-identifier'), 'form-control mb-2 mt-0','','readonly' );

    zmodal.addLabel('Email');
    zmodal.addTextBox('', '', $(this).attr('ld-email'), 'form-control mb-2','','readonly' );

    zmodal.addLabel('Role');
    zmodal.addTextBox('', '', $(this).attr('ld-role'), 'form-control mb-2','','readonly' );

    zmodal.Show();

  })

  $('.mdm_view_user').on('click', function(){

    // alert($(this).attr('ld-id'));

    let zmodal = new LazyModal();

    zmodal.InitViewModal("Account Information");

    zmodal.addLabel('Identifier');
    zmodal.addTextBox('', '', $(this).attr('ld-identifier'), 'form-control mb-2 mt-0','','readonly' );

    zmodal.addLabel('Email');
    zmodal.addTextBox('', '', $(this).attr('ld-email'), 'form-control mb-2','','readonly' );

    zmodal.addLabel('Role');
    zmodal.addTextBox('', '', $(this).attr('ld-role'), 'form-control mb-2','','readonly' );

    zmodal.Show();

    

  })

  $('.mdm_edit_user').on('click', function(){

      let zmodal = new LazyModal();

      zmodal.InitUpdateModalSingle("Edit Account Information", 1,  $(this).attr('ld-identifier'), 4);

      zmodal.addLabel('Role');
      zmodal.addSelect('3', 'selRole', ' ', 'form-control mb-2' );
      zmodal.addOption('selRole','EMPLOYEE','Employee');
      zmodal.addOption('selRole','STUDENT','Student');

      zmodal.addLabel('Identifier');
      zmodal.addSelect('4','selIdentifier','' ,'form-control mb-2' );

      // zmodal.addSource(
      //   JSON.stringify({  
      //                     'zv1':

      //   })
      // )

      zmodal.addLabel('Email');
      zmodal.addTextBox('1', '', $(this).attr('ld-email'), 'form-control mb-2');

     

      zmodal.AlertOutput('Account Information Updated Successfully');

      zmodal.Show();

      $('#selRole').val($(this).attr('ld-role'))


  })

/*** END USERS ***/



/*** CLASSROOM ***/ 

  $('.mdm_view_classroom').on('click', function(){

    let zmodal = new LazyModal();

    zmodal.InitViewModal("Classroom Information");

    zmodal.addLabel('Classroom Name');
    zmodal.addTextBox('', '', $(this).attr('ld-name'), 'form-control mb-2 mt-0','','readonly' );

    zmodal.addLabel('Description');
    zmodal.addTextBox('', '', $(this).attr('ld-desc'), 'form-control mb-2 mt-0','','readonly' );

    

    zmodal.Show();

  })

  $('.mdm_insert_classroom').on('click', function(){

    let zmodal = new LazyModal();

    zmodal.InitInsertModal("New Classroom", 2,  $(this).attr('ld-identifier'));

    zmodal.addLabel('Classroom Name');
    zmodal.addTextBox('1', '', $(this).attr('ld-name'), 'form-control mb-2 mt-0');

    zmodal.addLabel('Classroom Description');
    zmodal.addTextBox('2', '', $(this).attr('ld-desc'), 'form-control mb-2 mt-0');

    zmodal.addLabel('Classroom Status');
    zmodal.addSelect('3', 'selStatus');
    zmodal.addOption('selStatus', 'VACANT','Vacant');
    zmodal.addOption('selStatus', 'OCCUPIED','Occupied');
    zmodal.addOption('selStatus', 'UNDER CONSTRUCTION','Under Construction');
    zmodal.addOption('selStatus', 'NEEDS MAINTENANCE','Needs Maintenance');

    zmodal.AlertOutput('Classroom Information Updated Successfully');

    zmodal.Show();

  })


  $('.mdm_edit_classroom').on('click', function(){

    let zmodal = new LazyModal();

    zmodal.InitUpdateModalSingle("Edit Classroom Information", 2,  $(this).attr('ld-identifier'));

    zmodal.addLabel('Classroom Name');
    zmodal.addTextBox('1', '', $(this).attr('ld-name'), 'form-control mb-2 mt-0');

    zmodal.addLabel('Classroom Description');
    zmodal.addTextBox('2', '', $(this).attr('ld-desc'), 'form-control mb-2 mt-0');

    zmodal.addLabel('Classroom Status');
    zmodal.addSelect('3', 'selStatus');
    zmodal.addOption('selStatus', 'VACANT','Vacant');
    zmodal.addOption('selStatus', 'OCCUPIED','Occupied');
    zmodal.addOption('selStatus', 'UNDER CONSTRUCTION','Under Construction');
    zmodal.addOption('selStatus', 'UNDER MAINTENANCE','Under Maintenance');

    zmodal.AlertOutput('Classroom Information Updated Successfully');



    zmodal.Show();

  })

  $('.mdm_delete_classroom').on('click', function(){

    let zmodal = new LazyModal();

    zmodal.InitDeleteModal("Delete Classroom Information", 2,  $(this).attr('ld-identifier'));

    zmodal.addLabel('Confirm Delete file?');


    zmodal.AlertOutput('Classroom Information Deleted Successfully');

    zmodal.Show();

  })


/*** END CLASSROOM ***/




/*** EMPLOYEE ***/

  $('.mdm_view_employee').on('click', function(){

      alert($(this).attr('ld-employee_code'));



  })

/*** END EMPLOYEE ***/





</script>