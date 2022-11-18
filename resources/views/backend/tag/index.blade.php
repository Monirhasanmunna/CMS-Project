@extends('layouts.backend.main')

@push('title')
    Tag
@endpush
@section('content')
<div class="content-wrapper">
    <div class="row p-3 pl-2">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Tag List</h2>
              <a class="btn btn-sm btn-primary float-right" href="{{Route('app.post.tag.create')}}"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
            </div>
            <div class="card-body">
                <table id="table_id" class="Display compact stripe hover">
                    <thead class="table-info">
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th style="width: 400px;">Name</th>
                            <th style="width: 400px;">Slug</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $key=>$tag)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->slug}}</td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-primary" href="{{Route('app.post.tag.edit',$tag->id)}}"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                <form id="deleteForm" action="{{Route('app.post.tag.delete',$tag->id)}}" method="post" style="display: none;">
                                    @csrf
                                </form>
                                <a class="btn btn-sm btn-danger" onclick="deleteBtn({{$tag->id}})"  href="javascript::void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
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
@endpush
