@extends('index')
@section('content')
<div class="bs-example container">

      <h3> Add new record </h3>
      <form action="{{url('/addRecord')}}" class="form" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="formResults"></div>
          <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="name">
              </div>
          </div>

          <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                  <input type="file" class="form-control" name="image" >
              </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Screen name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="screen_name">
            </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="content"></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea  class="form-control" name="description"></textarea>
            </div>
          </div>

          <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">User name</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="user_name">
              </div>
          </div>

          <div class="form-group row">
              <div class="col-sm-10 offset-sm-2">
                <button  class="btn btn-success submit-btn">Save</button>
                <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-secondary">Cancel</button>
              </div>
          </div>
      </form>

</div>
@endsection
