@extends('layouts.backend.main')

@push('title')
    Post
@endpush

@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    padding-top: 2px;
  }

  .ck-editor__editable[role="textbox"] {
      min-height: 200px;
  }

  input.status {
            width: 20px;
            height: 20px;
            padding-right: 10px;
  }
 </style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
        <div class="row p-1 pt-3">
          <div class="col-12">
              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Add Post</h3>
                  </div>
                  <form action="{{isset($post)? Route('app.post.post.update',$post->id) : Route('app.post.post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
  
                    @if(isset($post))
                     @method('PUT')
                    @endif
  
                        <div class="card-body">
                          <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" value="{{$post->title ?? old('title')}}" name="title" id="title" placeholder="Enter Post Title">
                          </div>
  
                          <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="js-example-placeholder-single js-states form-control @error('patient') is-invalid @enderror" style="width: 100%">
                                  <option></option>
                                  @foreach ($categories as $category)
                                    <option value="{{$category->id}}"
                                      @if(isset($post))
                                      {{($post->category_id == $category->id)?'selected':''}}
                                      @endif
                                      >{{$category->name}}</option> 
                                  @endforeach
                              </select>
                              @error('category')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                          </div>
  
                          <div class="form-group">
                            <label>Tag</label>
                            <select name="tag_id[]" multiple='multiple' class="js-example-placeholder-single js-states form-control @error('patient') is-invalid @enderror" style="width: 100%">
                                  <option></option>
                                  @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}"
                                      @if(isset($post))
                                      @foreach ($post->tags as $t)
                                      {{($t->id == $tag->id)?'selected':''}}
                                      @endforeach
                                      @endif
                                      >{{$tag->name}}</option> 
                                  @endforeach
                              </select>
                              @error('tag')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                          </div>
  
                          <div class="form-group">
                            <label for="customFile">Choose Image</label>
                            <div class="custom-file">
                              <input type="file" name="image" class="custom-file-input" id="image" onchange="document.getElementById('imagePrev').src = window.URL.createObjectURL(this.files[0])"
                              class="@error('image') is-invalid @enderror">
                              <label class="custom-file-label" for="customFile">Choose Image</label>
                              @error('image')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <img class="mt-2" id="imagePrev" src="{{isset($post)?asset('storage/post/'.$post->image): ''}}" width="100" height="100" style="border-radius: 5px"/>
                             @if (isset($post))
                             <div class="mt-3">
                                <h4 class="p-0 m-0">Old Image :</h4>
                                <img class="mt-2" id="oldPic" src="{{isset($post)?asset('storage/post/'.$post->image): ''}}" width="100" height="100" style="border-radius: 5px"/>
                             </div>
                             @endif
                          </div>
  
                          <div class="form-group">
                            <label for="description">Description</label>
                            <div class="description">
                              <textarea name="description" id="editor" cols="30" rows="100">{{isset($post)? $post->description : ''}}</textarea>
                            </div>
                          </div>
  
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input status" id="status" @if(isset($post)) {{($post->status == 1) ? 'checked' : ''}} @endif name="status" value="1">
                            <label class="form-check-label" style="margin-left: 5px;margin-top:3px;" for="status">Status</label>
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

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>


<script>
  $(".js-example-placeholder-single").select2({
      placeholder: "--Select One--",
      allowClear: true
  });

  // $(document).ready(function() {
  //   $('.js-example-basic-multiple').select2({
  //       placeholder: "--Select One--",
  //       allowClear: true
  //   });
  // });
</script>

<script>
  ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .catch( error => {
          console.error( error );
      } );
</script>

<script>
  $(document).ready(function(){
    $("#imagePrev").hide();

    $("#image").change(function(){
      $("#imagePrev").show();
    });
  });
</script>
@endpush