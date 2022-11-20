@extends('layouts.backend.main')

@push('title')
    Post
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row p-3 pl-2">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h2 class="card-title">Post List</h2>
                      <a class="btn btn-sm btn-primary float-right" href="{{Route('app.post.post.create')}}"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="Display compact stripe hover">
                            <thead class="table-info">
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th style="width: 80px;">Image</th>
                                    <th style="width: 200px;">Name</th>
                                    <th style="width: 120px;">Category</th>
                                    <th style="width: 200px;">Tag</th>
                                    <th style="width: 100px;">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $key=>$post)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><img style="width: 50px;height:50px;border-radius:10px;" src="{{asset('storage/post/'.$post->image)}}" alt=""></td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->category->name}}</td>
                                    <td>
                                        @foreach ($post->tags as $tag)
                                            <span class="badge badge-primary">{{$tag->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($post->status == true)
                                            <span class="badge badge-primary">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" onclick="postShow({{$post->id}})" href="javascript:void(0)"><i class="fa-solid fa-eye"></i>Show</a>
                                        <a class="btn btn-sm btn-primary" href="{{Route('app.post.post.edit',$post->id)}}"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                        <form id="deleteForm" action="{{Route('app.post.post.delete',$post->id)}}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="btn btn-sm btn-danger" onclick="deleteBtn({{$post->id}})"  href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="productDetailsModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
       <div class="container_fluid">
              <div class="card mb-0">
                <div class="card-header">
                    <h3 class="card-title text-primary"><i class="fa-solid fa-user-doctor"></i><span class="pl-1">POST</span></h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="img_wrapper">
                                <div class="product-image pt-2 pb-2 mb-0"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="table-wrapper">
                                <table class="detailsTable" style="width:90%;">
                                    <tr>
                                    <th style="border: 1px solid">Title:</th>
                                    <td id="title" style="border: 1px solid;width:170px"></td>
                                    </tr>
                                    <tr>
                                    <th style="border: 1px solid">Category:</th>
                                    <td id="category" style="border: 1px solid;width:170px"></td>
                                    </tr>
                                    <tr>
                                    <th style="border: 1px solid">Tags:</th>
                                    <td id="tags" style="border: 1px solid;width:170px"></td>
                                    </tr>
                                    <tr>
                                    <th style="border: 1px solid">Status:</th>
                                    <td id="status" style="border: 1px solid;width:170px"></td>
                                    </tr>
                                </table>

                                <div class="mb-0 pb-0">Description :</div>
                                <div class="mt-2" id="description">

                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
       </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script>
        function deleteBtn(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $("#deleteForm").submit();
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            });
        }
    </script>

    <script>
        function postShow(id){
            
            $.ajax({
                url     : '/app/post/post/show/'+id,
                type    : 'Get',
                dataType: 'json',
                success : function(response){
                    console.log(response);
                    $(".product-image").html('<img id="img" style="width:100%;height:100%;" src="{{asset('storage/post')}}'+'/'+response.image+'" alt="" class="product-pic">');
                    $("#title").html(response.title);
                    $("#category").text(response.category.name);
                    $("#description").html(response.description);
                    if(response.status == true){
                        $("#status").html(`<span class='badge badge-info mr-1'>Active</span>`);
                    }else{
                        $("#status").html(`<span class='badge badge-danger mr-1'>Inactive</span>`);
                    }
                    $("#tags").empty();
                    $.each(response.tags,function(index,value){
                        var data = `<span class='badge badge-primary mr-1'>${value.name}</span>`;
                        $("#tags").append(data);
                    });
                    $("#productDetailsModal").modal('show');
                }
            });
        }
    </script>
@endpush
