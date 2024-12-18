@props(['team', 'component' => 'dropdown-link'])
@php
    // Si $team no es un objeto, intenta buscarlo.
       if (!is_object($team)) {
           $team = \App\Models\Team::find($team);
       }
@endphp

<form method="POST" action="{{ route('current-team.update') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->

{{--    @dd($team) <!-- Esto imprimirá el valor de $team en la página -->  --}}
    @if ($team && isset($team->id))
        <input type="hidden" name="team_id" value="{{ $team->id }}">
    @else
        <p>Error: El equipo no es válido.</p>
    @endif


    <x-dynamic-component :component="$component" href="#" x-on:click.prevent="$root.submit();">
        <div class="flex items-center">
            @if (Auth::user()->isCurrentTeam($team))
                <svg class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif

            <div class="truncate">{{ $team->name }}</div>
        </div>
    </x-dynamic-component>
</form>

