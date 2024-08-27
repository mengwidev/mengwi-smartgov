<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-row gap-x-2 ">
      <a href="{{ route('links.index') }}">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Link Shortener') }}
        </h2>
      </a>
      <i class="bi bi-caret-right-fill"></i>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight" :active="request()->routeIs('links.edit')">
          {{ __('Edit Link') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                      <div class="mb-3">
                          <label for="original_url" class="form-label">Original URL</label>
                          <input type="url" name="original_url" id="original_url" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $link->original_url }}" required>
                      </div>
                      <div class="mb-3">
                          <label for="shortened_url" class="form-label">Custom Slug</label>
                          <input type="text" name="shortened_url" id="shortened_url" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ ltrim(str_replace(url('/link/'), '', $link->shortened_url), '/') }}" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Update Link</button>
                      <a href="{{ route('links.index') }}" class="btn btn-secondary">Cancel</a>
                  </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>