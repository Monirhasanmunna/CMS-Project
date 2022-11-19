@extends('layouts.backend.main')

@push('title')
    Category
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content">
      <div class="container_fluid">
        <div class="row p-1 pt-3">
          <div class="col-12">
              <div class="card card-primary m-2">
                  <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
                  </div>
                  <form action="{{isset($category)? Route('app.post.category.update',$category->id) : Route('app.post.category.store')}}" method="POST">
                    @csrf
  
                    @if(isset($category))
                     @method('PUT')
                    @endif
  
                        <div class="card-body">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{$category->name ?? old('name')}}" name="name" id="name" placeholder="Enter Category Name">
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="status" @if(isset($category)) {{($category->status == 1) ? 'checked' : ''}} @endif name="status" value="1">
                            <label class="form-check-label" for="status">Status</label>
                          </div>
                        </div>
                        <div class="pb-3 pl-3">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                  </form>
              </div>
          </div>
      </div>
      </div>
    </div>
</div>
@endsection