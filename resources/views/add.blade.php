@extends('layouts.app')

@section('content')
    <h1>Add Barcode</h1>

    <form id="form-create">
        <div class="form-group">
            <label for="bottle">Bottle:</label>
            <select id="bottle" name="bottle" class="form-control">
                @foreach ($bottles as $bottle)
                    <option value="{{ $bottle->id }}">{{ $bottle->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="barcode">Barcode:</label>
            <input type="text" id="barcode" name="barcode" class="form-control" autofocus autocomplete="off">
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('#form-create').addEventListener('submit', function(event) {
                event.preventDefault();

                const bottle = document.querySelector('#bottle').value;
                const barcode = document.querySelector('#barcode').value;

                fetch('{{ route('create') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        bottle: bottle,
                        barcode: barcode
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Barcode added with ID: ' + data.id);
                        document.querySelector('#barcode').value = '';
                        document.querySelector('#barcode').focus();
                    });
            });
        });
    </script>
@endsection
