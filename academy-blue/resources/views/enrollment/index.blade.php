@extends('templates.base')
@section('title', 'Inscripciones')
@section('subtitle', 'Listado')
@section('content')
    @include('templates.messages')

    <div class="row col-lg-12">
        <div class="d-flex justify-content-end col-12">
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Crear</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="table_data" class="table table-hover table-striped table-responsive"> 
                <thead>
                    <th>ID</th>
                    <th>Estudiantes</th>
                    <th>Cursos</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>{{ $enrollment->student->name ?? 'N/A'  }}</td>
                            <td>{{ $enrollment->course->title ?? 'N/A' }}</td>
                            <td>{{ $enrollment->created_at->format('d/m/Y') ?? 'N/A' }}</td>
                            <td>{{ $enrollment->status ?? 'N/A' }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-fill btn-sm mr-2" title="Ver"
                                   data-toggle="modal" data-target="#modalShow{{ $enrollment->id }}">
                                    <i class="nc-icon nc-zoom-split"></i>
                                </a>
                                <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-warning btn-fill btn-sm mr-2" title="Editar">
                                    <i class="nc-icon nc-tap-01"></i>
                                </a>
                                <form id="form-delete-{{ $enrollment->id }}" action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" class="d-inline"> 
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta inscripción?');" class="btn btn-danger btn-fill btn-sm mr-2" title="Eliminar">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button> 
                                </form>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade modal-mini modal-primary" id="modalShow{{ $enrollment->id }}"
                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header justify-content-center">
                                            <h5>Detalle de la Inscripción</h5>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p><strong>ID:</strong> {{ $enrollment->id }}</p>
                                            <p><strong>Estudiante:</strong> {{ $enrollment->student->name ?? 'N/A' }}</p>
                                            <p><strong>Curso:</strong> {{ $enrollment->course->title ?? 'N/A' }}</p>
                                            <p><strong>Fecha de Creación:</strong> {{ $enrollment->created_at->format('d/m/Y') ?? 'N/A' }}</p>
                                            <p><strong>Estado:</strong> {{ $enrollment->status ?? 'N/A' }}</p>
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
