@extends('layouts.backend.main')

@push('title')
    Tag
@endpush
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary m-2">
                <div class="card-header">
                  <h3 class="card-title">Add Tag</h3>
                </div>
                <form action="{{isset($tag)? Route('app.post.tag.update',$tag->id) : Route('app.post.tag.store')}}" method="POST">
                  @csrf

                  @if(isset($tag))
                   @method('PUT')
                  @endif

                      <div class="card-body">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" value="{{$tag->name ?? old('name')}}" name="name" id="name" placeholder="Enter Tag Name">
                        </div>
                      </div>
                      <div class="pb-3" style="padding-left: 20px!important;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection