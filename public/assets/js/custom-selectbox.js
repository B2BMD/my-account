$('body').on('click', '.select-value-box', function(){
    var obj = $(this).closest('.custom-dropdown');

    if (!$(this).hasClass('active')) {
        $('.select-box-dropdown li').hide();
        $('.select-value-box').removeClass('active');
        $('.select-box-dropdown').slideUp('fast');
    }

    $(obj).find('.select-box-dropdown li').show();
    $(obj).find('.select-box-dropdown').slideToggle('fast');
    $(obj).find('.select-value-box').toggleClass('active');
});
$('body').on('click', '.select-box-dropdown li', function(){
    var obj = $(this).closest('.custom-dropdown');
    if($(obj).hasClass('multi-select')){
        if($(this).hasClass('selected')){
            $(this).removeClass('selected');
        }else{
          $(this).addClass('selected');
        }
      var selectedList = $(this).text();
      var selectedValues = $('.listing-values').text().split(',');
      if ($.inArray(selectedList, selectedValues) >= 0) {
          selectedValues = jQuery.grep(selectedValues, function(value) {
               return value != selectedList;
      });
      var blkstr = $.map(selectedValues, function(val,index) {
           var str = val;
           return str;
      }).join(",");
      $(obj).find('.listing-values').text(blkstr);
      }else {
          $(obj).find('.listing-values').append(',' +selectedList);
      }
    
    }else{
      $(obj).find('.select-box-dropdown li').removeClass('selected');
      $(this).addClass('selected');
      var selectedList = $(this).text();
      $(obj).find('.select-box-dropdown').slideToggle('fast');
      $(obj).find('.select-value-box').toggleClass('active');   
      $(obj).find('input').val(selectedList); 
    }

});
$('body').on('keyup', '.custom-input input', function () {
  var searchText = $.trim($(this).val().toLowerCase());
  var listing = $(this).parents('.custom-dropdown').find('.select-box-dropdown li');
  $(".select-box-dropdown li").each(function() {
      if ($(this).html().toLowerCase().indexOf(searchText) != -1) {
          $(this).show();
      }
      else {
          $(this).hide();  
      }

  });
});
$('body').on('keyup', '.select-value-box input', function () {
  var searchText = $.trim($(this).val().toLowerCase());
  var listing = $(this).parents('.custom-dropdown').find('.select-box-dropdown li');
  $(".select-box-dropdown li").each(function() {
      if ($(this).html().toLowerCase().indexOf(searchText) != -1) {
          $(this).show();
      }
      else {
          $(this).hide();  
      }

  });
});
$('body').on('focus', '.custom-input input', function () {
    $(this).closest('.custom-input').toggleClass('active');
});
$('body').on('click', function (e) {
    if(!$(e.target).closest('.custom-dropdown').length && !$(e.target).closest('.select-box-dropdown').length && !$(e.target).hasClass('.custom-dropdown') && !$(e.target).closest('.custom-input').length){     
          $('.select-box-dropdown').css('display', 'none');
          $('.select-box-dropdown').css('display', 'block');
          $('.select-box-dropdown').css('display', 'none');
          $('.select-value-box').removeClass('active');
          $('.custom-input').removeClass('active');
    }
});