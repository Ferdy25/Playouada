<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'store' }}</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Konten --}}
    <div class="container py-5">
        {{ $slot }}
    </div>

</body>
</html>
