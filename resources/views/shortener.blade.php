<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengwi SmartGov - Link Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Link Shortener</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="/link" method="POST">
            @csrf
            <div class="mb-3">
                <label for="original_url" class="form-label">Original URL</label>
                <input type="url" name="original_url" class="form-control" id="original_url" required>
            </div>
            <div class="mb-3">
                <label for="custom_slug" class="form-label">Custom Slug</label>
                <input type="text" name="custom_slug" class="form-control" id="custom_slug" required>
            </div>
            <button type="submit" class="btn btn-primary">Shorten Link</button>
        </form>

        <hr>

        <h2>Manage Links</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Original Link</th>
                    <th>Shortened Link</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($links as $link)
                    <tr>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" data-clipboard="{{ $link->shortened_url }}" onclick="copyToClipboard(this)"><i class="bi bi-clipboard"></i></button>
                            <a href="{{ route('links.edit', $link->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $link->id }}"><i class="bi bi-trash"></i></button>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#viewQrModal" data-img="{{ asset('storage/qr-codes/'.$link->qr_code_filename) }}" class="btn btn-sm btn-info"><i class="bi bi-qr-code"></i></a>
                        </td>
                        <td>{{ $link->original_url }}</td>
                        <td>{{ $link->shortened_url }}</td>
                        <td>{{ $link->updated_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Viewing QR Code -->
    <div class="modal fade" id="viewQrModal" tabindex="-1" aria-labelledby="viewQrModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewQrModalLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                    <img id="qrCodeImage" src="" alt="QR Code" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <a href="#" id="downloadQrLink" class="btn btn-success">Download QR</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this link? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="copyToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header bg-success">
              <strong class="me-auto text-white">Copied to Clipboard</strong>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body text-white">
              The link has been copied to your clipboard.
          </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Handle QR Code View Modal
            var viewQrModal = document.getElementById('viewQrModal');
            viewQrModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var imgSrc = button.getAttribute('data-img'); // Extract info from data-* attributes
                var modalImg = viewQrModal.querySelector('#qrCodeImage');
                modalImg.src = imgSrc;
            });

            // Handle Delete Confirmation Modal
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var linkId = button.getAttribute('data-id'); // Extract info from data-* attributes
                var deleteForm = confirmDeleteModal.querySelector('#deleteForm');
                deleteForm.action = '/link/' + linkId;
            });
        });

        // Function to Copy Link to Clipboard and Show Toast
        function copyToClipboard(button) {
            var link = button.getAttribute('data-clipboard');
            navigator.clipboard.writeText(link).then(function() {
                var toastEl = document.getElementById('copyToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }).catch(function(err) {
                console.error('Error copying to clipboard: ', err);
            });
        }

    </script>
</body>
</html>
