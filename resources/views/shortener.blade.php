<x-app-layout>
  <x-slot name="header">
      <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
          {{ __('Link Shortener') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  
                  <h2 class="text-xl font-semibold mb-4">Shorten Links</h2>

                  <form action="/link" method="POST" class="mt-6 mb-6">
                      @csrf
                      <div class="mb-4">
                          <label for="original_url" class="block text-gray-700 font-medium">Original URL</label>
                          <input type="url" name="original_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="original_url" required>
                      </div>
                      <div class="mb-4">
                          <label for="custom_slug" class="block text-gray-700 font-medium">Custom Slug</label>
                          <input type="text" name="custom_slug" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="custom_slug" required>
                      </div>
                      <button type="submit" class="px-4 py-2 bg-cyan-900 text-white rounded-md hover:bg-cyan-950">Shorten Link</button>
                  </form>
              </div>
          </div>
      </div>

      {{-- CRUD MENU --}}
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <h2 class="text-xl font-semibold mb-4">Manage Links</h2>
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-slate-400 text-white">
                                <th class="px-6 py-3 text-left">Actions</th>
                                <th class="px-6 py-3 text-left">Original Link</th>
                                <th class="px-6 py-3 text-left">Shortened Link</th>
                                <th class="px-6 py-3 text-left">Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($links->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No data available
                                    </td>
                                </tr>
                            @else
                                @foreach($links as $link)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="px-6 py-4 flex space-x-2">
                                            <a href="{{ route('links.edit', $link->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-2 py-1 rounded">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        
                                            <button type="button" class="bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $link->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white px-2 py-1 rounded" data-bs-toggle="modal" data-bs-target="#viewQrModal" data-img="{{ asset('storage/qr-codes/'.$link->qr_code_filename) }}">
                                                <i class="bi bi-qr-code"></i>
                                            </button>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="relative group">
                                                {{ Str::limit($link->original_url, 40) }}
                                                @if(strlen($link->original_url) > 40)
                                                    <span class="text-blue-500 cursor-pointer ml-1"><i class="bi bi-eye"></i></span>
                                                    <span class="absolute left-0 bottom-0 w-auto p-2 bg-gray-800 text-white rounded shadow-md hidden group-hover:block z-10">
                                                        {{ $link->original_url }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button" class="text-green-500 hover:text-green-700" data-clipboard="{{ $link->shortened_url }}" onclick="copyToClipboard(this)">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                            {{ $link->shortened_url }}
                                        </td>
                                        <td class="px-6 py-4">{{ $link->updated_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                

                  <!-- Modal for Viewing QR Code -->
                  <div class="modal fade" id="viewQrModal" tabindex="-1" aria-labelledby="viewQrModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewQrModalLabel">QR Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="flex justify-center items-center" style="min-height: 300px;">
                                    <img id="qrCodeImage" src="" alt="QR Code" class="max-w-full h-auto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" id="downloadQrLink" class="btn btn-success" download>Download QR</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                  </div>

                  
                  <!-- Delete Confirmation Modal -->
                  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
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
                  <div class="fixed top-0 right-0 p-4 z-50">
                      <div id="copyToast" class="bg-green-600 text-white p-4 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out opacity-0 translate-y-4 hidden">
                          <div class="flex items-center">
                              <strong class="mr-2">Copied to Clipboard</strong>
                              <button type="button" class="ml-auto text-white" aria-label="Close">
                                  <i class="bi bi-x"></i>
                              </button>
                          </div>
                          <div class="mt-2">
                              The link has been copied to your clipboard.
                          </div>
                      </div>
                  </div>
                  
                  <!-- Success Toast Notification -->
                  <div class="fixed top-0 right-0 p-4 z-50">
                    <div id="successToast" class="bg-green-600 text-white p-4 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out opacity-0 translate-y-4 hidden">
                      <div class="flex items-center">
                          <strong class="mr-2">Success</strong>
                          <button type="button" class="ml-auto text-white" aria-label="Close">
                              <i class="bi bi-x"></i>
                          </button>
                      </div>
                      <div class="mt-2">
                          <span id="successMessage"></span>
                      </div>
                    </div>
                  </div>

                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                  <script>
                      document.addEventListener('DOMContentLoaded', function () {
                      // Handle QR Code View Modal
                      var viewQrModal = new bootstrap.Modal(document.getElementById('viewQrModal'));
                      document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#viewQrModal"]').forEach(button => {
                          button.addEventListener('click', function () {
                              var qrCodeFilename = button.getAttribute('data-img');
                              var imgSrc = qrCodeFilename; // Use the full path as required
                              var downloadLink = imgSrc; // Assuming the same src can be used for download

                              console.log('QR Code Image Source:', imgSrc); // Log image source for debugging

                              document.getElementById('qrCodeImage').src = imgSrc;
                              document.getElementById('downloadQrLink').href = downloadLink;
                              viewQrModal.show();
                          });
                      });

                      // Handle Delete Confirmation Modal
                      var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                      document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#deleteModal"]').forEach(button => {
                          button.addEventListener('click', function () {
                              var linkId = button.getAttribute('data-id');
                              var deleteForm = document.getElementById('deleteForm');
                              deleteForm.action = '/link/' + linkId;
                              deleteModal.show();
                          });
                      });

                      // Copy to Clipboard Functionality
                      document.querySelectorAll('[data-clipboard]').forEach(button => {
                          button.addEventListener('click', function () {
                              const link = button.getAttribute('data-clipboard');
                              navigator.clipboard.writeText(link)
                                  .then(() => {
                                      showCopyToast();
                                  })
                                  .catch(err => {
                                      console.error('Failed to copy text: ', err);
                                  });
                          });
                      });

                      function showCopyToast() {
                          const toastEl = document.getElementById('copyToast');
                          toastEl.classList.remove('hidden', 'opacity-0', 'translate-y-4');
                          toastEl.classList.add('opacity-100', 'translate-y-0');

                          // Automatically hide the toast after 2 seconds
                          setTimeout(() => {
                              hideCopyToast();
                          }, 2000);
                      }

                      function hideCopyToast() {
                          const toastEl = document.getElementById('copyToast');
                          toastEl.classList.remove('opacity-100', 'translate-y-0');
                          toastEl.classList.add('opacity-0', 'translate-y-4');

                          // Wait for the animation to complete before adding the hidden class
                          setTimeout(() => {
                              toastEl.classList.add('hidden');
                          }, 500); // Duration matches the transition duration
                      }

                      // Handle Success Toast Notification
                      const successMessage = '{{ session('success') }}';
                      if (successMessage) {
                          document.getElementById('successMessage').textContent = successMessage;
                          showSuccessToast();
                      }

                      function showSuccessToast() {
                          const toastEl = document.getElementById('successToast');
                          toastEl.classList.remove('hidden', 'opacity-0', 'translate-y-4');
                          toastEl.classList.add('opacity-100', 'translate-y-0');

                          // Automatically hide the toast after 2 seconds
                          setTimeout(() => {
                              hideSuccessToast();
                          }, 2000);
                      }

                      function hideSuccessToast() {
                          const toastEl = document.getElementById('successToast');
                          toastEl.classList.remove('opacity-100', 'translate-y-0');
                          toastEl.classList.add('opacity-0', 'translate-y-4');

                          // Wait for the animation to complete before adding the hidden class
                          setTimeout(() => {
                              toastEl.classList.add('hidden');
                          }, 500); // Duration matches the transition duration
                      }
                  });
                  </script>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>