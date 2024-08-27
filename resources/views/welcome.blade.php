<x-guest-layout>
  <div class="text-center space-y-6">
    <div class="title">
      {{-- <h1 class="text-xl font-bold">Welcome to Mengwi SmartGov</h1> --}}
      <p class="text-md text-gray-600">Your efficient government management system.</p>
    </div>

    <a href="{{ route('links.index') }}" class="inline-block px-6 py-3 bg-slate-800 text-white rounded-lg hover:bg-slate-700">
      Get Started
    </a>
  </div>
</x-guest-layout>
