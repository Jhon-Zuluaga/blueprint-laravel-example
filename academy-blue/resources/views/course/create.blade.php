@extends('templates.base')
@section('title', 'Cursos')
@section('subtitle', 'Crear Nuevo Curso')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Formulario de creación</span>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left me-1"></i> Volver al listado
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <!-- Título -->
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text"
                       class="form-control @error('title') is-invalid @enderror"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       required>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description"
                          name="description"
                          rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number"
                       class="form-control @error('price') is-invalid @enderror"
                       id="price"
                       name="price"
                       value="{{ old('price') }}"
                       required>
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Instructor -->
            <div class="mb-3">
                <label for="instructor_id" class="form-label">Instructor</label>
                <select name="instructor_id" id="instructor_id" class="form-control @error('instructor_id') is-invalid @enderror" required>
                    <option value="">Seleccione un instructor</option>
                    @foreach($instructors as $id => $name)
                        <option value="{{ $id }}" {{ old('instructor_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('instructor_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Botones -->
            <div class="text-end">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection

