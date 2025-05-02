<!DOCTYPE html>
<html>

<head>
    <title>{{ $employee->name }}</title>
</head>

<body>
    <div>
        <h1>{{ $employee->name }}</h1>

        {{-- Employee photo --}}
        @if ($employee->photo)
            <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}"
                style="max-width: 200px; height: auto; border-radius: 8px;">
        @else
            <p>No photo uploaded.</p>
        @endif

        <p>Banjar: {{ $employee->banjar->name ?? '-' }}</p>
        <p>Employment Unit: {{ $employee->employmentUnit->name ?? '-' }}</p>
        <p>Employee Level: {{ $employee->level->name ?? '-' }}</p>

        <h2>Contact Information</h2>
        <ul>
            @foreach ($employee->contacts as $contact)
                <li>
                    {{ $contact->contactType->name }}: {{ $contact->value }}
                </li>
            @endforeach
        </ul>
    </div>

</body>

</html>
