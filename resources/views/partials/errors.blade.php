@if ($errors->any())
    <ul class="relative bg-red-200 text-red-900 py-2 px-6 rounded mb-4">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
