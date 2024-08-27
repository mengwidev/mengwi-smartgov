<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-row gap-x-2 ">
      <a href="{{ route('links.index') }}">
        <h2 class="font-medium text-l text-gray-800 leading-tight">
          {{ __('Link Shortener') }}
        </h2>
      </a>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
      </svg>
      
      <h2 class="font-semibold text-l text-gray-800 leading-tight" :active="request()->routeIs('links.edit')">
          {{ __('Edit Link') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
              <div class="p-6 text-gray-900">
                  <!-- Error Message -->
                  @if($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <!-- Edit Link Form -->
                  <form action="{{ route('links.update', $link->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="original_url" class="block text-gray-700 font-medium">Original URL</label>
                        <input type="url" name="original_url" id="original_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $link->original_url }}" required>
                    </div>
                    <hr class="h-px bg-gray-400 border-none mb-4" />
                    <div class="mb-4">
                        <label for="shortened_url" class="block text-gray-700 font-medium">Custom Slug</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                https://smartgov.mengwi-badung.desa.id/link/
                            </span>
                            <input type="text" name="shortened_url" id="shortened_url" class="flex-1 block w-full min-w-0 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ ltrim(str_replace(url('/link/'), '', $link->shortened_url), '/') }}" required>
                        </div>
                        
                        <div class="flex flex-row text-red-600 mt-2 gap-2 max-w-xxl">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                          </svg>
                          
                          <p class="text-sm italic">
                              Changing the custom slug will regenerate the QR code, and the previous QR code image will be replaced or deleted.
                          </p>

                        </div>
                    </div>
                  
                    <div class="flex justify-start space-x-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Update Link
                        </button>
                        <a href="{{ route('links.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Cancel
                        </a>
                    </div>
                  </form>

              </div>
          </div>
      </div>
  </div>
</x-app-layout>