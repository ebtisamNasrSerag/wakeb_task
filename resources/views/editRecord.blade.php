@extends('index')
@section('content')
<div class="bs-example container">

      <h3> Edit new record </h3>
      <form action="{{url('/editRecord',$record->id)}}" class="form" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="formResults"></div>
          <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" value="{{$record->name}}">
              </div>
          </div>

          <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10 row">
                <div class="col"><input type="file" class="form-control" name="image" ></div>
                  <div class="col"> <img src="{{asset('imgs/'.$record->image)}}" style="width:90px;height:70px"></div>


              </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Screen name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="screen_name" value="{{$record->screen_name}}">
            </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="content">{{$record->content}}</textarea>
            </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea  class="form-control" name="description">{{$record->description}}</textarea>
            </div>
          </div>

          <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">User name</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="user_name" value="{{$record->user_name}}">
              </div>
          </div>

          <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10 " style="text-align:left">
                 <span>Active  </span><input type="radio"  name="status" value="1" {{$record->status == 1? 'checked':''}}>
                 <span>Disable </span><input type="radio"  name="status" value="0" {{$record->status == 0? 'checked':''}}>
              </div>

          </div>

          <div class="form-group row">
              <div class="col-sm-10 offset-sm-2">
                <button   class="btn btn-success submit-btn" onClick="setTimeout(location.reload.bind(location), 1500);">Save</button>
                <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-secondary">Cancel</button>
              </div>
          </div>
      </form>

</div>
@endsection
