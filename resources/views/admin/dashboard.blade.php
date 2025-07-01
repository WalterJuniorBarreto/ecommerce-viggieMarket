@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2>Admin Dashboard</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Admin Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Admin Dashboard Section Start -->
<section class="admin-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                <div class="dashboard-left-sidebar">
                    <div class="close-button d-flex d-lg-none">
                        <button class="close-sidebar">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="profile-box">
                        <div class="cover-image">
                            <img src="{{ asset('assets/images/inner-page/cover-img.jpg') }}" class="img-fluid blur-up lazyload" alt="">
                        </div>

                        <div class="profile-contain">
                            <div class="profile-image">
                                <div class="position-relative">
                                    <img src="{{ asset('assets/images/inner-page/cover-img.jpg') }}" class="blur-up lazyload update_img" alt="">
                                </div>
                            </div>

                            <div class="profile-name">
                                <h3>{{ auth()->user()->name }}</h3>
                                <h6 class="text-content">Administrador</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Menu de Opciones Admin -->
                    <ul class="nav nav-pills admin-nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#pills-dashboard" type="button">
                                <i data-feather="home"></i> Dashboard
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#pills-orders" type="button">
                                <i data-feather="shopping-bag"></i> Gestionar Órdenes
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-products-tab" data-bs-toggle="pill" data-bs-target="#pills-products" type="button">
                                <i data-feather="package"></i> Gestionar Productos
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-users-tab" data-bs-toggle="pill" data-bs-target="#pills-users" type="button">
                                <i data-feather="users"></i> Gestionar Usuarios
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-reports-tab" data-bs-toggle="pill" data-bs-target="#pills-reports" type="button">
                                <i data-feather="bar-chart-2"></i> Reportes
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-settings-tab" data-bs-toggle="pill" data-bs-target="#pills-settings" type="button">
                                <i data-feather="settings"></i> Configuración
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show Menu</button>
                <div class="dashboard-right-sidebar">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Dashboard Tab -->
                        <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                            <div class="dashboard-home">
                                <div class="title">
                                    <h2>Panel de Administración</h2>
                                    <span class="title-leaf">
                                        <svg class="icon-width bg-gray">
                                            <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                        </svg>
                                    </span>
                                </div>

                                <div class="dashboard-user-name">
                                    <h6 class="text-content">Bienvenido, <b class="text-title">{{ auth()->user()->name }}</b></h6>
                                    <p class="text-content">
                                        Desde aquí puedes gestionar todas las operaciones de tu tienda de frutas y verduras.
                                    </p>
                                </div>

                                <div class="total-box">
                                    <div class="row g-sm-4 g-3">
                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="total-contain">
                                                <img src="{{ asset('assets/images/svg/order.svg') }}" class="img-1 blur-up lazyload" alt="">
                                                <img src="{{ asset('assets/images/svg/order.svg') }}" class="blur-up lazyload" alt="">
                                                <div class="total-detail">
                                                    <h5>Ventas Hoy</h5>
                                                    <h3>${{ number_format($todaySales, 2) }}</h3>
                                                    <h6>{{ $todayOrders }} órdenes</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="total-contain">
                                                <img src="{{ asset('assets/images/svg/pending.svg') }}" class="img-1 blur-up lazyload" alt="">
                                                <img src="{{ asset('assets/images/svg/pending.svg') }}" class="blur-up lazyload" alt="">
                                                <div class="total-detail">
                                                    <h5>Ventas Mensuales</h5>
                                                    <h3>${{ number_format($monthlySales, 2) }}</h3>
                                                    <h6>{{ $monthlyOrders }} órdenes</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="total-contain">
                                                <img src="{{ asset('assets/images/svg/wishlist.svg') }}" class="img-1 blur-up lazyload" alt="">
                                                <img src="{{ asset('assets/images/svg/wishlist.svg') }}" class="blur-up lazyload" alt="">
                                                <div class="total-detail">
                                                    <h5>Productos</h5>
                                                    <h3>{{ $totalProducts }}</h3>
                                                    <h6>{{ $activeProducts }} activos</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                            <div class="total-contain">
                                                <img src="{{ asset('assets/images/svg/user.svg') }}" class="img-1 blur-up lazyload" alt="">
                                                <img src="{{ asset('assets/images/svg/user.svg') }}" class="blur-up lazyload" alt="">
                                                <div class="total-detail">
                                                    <h5>Usuarios</h5>
                                                    <h3>{{ $totalUsers }}</h3>
                                                    <h6>{{ $newUsers }} nuevos este mes</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gráficos -->
                                <div class="row mt-4">
                                    <div class="col-xxl-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Ventas Mensuales</h5>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="monthlySalesChart" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Productos Más Vendidos</h5>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="topProductsChart" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Últimas órdenes -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <h5>Últimas Órdenes</h5>
                                                <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-theme">Ver todas</a>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Cliente</th>
                                                                <th>Fecha</th>
                                                                <th>Total</th>
                                                                <th>Estado</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($recentOrders as $order)
                                                            <tr>
                                                                <td>#{{ $order->id }}</td>
                                                                <td>{{ $order->user->name }}</td>
                                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                                <td>${{ number_format($order->total, 2) }}</td>
                                                                <td>
                                                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'danger') }}">
                                                                        {{ ucfirst($order->status) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-theme">Ver</a>
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

                        <!-- Gestionar Órdenes Tab -->
                        <div class="tab-pane fade" id="pills-orders" role="tabpanel">
                            <div class="dashboard-orders">
                                <div class="title">
                                    <h2>Gestionar Órdenes</h2>
                                    <span class="title-leaf title-leaf-gray">
                                        <svg class="icon-width bg-gray">
                                            <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                        </svg>
                                    </span>
                                </div>
                                
                                <div class="order-actions mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="orderSearch" placeholder="Buscar órdenes...">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select" id="orderStatusFilter">
                                                <option value="">Todos los estados</option>
                                                <option value="pending">Pendiente</option>
                                                <option value="processing">Procesando</option>
                                                <option value="completed">Completado</option>
                                                <option value="cancelled">Cancelado</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="date" class="form-control" id="orderDateFilter">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-theme w-100" id="filterOrders">Filtrar</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                <td>${{ number_format($order->total, 2) }}</td>
                                                <td>
                                                    <select class="form-select status-select" data-order-id="{{ $order->id }}">
                                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Procesando</option>
                                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completado</option>
                                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-theme">Ver</a>
                                                    <button class="btn btn-sm btn-danger delete-order" data-id="{{ $order->id }}">Eliminar</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- Gestionar Productos Tab -->
                        <div class="tab-pane fade" id="pills-products" role="tabpanel">
                            <div class="dashboard-products">
                                <div class="title">
                                    <h2>Gestionar Productos</h2>
                                    <span class="title-leaf title-leaf-gray">
                                        <svg class="icon-width bg-gray">
                                            <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                        </svg>
                                    </span>
                                </div>
                                
                                <div class="product-actions mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="productSearch" placeholder="Buscar productos...">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select" id="productCategoryFilter">
                                                <option value="">Todas las categorías</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-theme" id="addProductBtn">Agregar Producto</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Categoría</th>
                                                <th>Precio</th>
                                                <th>Stock</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $product)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>${{ number_format($product->price, 2) }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input product-status" type="checkbox" id="status{{ $product->id }}" {{ $product->is_active ? 'checked' : '' }} data-product-id="{{ $product->id }}">
                                                        <label class="form-check-label" for="status{{ $product->id }}">{{ $product->is_active ? 'Activo' : 'Inactivo' }}</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-theme edit-product" data-id="{{ $product->id }}">Editar</button>
                                                    <button class="btn btn-sm btn-danger delete-product" data-id="{{ $product->id }}">Eliminar</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- Otras pestañas (Usuarios, Reportes, Configuración) -->
                        <!-- ... -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal para agregar/editar producto -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalTitle">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="productForm" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="product_id" name="id">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Categoría</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Seleccionar categoría</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mt-4 pt-2">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Producto activo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-theme">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts para gráficos y funcionalidad -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de ventas mensuales
    const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
    const monthlySalesChart = new Chart(monthlySalesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Ventas Mensuales',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '$' + context.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                }
            }
        }
    });

    // Gráfico de productos más vendidos
    const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
    const topProductsChart = new Chart(topProductsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topProductsLabels) !!},
            datasets: [{
                label: 'Unidades Vendidas',
                data: {!! json_encode($topProductsData) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Funcionalidad para productos
    $(document).ready(function() {
        // Abrir modal para agregar producto
        $('#addProductBtn').click(function() {
            $('#productModalTitle').text('Agregar Producto');
            $('#productForm')[0].reset();
            $('#product_id').val('');
            $('#productModal').modal('show');
        });

        // Editar producto
        $('.edit-product').click(function() {
            const productId = $(this).data('id');
            
            $.get(`/admin/products/${productId}/edit`, function(product) {
                $('#productModalTitle').text('Editar Producto');
                $('#product_id').val(product.id);
                $('#name').val(product.name);
                $('#category_id').val(product.category_id);
                $('#price').val(product.price);
                $('#stock').val(product.stock);
                $('#description').val(product.description);
                $('#is_active').prop('checked', product.is_active);
                
                $('#productModal').modal('show');
            });
        });

        // Guardar producto
        $('#productForm').submit(function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const productId = $('#product_id').val();
            const url = productId ? `/admin/products/${productId}` : '/admin/products';
            const method = productId ? 'PUT' : 'POST';
            
            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#productModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error al guardar el producto');
                }
            });
        });

        // Cambiar estado del producto
        $('.product-status').change(function() {
            const productId = $(this).data('product-id');
            const isActive = $(this).is(':checked') ? 1 : 0;
            
            $.ajax({
                url: `/admin/products/${productId}/status`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_active: isActive
                },
                success: function(response) {
                    location.reload();
                }
            });
        });

        // Eliminar producto
        $('.delete-product').click(function() {
            if (confirm('¿Estás seguro de eliminar este producto?')) {
                const productId = $(this).data('id');
                
                $.ajax({
                    url: `/admin/products/${productId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        });

        // Cambiar estado de la orden
        $('.status-select').change(function() {
            const orderId = $(this).data('order-id');
            const status = $(this).val();
            
            $.ajax({
                url: `/admin/orders/${orderId}/status`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    location.reload();
                }
            });
        });

        // Eliminar orden
        $('.delete-order').click(function() {
            if (confirm('¿Estás seguro de eliminar esta orden?')) {
                const orderId = $(this).data('id');
                
                $.ajax({
                    url: `/admin/orders/${orderId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endsection
@endsection
