<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup</title>
</head>
<body>
    <h1>Backup Page</h1>
    <button onclick="window.location.href='{{ route('backup.downloadDatabase') }}'">Download .sql Database</button>
    <button onclick="window.location.href='{{ route('backup.downloadQrCodes') }}'">Download /qr-codes Folder</button>
</body>
</html>
