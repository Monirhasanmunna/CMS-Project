@extends('layouts.backend.main')

@push('title')
    Category
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row p-1 pt-3">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h2 class="card-title">Category List</h2>
                      <a class="btn btn-sm btn-primary float-right" href="{{Route('app.post.category.create')}}"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></a>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="Display compact stripe hover" style="Paging button hover:#111111">
                            <thead class="table-info">
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th style="width: 300px;">Name</th>
                                    <th style="width: 300px;">Slug</th>
                                    <th style="width: 200px;">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key=>$category)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>
                                        @if($category->status == true)
                                            <span class="badge badge-primary">Active</span>
                                        @else
                                            <span class="badge badge-warning">Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{Route('app.post.category.edit',$category->id)}}"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                        <form id="deleteForm" action="{{Route('app.post.category.delete',$category->id)}}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="btn btn-sm btn-danger" onclick="deleteBtn({{$category->id}})"  href="javascript::void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
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
