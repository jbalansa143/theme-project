@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-primary">
                            <i class="mdi mdi-hamburger font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $menus->count() }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Total Menu</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
    
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-secondary">
                            <i class="dripicons-checklist font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $categories->count() }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ $categories->count() > 1 ? 'Categories' : 'Category' }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-success">
                            <i class="fe-trash-2 font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $availableCount }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Available</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                            <i class="ti-archive font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="mt-1"><span data-plugin="counterup">{{ $draftCount }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ $draftCount > 1 ? 'Drafts' : 'Draft'  }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div>
</div>
<!-- end row -->
@if (session()->has('flash_notification.message'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
        };
        toastr["{{ session('flash_notification.level') }}"]("{{ session('flash_notification.message') }}");
    </script>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('menu.create') }}" class="btn btn-sm btn-blue waves-effect waves-light float-end">
                    <i class="mdi mdi-plus-circle"></i> Add Menu
                </a>
                <h4 class="header-title mb-4">Manage Menus</h4>

                <div class="table-responsive">
                    <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>  
                            <th class="hidden-sm">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($menus as $menu)
                        <tr>
                            <td><b>{{ $menu->id }}</b></td>
                            <td> 
                                {{ $menu->getName() }}
                            </td>

                            <td>
                                {{ $menu->getDescription()  }}
                            </td>

                            <td>
                                @foreach($menu->getCategory() as $category)
                                    {{ $category['category'] }}
                                @endforeach
                            </td>

                            <td>
                                {{ $menu->getPrice() }}
                            </td>
                            <td>
                                <span class="badge bg-{{$menu->getStatus() == 'Available' ? 'success' : 'warning'}}">{{ $menu->getStatus('status') }}</span>
                            </td>
                            <td>
                                <div class="btn-group dropdown">
                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('menu.edit', $menu->id) }}"><i class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Edit Menu</a>
                                        <a class="dropdown-item" href="{{ route('menu.destroy', $menu->id) }}"><i class="mdi mdi-delete me-2 text-muted font-18 vertical-middle"></i>Remove</a>                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->
@endsection