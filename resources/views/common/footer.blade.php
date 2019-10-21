<script>
$(document).on('click','.submit-btn',function(){
  btn = $(this);
  form = btn.parents('.form');
  url = form.attr('action');
  data = new FormData(form[0]);
  formResults = form.find('#formResults');
  $.ajax({
    url : url,
    type : 'POST',
    data : data,
    datatype : 'JSON',
    success : function(results){
      if(results.errors)
      {
         formResults.removeClass().addClass('alert alert-danger').html(results.errors);
      }else{
        formResults.removeClass().addClass('alert alert-success').html(results.success);
        $(form)[0].reset();
      }
    },
        cache : false,
        processData : false,
        contentType : false,
  });
  return false;
});
</script>

</body>
</html>
