@extends('templates.base')
@section('title', 'Cursos')
@section('subtitle', 'Listado')
@section('content')
    @include('templates.messages')

    <div class="row col-lg-12">
        <div class="d-flex justify-content-end col-12">
            <a href="{{ route('courses.create') }}" class="btn btn-primary">Crear</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="table_data" class="table table-hover table-striped table-responsive"> 
                <thead>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Precio</th>
                    <th>Instructor</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->title }}</td>
                            <td>${{ number_format($course->price, 0, ',', '.') }}</td>
                            <td>{{ $course->instructor->name ?? 'N/A' }}</td>
                            <td>{{ $course->category->name ?? 'N/A' }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-fill btn-sm mr-2" title="Ver"
                                   data-toggle="modal" data-target="#modalShow{{ $course->id }}">
                                    <i class="nc-icon nc-zoom-split"></i>
                                </a>
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-fill btn-sm mr-2" title="Editar">
                                    <i class="nc-icon nc-tap-01"></i>
                                </a>
                                <form id="form-delete-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline"> 
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este curso?');" class="btn btn-danger btn-fill btn-sm mr-2" title="Eliminar">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button> 
                                </form>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade modal-mini modal-primary" id="modalShow{{ $course->id }}"
                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header justify-content-center">
                                            <h5>Detalle del Curso</h5>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p><strong>ID:</strong> {{ $course->id }}</p>
                                            <p><strong>Título:</strong> {{ $course->title }}</p>
                                            <p><strong>Descripción:</strong> {{ $course->description ?? 'Sin descripción' }}</p>
                                            <p><strong>Precio:</strong> ${{ number_format($course->price, 0, ',', '.') }}</p>
                                            <p><strong>Instructor:</strong> {{ $course->instructor->name ?? 'N/A' }}</p>
                                            <p><strong>Categoría:</strong> {{ $course->category->name ?? 'N/A' }}</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin modal -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
