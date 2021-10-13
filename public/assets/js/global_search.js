
var html='<div class="loader" style="display:none;">';
html = html + '<div>';
html = html + '<div class="sk-circle">';
html = html + '<div class="sk-circle1 sk-child"></div>';
html = html + '<div class="sk-circle2 sk-child"></div>';
html = html + '<div class="sk-circle3 sk-child"></div>';
html = html + '<div class="sk-circle4 sk-child"></div>;'
html = html + '<div class="sk-circle5 sk-child"></div>;'
html = html + '<div class="sk-circle6 sk-child"></div>;'
html = html + '<div class="sk-circle7 sk-child"></div>;'
html = html + '<div class="sk-circle8 sk-child"></div>;'
html = html + '<div class="sk-circle9 sk-child"></div>;'
html = html + '<div class="sk-circle10 sk-child"></div>;'
html = html + '<div class="sk-circle11 sk-child"></div>;'
html = html + '<div class="sk-circle12 sk-child"></div>;'
html = html + '</div>;'
html = html + '</div>;'
html = html + '</div>';
    
    $(document).click(function(){
      $('#dropdown-inner').empty();
      $('#dropdown-inner').hide();
    });
  if(localStorage.json_userdata){
    var users = JSON.parse(LZString.decompress(localStorage.json_userdata));
    // var users = LZString.decompress(localStorage.json_userdata);
    // JSON.parse(users->condition_qas)

    // to clear the search bar and remove the list after clicking somewhere else
    $(document).on('keyup','#myInput',function(e){  
      $('#dropdown-inner').empty();
      $('#dropdown-inner').hide();
      var input = $('#myInput').val().toLowerCase();
      if($.trim(input) != "")
      {
        var flag = 0;    // variable for flag
        // searching the search item in oblects of arrays of users array        
        for(var i=0; i<users.length ;i++)
        {
          // if case for the doctors
          if(
            users[i]["prescriber_firstname"].toLowerCase().indexOf(input) > -1 || 
            users[i]["prescriber_lastname"].toLowerCase().indexOf(input) > -1 ||
            users[i]["prescriber_email"].toLowerCase().indexOf(input) > -1 || 
            users[i]["prescriber_phonenumber"].toLowerCase().indexOf(input) > -1 ||
            users[i]["diagnosis"].toLowerCase().indexOf(input) > -1
          )
          {
            $('#dropdown-inner').append('<a href="'+app_url+'/filter/Doctor/'+users[i]["case_number"]+'" onclick="return showLoaderFunc()">'+users[i]["prescriber_firstname"]+ ' '+ users[i]["prescriber_lastname"]+'</a>');
            flag = 1;            
          }  
          // if case for the daignosis
          if(
            users[i]["medications"].toLowerCase().indexOf(input) > -1
          )
          {
            $('#dropdown-inner').append('<a href="'+app_url+'/filter/Diagnosis/'+users[i]["case_number"]+'" onclick="return showLoaderFunc()">'+users[i]["medications"]+'</a>');
            flag = 1;            
          }
          // if case for medicines
          if(
            users[i]["actual_prescription_name"].toLowerCase().indexOf(input) > -1
          )
          {
            $('#dropdown-inner').append('<a href="'+app_url+'/filter/Medicine/'+users[i]["case_number"]+'" onclick="return showLoaderFunc()">'+users[i]["actual_prescription_name"]+'</a>');
            flag = 1;            
          }

        }        
        if(flag == 0){
          $('#dropdown-inner').html('<a href="javascript:void(0)">No Record Found</a>');          
        }
        $('#dropdown-inner').show();
      }  
    });
    
  }
  function showLoaderFunc(){
    $('.loader').show();
  }
  
