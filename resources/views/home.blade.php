<!DOCTYPE html>
<html lang="en">
<head>
<title>Laravel DataTable</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link  href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
<link  href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
th, td {
    white-space: nowrap;
    vertical-align: middle !important;
 }
div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
#reportrange{
  background: #ddd; cursor: pointer; padding: 5px 10px;
  border: 1px solid #ccc;
  display: inline-block;
}
.picker{
text-align: center;
margin-top: 5px;
margin-bottom: 5px;
}

</style>
</head>
      <body>
         <div class="container">
           <div class="picker">

               <label>Filter by date :</label>
               <div id="reportrange">
                  <i class="glyphicon glyphicon-calendar"></i>&nbsp;
                  <span class="datepick"></span><i class="glyphicon glyphicon-triangle-bottom"></i>
                  <input type="hidden" name="start_date"  class="start_date"  >
                  <input type="hidden" name="end_date"  class="end_date" >
                </div>

            </div>
            @if(Session::get('message'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('message')}}
            </div>
            @endif
            <table class=" table stripe row-border order-column "  id="laravel_datatable">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Screen name</th>
                     <th>Content</th>
                     <th>Description</th>
                     <th>User name</th>
                     <th>Date</th>
                     <th>Status</th>
                     <th><i class="glyphicon glyphicon-cog"></i></th>
                  </tr>
               </thead>
            </table>
            <a href="{{url('/addRecord')}}" class="btn btn-primary" style="float:right;margin:5px 5px 20px;">
              <i class="glyphicon glyphicon-plus"></i> Add New Record</a>
         </div>





   <script>
   $(document).ready( function () {
     //confirm massege for delete
     $('.del').on('click',function(e){
       var result = confirm("Are you sure you want to delete ?");
           if(!result) {
               e.preventDefault();
           }
     });

    $('#laravel_datatable').DataTable({
           scrollX:        true,
           scrollCollapse: true,

           fixedColumns:   {
            leftColumns: 2,
            rightColumns: 1
           },
           processing: true,
           serverSide: true,
           lengthMenu: [[5,10, 25, 50, -1],[5,10, 25, 50, "All"]],

           ajax: {
                    url: "{{ route('/getdata') }}",
                    },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name'},
                    { data: 'screen_name', name: 'screen_name' },
                    { data: 'content', name: 'content' },
                    { data: 'description', name: 'description' },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'date', name: 'date' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false ,sClass: "center"}
                 ],
    });
    });

  </script>
  <script>
  $(document).on('click','.submit-btn',function(){
    btn = $(this);
    form = btn.parents('.form');
    url = form.attr('action');
    data = new FormData(form[0]);

    $.ajax({
      url : url,
      type : 'POST',
      data : data,
      cache : false,
      processData : false,
      contentType : false,
    });
    return false;
  });
  </script>


 <script type="text/javascript" src="{{asset('js/datePicker.js')}}"></script>
   </body>
</html>
