<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} Pegawai
        </h2>
    </x-slot>
   <h1> show page</h1>
   <p>id : {{ $pegawai->id }}</p>
   <p>nama : {{ $pegawai->nama }}</p>
   <p>nip : {{ $pegawai->nip }}</p>
   <p>jabatan : {{ $pegawai->jabatan }}</p>
</x-app-layout>