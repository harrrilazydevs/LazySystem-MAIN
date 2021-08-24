<script type="text/javascript">


  $( document ).ready(function() {

      calculate_age('age','birthdate')
      
  });


  $('.emp_chg_profile').on('click', function(){

    var id = $('.fd').attr('identifier');

    let zmodal = new LazyModal();


    zmodal.InitUpdateModalSingle("Update Profile Picture", '0', $('.fd').attr('identifier'), 1,'','/UNIV/EDIT', true);

    zmodal.addFileInput('14','txtPicture');

    zmodal.AlertOutput('Profile Picture updated successfully.');

    zmodal.Show();

    })

    $('.emp_chg_signature').on('click', function(){

    var id = $('.fd').attr('identifier');

    let zmodal = new LazyModal();

    zmodal.InitUpdateModalSingle("Update Signature", '0', $('.fd').attr('identifier'), 1,'','/UNIV/EDIT', true);

    zmodal.addFileInput('13','txtPicture');

    zmodal.AlertOutput('Signature updated successfully.');

    zmodal.Show();

    })

  
  $('#btnAccountInfo').on('click',function(){

    let zmodal = new LazyModal();

    zmodal.InitUpdateModalSingle("Edit Account Information", 1,  $(this).attr('identifier'), 4);

    zmodal.addLabel('Position');
    zmodal.addSelect('3','selRole');
    zmodal.addOption('selRole','DEVELOPER','Developer');
    zmodal.addOption('selRole','ADMINISTRATOR','Administrator');
    zmodal.addOption('selRole','PROFESSOR','Professor');
    zmodal.addOption('selRole','SECRETARY','Secretary');
    zmodal.addOption('selRole','ACCOUNTING','Accounting');
    zmodal.addOption('selRole','IT STAFF','IT Staff');
    zmodal.addOption('selRole','REGISTRAR','Registrar');

    zmodal.addLabelR('Email');
    zmodal.addTextBox('1','',$(this).attr('email'));

    zmodal.AlertOutput('Account Information Updated Successfully');

    zmodal.Show();

    $('#selRole').val($(this).attr('employee_role'))

  })

  $('#btnPersonalInfo').on('click',function(){

    if( $(this).attr('ld-edit-mode') == '1')
    {

      $('.p_info').attr('readonly',false);

      $(this).attr('ld-edit-mode', '0')

      $(this).addClass('text-danger')

      $('#btnSave').removeClass('d-none');

      $('#edit_cancel_icon').removeClass('d-none');

      $('#edit_icon').addClass('d-none');

    }
    else
    {

      $('.p_info').attr('readonly',true);

      $(this).attr('ld-edit-mode','1')

      $('#btnSave').addClass('d-none');

      $('#edit_icon').removeClass('d-none');

      $('#edit_cancel_icon').addClass('d-none');

      $(this).removeClass('text-danger')

    }

  })

  $('#btnSave').on('click',function(){

    $('.p_info').attr('readonly',false);

    $('#btnSave').removeClass('d-none');

  })

</script>